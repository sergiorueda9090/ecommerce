<?php

namespace App\Controllers;
use App\Models\ProductsModel;
use App\Models\ProductsImageModel;
use App\Models\ProductSizeModel;

class ProductsController extends BaseController{

    private $ProductsModel;
    private $ProductsImageModel;

    public function __construct(){
        $this->ProductsModel        = new ProductsModel();
        $this->ProductsImageModel   = new ProductsImageModel();
        $this->ProductSizeModel     = new ProductSizeModel();
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
        $products       = $this->ProductsModel->where('products.slug',   $product)->get()->getResult();
        $product_images = $this->ProductsImageModel->where('id_product', $products[0]->id)->get()->getResult();
        $product_size   = $this->ProductSizeModel->where('id_product',   $products[0]->id)->get()->getResult();
        

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
        $footer         = $homeController->footer();

        $data = [
           'pageInfo'      => $pageInfo,
           'categories'    => $categories,
           'footer'        => $footer,
           'product'       => $products[0],
           'productImage'  => $product_images,
           'productSize'   => $product_size
       ];

       return view('product',$data);

   }

}