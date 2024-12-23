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
       
        $homeController     = new Home(); 
        $productsByCategory = new ProductsController();
        $imageProdCtr       = new ProductImagesControlles();
        $banneImages        = new CategoriesBannerController();
        $subcategories      = new SubCategoriesController();

        $pageInfo       = $homeController->pageInfo();
        $categories     = $homeController->listCategories();
        $footer         = $homeController->footer();
        $header         = $homeController->header();
        $products       =  $this->productsInfo($category);
        $bannerImg      = $banneImages->showCategoryBySlug($category);
        $subcategories    = $subcategories->showSubcategoriesBySlug($category);

        if($products){
            $productsCategory = $productsByCategory->showProductByCategory($products[0]->id);    
        }else{
            $productsCategory   = [];
        }


        foreach ($productsCategory as $key => $value) {
            // Obtén la imagen del producto
            $imageProduct = $imageProdCtr->showImagesByProduct($value->id);
        
            // Si la imagen existe, la agregamos al producto
            if (!empty($imageProduct)) {
                $value->image = $imageProduct[0]->image; // Agrega la URL o el campo que necesites
            } else {
                $value->image = null; // Si no hay imagen, agrega un valor por defecto
            }
        }
        
        $data = [
           'pageInfo'      => $pageInfo,
           'categories'    => $categories,
           'header'        => $header,
           'footer'        => $footer,
           'bannerImg'     => $bannerImg,
           'products'      => $products,
           'subcategories' => $subcategories,
           'productsCategory' => $productsCategory,
           'category'      => $category];

        return view('categories',$data);
    }

    public function productsInfo($category=null){

        if(isset($category) && !empty($category)){
            
            $productImages = $this->CategoriesModel->select('categories.id, 
                                                            p.name, 
                                                            p.id as productoid,
                                                            p.slug,
                                                            p.keywords,
                                                            p.sale_price,
                                                            p.originalPrice,
                                                            p.description,
                                                            p.discount,
                                                            pi.image')
                                                    ->join('subcategories s' , 's.id_categories      = categories.id', 'inner')
                                                    ->join('products      p' , 'p.id_subcategories   = s.id', 'inner')
                                                    ->join('productimages pi', 'pi.id_product        = p.id', 'inner')
                                                    ->where('p.deleted_at', NULL)
                                                    ->where('categories.slug',$category)
                                                    ->get()
                                                    ->getResult();
        }else{
        
            $productImages = $this->CategoriesModel->select('categories.id, 
                                                            p.name, 
                                                            p.id as productoid
                                                            p.slug,
                                                            p.keywords,
                                                            p.sale_price,
                                                            p.description,
                                                            p.discount,
                                                            pi.image')
                                                    ->join('subcategories s' , 's.id_categories      = categories.id', 'inner')
                                                    ->join('products      p' , 'p.id_subcategories   = s.id', 'inner')
                                                    ->join('productimages pi', 'pi.id_product        = p.id', 'inner')
                                                    ->where('p.deleted_at', NULL)
                                                    ->groupBy('s.id')
                                                    ->get()
                                                    ->getResult();
        }
       return $productImages;
    }


}