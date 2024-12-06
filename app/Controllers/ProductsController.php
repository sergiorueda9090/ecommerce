<?php

namespace App\Controllers;
use App\Models\ProductsModel;
use App\Models\ProductsImageModel;
use App\Models\ProductSizeModel;
use App\Models\WishesModel;

use App\Models\ValueAttributesModel;
use App\Models\ProductColorModel;

class ProductsController extends BaseController{

    private $ProductsModel;
    private $ProductsImageModel;
    private $WishesModel;


    private $valueAttributesModel;
    private $productColorModel;

    public function __construct(){
        $this->ProductsModel        = new ProductsModel();
        $this->ProductsImageModel   = new ProductsImageModel();
        $this->ProductSizeModel     = new ProductSizeModel();
        $this->WishesModel          = new WishesModel();

        $this->valueAttributesModel = new ValueAttributesModel();
        $this->productColorModel     = new ProductColorModel();
    }

    public function index($product){

        $session = \Config\Services::session();
        $session = session();

        $products       = $this->ProductsModel->where('products.slug',   $product)->get()->getResult();
        $product_images = $this->ProductsImageModel->where('id_product', $products[0]->id)->get()->getResult();
        $product_size   = $this->ProductSizeModel->where('id_product',   $products[0]->id)->get()->getResult();
        
        $productWish = false;

        if($session->idUser){
                
            $idCustomer = $session->idUser;
            
            $responseWish = $this->WishesModel->where('id_customer', $idCustomer)
                                              ->where('id_product', $products[0]->id)
                                              ->where('wishes.deleted_at', NULL)->get()->getResult();

            if($responseWish){

                $productWish = true;
            
            }

        }
 

        /*$product = $this->ProductsModel->select('products.*,  pi.image, 
                                                 GROUP_CONCAT(pz.size SEPARATOR ",")    AS size,
                                                 GROUP_CONCAT(pz.id SEPARATOR ",")      AS idsize')
                                        ->join('productimages pi'   , 'pi.id_product = products.id', 'inner')
                                        ->join('productsize pz'     , 'pz.id_product = products.id', 'inner')
                                        ->where('products.slug'     , $product)
                                        ->groupBy('products.id')
                                        ->first();*/
        
        // Cargar el controlador Home y obtener sus datos
        $homeController = new Home();
        $pageInfo       = $homeController->pageInfo();
        $categories     = $homeController->listCategories();
        $header         = $homeController->header();
        $footer         = $homeController->footer();

        
        $data = [
           'pageInfo'      => $pageInfo,
           'categories'    => $categories,
           'header'        => $header,
           'footer'        => $footer,
           'product'       => $products[0],
           'productImage'  => $product_images,
           'productSize'   => $product_size,
           'productWish'   => $productWish
       ];

       return view('product',$data);
   }

   public function showProduct($product){

        $session = \Config\Services::session();
        $session = session();

        $products = $this->ProductsModel->select('products.*, productattributes.name AS attribute_name, productattributes.id as id_attribute')
                                        ->join("productattributes","products.id = productattributes.id_product")
                                        ->where('products.slug',   $product)
                                        ->where('products.deleted_at',NULL)
                                        ->get()
                                        ->getResult();

        $valueattributes = $this->valueAttributesModel->select('id,id_productattributes,id_product,name')
                                                      ->where('id_productattributes', $products[0]->id_attribute)
                                                      ->where('deleted_at', NULL)
                                                      ->get()
                                                      ->getResult();

        // Arreglo auxiliar para almacenar los nombres únicos
        $uniqueNames = [];
        // Arreglo para almacenar los resultados filtrados
        $filteredAttributes = [];

        foreach ($valueattributes as $attribute) {
            // Verificamos si el valor de 'name' ya está en el arreglo de nombres únicos
            if (!in_array($attribute->name, $uniqueNames)) {
                // Si no está, lo agregamos a los nombres únicos y al arreglo filtrado
                $uniqueNames[] = $attribute->name;
                $filteredAttributes[] = $attribute;
            }
        }

        // Extraer los IDs de los valueattributes
        $attribute_ids = array_column($valueattributes, 'id');
        $productcolors = $this->productColorModel->whereIn('id_productsize', $attribute_ids)  // Usar el array de IDs en la cláusula WHERE IN
                                                 ->where('deleted_at', NULL) 
                                                 ->get()
                                                 ->getResult();

        // Arreglo auxiliar para almacenar los colores únicos
        $uniqueColores = [];
        // Arreglo para almacenar los resultados filteredColores
        $filteredColores = [];

        foreach ($productcolors as $colores) {
            // Verificamos si el valor de 'color' ya está en el arreglo de color únicos
            if (!in_array($colores->color, $uniqueColores)) {
                // Si no está, lo agregamos a los color únicos y al arreglo filteredColores
                $uniqueColores[] = $colores->color;
                $filteredColores[] = $colores;
            }
        }

        /******* DISPLAY IMAGES ********* */                                  
        $product_images = $this->ProductsImageModel->where('id_product', $products[0]->id)
                                                    ->where('id_color',  $productcolors[0]->id)
                                                    ->where('deleted_at', NULL) 
                                                    ->get()
                                                    ->getResult();
        /******* END DISPLAY IMAGES ********* */   


        $product_size   = $this->ProductSizeModel->where('id_product',   $products[0]->id)
                                                 ->where('deleted_at', NULL)
                                                 ->get()
                                                 ->getResult();
        
        $productWish = false;

        if($session->idUser){
                
            $idCustomer = $session->idUser;
            
            $responseWish = $this->WishesModel->where('id_customer', $idCustomer)
                                            ->where('id_product', $products[0]->id)
                                            ->where('wishes.deleted_at', NULL)->get()->getResult();

            if($responseWish){

                $productWish = true;
            
            }

        }


        /*$product = $this->ProductsModel->select('products.*,  pi.image, 
                                                GROUP_CONCAT(pz.size SEPARATOR ",")    AS size,
                                                GROUP_CONCAT(pz.id SEPARATOR ",")      AS idsize')
                                        ->join('productimages pi'   , 'pi.id_product = products.id', 'inner')
                                        ->join('productsize pz'     , 'pz.id_product = products.id', 'inner')
                                        ->where('products.slug'     , $product)
                                        ->groupBy('products.id')
                                        ->first();*/
        
        // Cargar el controlador Home y obtener sus datos
        $homeController = new Home();
        $pageInfo       = $homeController->pageInfo();
        $categories     = $homeController->listCategories();
        $header         = $homeController->header();
        $footer         = $homeController->footer();

        
        $data = [
        'pageInfo'        => $pageInfo,
        'categories'      => $categories,
        'header'          => $header,
        'footer'          => $footer,
        'product'         => $products[0],
        'valueattributes' => $filteredAttributes,
        'productcolors'   => $filteredColores,
        'productImage'    => $product_images,
        'productSize'     => $product_size,
        'productWish'     => $productWish
    ];

    return view('product',$data);

   }

   public function showProductByCategory($idCategory = null){

    if($idCategory != null){

        $response = $this->ProductsModel->select("id, name, slug, keywords, purchase_price, percentage_profit, sale_price, discount, description")
                                        ->where("id_categories", $idCategory)
                                        ->where("deleted_at", NULL)
                                        ->get()
                                        ->getResult();

    }else{

        $response = [];

    }

    return $response;

   }
}