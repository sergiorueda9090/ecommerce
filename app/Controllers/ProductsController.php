<?php

namespace App\Controllers;
use App\Models\ProductsModel;

class ProductsController extends BaseController{

    private $ProductsModel;

    public function __construct(){
        $this->ProductsModel = new ProductsModel();
    }

    public function index($product){
        /*
            SELECT p.id, p.name, pi.image, GROUP_CONCAT(pz.size SEPARATOR ",") AS size,
            GROUP_CONCAT(pz.id SEPARATOR ",") AS idsize FROM products p 
            INNER JOIN productimages pi ON pi.id_product = p.id
            INNER JOIN productsize pz ON pz.id_product = p.id
            WHERE p.slug = 'cool-cotton-tee'
            GROUP BY p.id;
        */      
        $product = $this->ProductsModel->select('products.*,  pi.image, 
                                                 GROUP_CONCAT(pz.size SEPARATOR ",")    AS size,
                                                 GROUP_CONCAT(pz.id SEPARATOR ",")      AS idsize')
                                        ->join('productimages pi'   , 'pi.id_product = products.id', 'inner')
                                        ->join('productsize pz'     , 'pz.id_product = products.id', 'inner')
                                        ->where('products.slug'     , $product)
                                        ->groupBy('products.id')
                                        ->first();
        
        // Cargar el controlador Home y obtener sus datos
        $homeController = new Home();
        $pageInfo       = $homeController->pageInfo();
        $categories     = $homeController->listCategories();
        $footer         = $homeController->footer();

        $data = [
           'pageInfo'      => $pageInfo,
           'categories'    => $categories,
           'footer'        => $footer,
           'product'       => $product
       ];

       return view('product',$data);

   }

}