<?php
namespace App\Controllers;
use App\Models\RatingsCommentsModel;

class RatingsCommentsController extends BaseController{
    
    private $RatingsCommentsModel;

    public function __construct(){
        $this->RatingsCommentsModel = new RatingsCommentsModel();
    }
    public function index(){
        $homeController = new Home();
        $pageInfo       = $homeController->pageInfo();
        $categories     = $homeController->listCategories();
        $header         = $homeController->header();
        $footer         = $homeController->footer();

        $data = [
           'pageInfo'    => $pageInfo,
           'categories'  => $categories,
           'header'      => $header,
           'footer'      => $footer,
       ];

        return view('shoppingcar',$data);
    }

    public function addRatingsCommet(){

        $request = \Config\Services::request();
        $session = \Config\Services::session();
        $session = session();
        
        $method = strtoupper($request->getMethod());

        if($method == "POST"){

    
            $comment = $request->getPost('comment');
            $rating = $request->getPost('rating');
            $images = $request->getFiles('images');
            $idproduct = $request->getPost('idproduct');
            // Guardar la información del comentario y la calificación
            $arrayCommets = array(
                            "idproduct" => $idproduct,
                            "iduser"    => $session->idUser,
                            "ratings"   => $rating,
                            "comment"   => $comment,
                            "images"    => []
                        );

                             // Guardar las rutas de las imágenes
            $uploadedImages = [];

            if ($images && $images['images']) {

                foreach ($images['images'] as $img) {
                    if ($img->isValid() && !$img->hasMoved()) {
                        $newName = $img->getRandomName();
                        $img->move(ROOTPATH . 'public/assets/img/comments/img/', $newName);
                        $uploadedImages[] = 'public/assets/img/comments/img/' . $newName;
                    }
                }
            
            }

            $arrayCommets['images'] = json_encode($uploadedImages);

            if($this->RatingsCommentsModel->insert($arrayCommets)){

                return response()->setJSON([
                    'status' => 200,
                    'success' => true,
                    'message' => 'Commentario agregado'
                ]);

            }else{

                return response()->setJSON([
                    'status' => 400,
                    'success' => false,
                    'message' => 'Commentario no agregado'
                ]);

            }



            return $response;
            //$requestAddWish = $this->wishesModel->insert($arrayWish);
        
        }


    }

}
