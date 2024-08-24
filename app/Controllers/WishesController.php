<?php
namespace App\Controllers;
use App\Models\WishesModel;
use App\Models\ProductsModel;

class WishesController extends BaseController{
    
    private $wishesModel;
    private $productsModel;

    public function __construct(){

        $this->wishesModel = new WishesModel();
        $this->productsModel = new ProductsModel();
    }

    public function index(){

        $homeController = new Home();
        $pageInfo       = $homeController->pageInfo();
        $categories     = $homeController->listCategories();
        $footer         = $homeController->footer();
        $header         = $homeController->header();

        $data = [
           'pageInfo'      => $pageInfo,
           'categories'    => $categories,
           'header'        => $header,
           'footer'        => $footer,
           'productsWish'  => $this->showProductWish()
       ];

        return view('my_account_wishlist',$data);

    }

    public function addWish(){

        $request = \Config\Services::request();
        $session = \Config\Services::session();
        $session = session();
        $method = strtoupper($request->getMethod());

        if($method == "POST"){

            $json = $request->getJSON();
            
            if($session->idUser){
                
                $idCustomer = $session->idUser;

                if(isset($json->idProduct)){
                
                    $idproduct = $json->idProduct;
                    
                    $requestProduct = $this->productsModel->where('id', $idproduct)
                                                          ->where('products.deleted_at', NULL)
                                                          ->get()
                                                          ->getResult();
                    
                    if ($requestProduct) {

                        $responseValidateRecordWish = $this->wishesModel->where('id_customer', $idCustomer)
                                                                        ->where('id_product', $idproduct)
                                                                        ->where('wishes.deleted_at', NULL)
                                                                        ->get()
                                                                        ->getResult();
                        if($responseValidateRecordWish){

                            $errorMsg = 'El producto no pudo ser agregado a tu lista de deseos. Posibles razones:';
                            $errorMsg .= '<ul>';
                            $errorMsg .= '<li>El producto ya está en tu lista de deseos.</li>';
                            $errorMsg .= '<li>El producto no está disponible actualmente.</li>';
                            $errorMsg .= '<li>Ha ocurrido un problema con la conexión. Inténtalo nuevamente más tarde.</li>';
                            $errorMsg .= '</ul>';
                        
                            return response()->setJSON([
                                'status' => 400,
                                'success' => false,
                                'message' => $errorMsg
                            ]);

                        }else{

                            $arrayWish = array("id_customer" => $idCustomer,
                                                "id_product"  => $idproduct);

                            $requestAddWish = $this->wishesModel->insert($arrayWish);

                            if($requestAddWish){
                               
                                $total = $this->totalWish($idCustomer);

                                return response()->setJSON([
                                    'status' => 200,
                                    'success' => true,
                                    'message' => ' <span class="icon">&#10084;</span>  ¡Producto agregado a tu lista de deseos! Puedes revisarlo en tu lista o eliminarlo si cambias de opinión.',
                                    'total'   => $total
                                ]);
    
                            }else{
    
                                $errorMsg = 'El producto no pudo ser agregado a tu lista de deseos. Posibles razones:';
                                $errorMsg .= '<ul>';
                                $errorMsg .= '<li>El producto ya está en tu lista de deseos.</li>';
                                $errorMsg .= '<li>El producto no está disponible actualmente.</li>';
                                $errorMsg .= '<li>Ha ocurrido un problema con la conexión. Inténtalo nuevamente más tarde.</li>';
                                $errorMsg .= '</ul>';
                            
                                return response()->setJSON([
                                    'status' => 400,
                                    'success' => false,
                                    'message' => $errorMsg
                                ]);
                            }

                        }

    
                    } else {
    
                        return $this->response->setJSON(['status' => 404, 'exists' => true,  'message' => 'Failed to call colors'],400);
                        
                    }
                       
                }else{

                    return $this->response->setJSON(['status' => 404, 'exists' => true,  'message' => 'El producto ya no existe'],400);
               
                }

            }else{

                return $this->response->setJSON(['status' => 200, 'exists' => true, 'message' => 'Para agregar productos a tu lista de deseos, por favor inicia sesión o regístrate.'],200);

            }

        }

    }


    public function totalWish($idCustomer){

        if($idCustomer){

            $responseTotal = $this->wishesModel->select("count(*) total")->where('id_customer', $idCustomer)
                                                                            ->where('wishes.deleted_at', NULL)
                                                                            ->get()
                                                                            ->getResult(); 
            return $responseTotal[0]->total;
        
        }

        return 0;
        
    }


    public function removeWish() {
        // Obtener el método de la solicitud
        $method = $this->request->getMethod();
        $session = \Config\Services::session();
        $session = session();
    
        if ($method == "delete") {

            // Obtener el ID del producto de la URL
            $idProduct = $this->request->getVar('idProduct');
            
            // Verificar si el usuario está autenticado
            if ($session->idUser) {

                $idCustomer = $session->idUser;

                if ($idProduct) {

                    // Verificar si el producto está en la lista de deseos del usuario
                    $wish = $this->wishesModel->where('id_customer', $idCustomer)
                                              ->where('id_product', $idProduct)
                                              ->first();
    
                    if ($wish) {
                        // Eliminar el producto de la lista de deseos
                        $deleteWish = $this->wishesModel->delete($wish->id);
    
                        if ($deleteWish) {

                            $total = $this->totalWish($idCustomer);

                            return $this->response->setJSON([
                                'status'  => 200,
                                'success' => true,
                                'message' => '¡Producto eliminado de tu lista de deseos!',
                                'total'   => $total
                            ]);

                        } else {

                            return $this->response->setJSON([
                                'status' => 400,
                                'success' => false,
                                'message' => 'El producto no pudo ser eliminado de tu lista de deseos. Inténtalo nuevamente más tarde.'
                            ]);

                        }
                    } else {

                        return $this->response->setJSON([
                            'status' => 404,
                            'success' => false,
                            'message' => 'El producto no está en tu lista de deseos.'
                        ]);

                    }

                } else {
                    return $this->response->setJSON([
                        'status' => 400,
                        'success' => false,
                        'message' => 'No se ha proporcionado un ID de producto.'
                    ]);
                }
            } else {
                return $this->response->setJSON([
                    'status' => 401,
                    'success' => false,
                    'message' => 'Para eliminar productos de tu lista de deseos, por favor inicia sesión.'
                ]);
            }
        } else {
            return $this->response->setJSON([
                'status' => 405,
                'success' => false,
                'message' => 'Método no permitido.'
            ]);
        }
    }


    public function showProductWish(){
        
        $session = \Config\Services::session();
        
        $session = session();
        
        if($session->idUser){

            $responseWish = $this->wishesModel->select('image ,products.id, name, slug, sale_price')
                                            ->join('products'     , 'products.id = wishes.id_product', 'inner')
                                            ->join('productimages', 'products.id = productimages.id_product', 'inner')
                                            ->where('id_customer' , $session->idUser)
                                            ->where('wishes.deleted_at', NULL)
                                            ->groupBy('products.id')
                                            ->get()
                                            ->getResult();
            return $responseWish;
       
        }

    }

}