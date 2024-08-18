<?php

namespace App\Controllers;

use App\Models\BannerModel;
use App\Models\SliderModel;
use App\Models\CategoriesModel;
use App\Models\PageInfoModel;
use App\Models\ProductsModel;
use App\Models\SubCategoriesModel;
use App\Models\SocialNetworkModel;
use App\Models\DepartamentosModel;


class Home extends BaseController
{   

    private $bannerModel;
    private $sliderModel;
    private $categoriesModel;
    private $pageInfoModel;
    private $ProductsModel;
    private $SubCategoriesModel;
    private $SocialNetworkModel;
 

    public function __construct(){
        $this->bannerModel      = new BannerModel();
        $this->sliderModel      = new SliderModel();
        $this->CategoriesModel  = new CategoriesModel();
        $this->pageInfoModel    = new PageInfoModel();
        $this->ProductsModel    = new ProductsModel();
        $this->SubCategoriesModel = new SubCategoriesModel();
        $this->SocialNetworkModel = new SocialNetworkModel();
    }


    /*
        SELECT c.name,
        GROUP_CONCAT(s.name SEPARATOR ",") as subcategories,
        GROUP_CONCAT(sci.image SEPARATOR ",") as imgsubcategories
        FROM categories c
        INNER JOIN subcategories s on c.id = s.id_categories 
        INNER JOIN subcategoriesimages sci on sci.id_subcategories = s.id
        GROUP BY C.id;
    */
    public function index(){

        $sliderAll      = $this->sliderModel->findAll();

        $categoriesAll  = $this->CategoriesModel->select('categories.*, categoriesimages.image')
                                                ->join('categoriesimages', 'categories.id = categoriesimages.id_categories', 'inner')
                                                ->where('categories.deleted_at',NULL)
                                                ->get()
                                                ->getResult();

        /*$subcategoriesAll = $this->CategoriesModel->select('categories.id,categories.name,
                                                            GROUP_CONCAT(s.slug     SEPARATOR ",")      as subcategory_slugs,
                                                            GROUP_CONCAT(s.name     SEPARATOR ",")      as subcategories,
                                                            GROUP_CONCAT(sci.image  SEPARATOR ",")      as imgsubcategories')
                                                           ->join('subcategories s'         , 'categories.id        = s.id_categories', 'inner')
                                                           ->join('subcategoriesimages sci' , 'sci.id_subcategories = s.id',            'inner')
                                                           ->groupBy('categories.id')
                                                           ->where('categories.deleted_at',NULL)
                                                           ->where('s.deleted_at',NULL)
                                                           ->get()
                                                           ->getResult();*/

            $subcategoriesAll = $this->SubCategoriesModel->select('subcategories.id, subcategories.id_categories, subcategories.name, subcategories.slug, 
                                                                  subcategoriesimages.image')
                                                         ->join('subcategoriesimages', 'subcategories.id = subcategoriesimages.id_subcategories', 'inner')
                                                         ->where('subcategories.deleted_at',NULL)
                                                         ->get()
                                                         ->getResult();

        /*$productImages = $this->CategoriesModel->select('categories.id, 
                                                         p.name,
                                                         p.slug,
                                                         p.keywords,
                                                         p.sale_price,
                                                         p.description,
                                                         pi.image')
                                               ->join('subcategories s' , 's.id_categories      = categories.id', 'inner')
                                               ->join('products      p' , 'p.id_subcategories   = s.id', 'inner')
                                               ->join('productimages pi', 'pi.id_product        = p.id', 'inner')
                                               ->groupBy('s.id')
                                               ->where('categories.deleted_at',NULL)
                                               ->get()
                                               ->getResult();*/


        $productImages = $this->ProductsModel->join('productimages' , 'productimages.id_product = products.id', 'inner')
                                                 //->groupBy('products.id_subcategories')
                                                 ->where('products.deleted_at',NULL)
                                                 ->get()
                                                 ->getResult();
        
        $data = array('sliderAll'           => $sliderAll,
                      'categoriesAll'       => $categoriesAll,
                      'subcategoriesAll'    => $subcategoriesAll,
                      'productImages'       => $productImages,
                      'pageInfo'            => $this->pageInfo(),
                      'categories'          => $this->listCategories(),
                      'header'              => $this->header(),
                      'footer'              => $this->footer());
        
        return view('ecommerce', $data);
    }

    public function listCategories(){

        $categories = $this->CategoriesModel->select('*')->get()->getResult();
        
        return $categories;

    }

    public function header(){

        $socialNetworkResponse = $this->SocialNetworkModel->get()->getResult();

        return $socialNetworkResponse;

    }

    public function footer(){

        $subcategoriesAll = $this->CategoriesModel->select('categories.name, categories.slug,
                                                            GROUP_CONCAT(s.name     SEPARATOR ",")      as subcategories')
                                                ->join('subcategories s'         , 'categories.id        = s.id_categories', 'inner')
                                                ->groupBy('categories.id')
                                                ->get()
                                                ->getResult();
        return $subcategoriesAll;
    }

    public function pageInfo(){
        $pageInfo = $this->pageInfoModel->select('*')->first();
        return $pageInfo;
    }

    public function pageRegisterCustomer(){

        $homeController = new Home();
        $departamentosCheckoutController = new CheckoutController();
        $pageInfo       = $homeController->pageInfo();
        $categories     = $homeController->listCategories();
        $footer         = $homeController->footer();
        $header         = $homeController->header();
        $deparments     = $departamentosCheckoutController->departamentos();
        
        $data = [
           'pageInfo'      => $pageInfo,
           'categories'    => $categories,
           'header'        => $header,
           'footer'        => $footer,
           'deparments'    => $deparments,
       ];

        return view('register',$data);

    }



}
