<?php

namespace App\Controllers;

use App\Models\CategoriesModel;

class SubCategoriesController extends BaseController{

    private $CategoriesModel;

    public function __construct(){
        $this->CategoriesModel = new CategoriesModel();
    }

    public function index($subcategory){

        $homeController = new Home();
        $pageInfo       = $homeController->pageInfo();
        $categories     = $homeController->listCategories();
        $header         = $homeController->header();
        $footer         = $homeController->footer();

        $products = 

        $data = [
           'pageInfo'      => $pageInfo,
           'categories'    => $categories,
           'header'        => $header,
           'footer'        => $footer,
           'products'      => $this->productsInfo($subcategory),
           'category'      => $subcategory];

        return view('categories',$data);

    }

    public function productsInfo($subcategory=null){

        if(isset($subcategory) && !empty($subcategory)){
            
            $productImages = $this->CategoriesModel->select('categories.id, 
                                                             p.name, 
                                                             p.slug,
                                                             p.keywords,
                                                             p.sale_price,
                                                             p.description,
                                                             p.discount,
                                                             pi.image')
                                                    ->join('subcategories s' , 's.id_categories      = categories.id', 'inner')
                                                    ->join('products      p' , 'p.id_subcategories   = s.id', 'inner')
                                                    ->join('productimages pi', 'pi.id_product        = p.id', 'inner')
                                                    ->where('s.slug',$subcategory)
                                                    ->where('categories.deleted_at',NULL)
                                                    ->groupBy('p.id')
                                                    ->get()
                                                    ->getResult();
        }

       return $productImages;
    }

}