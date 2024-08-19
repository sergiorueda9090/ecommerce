<?php

namespace App\Controllers;
use App\Models\ProductsModel;
use App\Models\ProductsImageModel;
use App\Models\ProductSizeModel;
use App\Models\WishesModel;

class ProductsController extends BaseController{

    private $ProductsModel;
    private $ProductsImageModel;
    private $WishesModel;

    public function __construct(){
        $this->ProductsModel        = new ProductsModel();
        $this->ProductsImageModel   = new ProductsImageModel();
        $this->ProductSizeModel     = new ProductSizeModel();
        $this->WishesModel          = new WishesModel();
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

}