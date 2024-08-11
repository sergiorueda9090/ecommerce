<?php

namespace App\Controllers;
use App\Models\CategoriesModel;

class CategoriesController extends BaseController{

    private $CategoriesModel;

    public function __construct(){
        $this->CategoriesModel = new CategoriesModel();
    }


    public function index(){
        
         // Cargar el controlador Home y obtener sus datos
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
            'products'      => $this->productsInfo()
        ];

        return view('categories',$data);

    }

    public function category($category){
       
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
           'products'      => $this->productsInfo($category),
           'category'      => $category];

        return view('categories',$data);
    }

    public function productsInfo($category=null){

        if(isset($category) && !empty($category)){
            
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
                                                    ->where('categories.slug',$category)
                                                    ->get()
                                                    ->getResult();
        }else{
        
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
                                                    ->groupBy('s.id')
                                                    ->get()
                                                    ->getResult();
        }
       return $productImages;
    }


}