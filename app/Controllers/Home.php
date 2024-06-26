<?php

namespace App\Controllers;

use App\Models\BannerModel;
use App\Models\CategoriesModel;
use App\Models\PageInfoModel;

class Home extends BaseController
{   

    private $bannerModel;
    private $categoriesModel;
    private $pageInfoModel;

    public function __construct(){
        $this->bannerModel      = new BannerModel();
        $this->CategoriesModel  = new CategoriesModel();
        $this->pageInfoModel    = new PageInfoModel();
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

        $bannerAll      = $this->bannerModel->findAll();

        $categoriesAll  = $this->CategoriesModel->select('categories.*, categoriesimages.image')
                                                ->join('categoriesimages', 'categories.id = categoriesimages.id_categories', 'inner')
                                                ->get()
                                                ->getResult();

        $subcategoriesAll = $this->CategoriesModel->select('categories.id,categories.name,
                                                            GROUP_CONCAT(s.slug     SEPARATOR ",")      as subcategory_slugs,
                                                            GROUP_CONCAT(s.name     SEPARATOR ",")      as subcategories,
                                                            GROUP_CONCAT(sci.image  SEPARATOR ",")      as imgsubcategories')
                                                           ->join('subcategories s'         , 'categories.id        = s.id_categories', 'inner')
                                                           ->join('subcategoriesimages sci' , 'sci.id_subcategories = s.id',            'inner')
                                                           ->groupBy('categories.id')
                                                           ->get()
                                                           ->getResult();

        $productImages = $this->CategoriesModel->select('categories.id, 
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
                                               ->get()
                                               ->getResult();

        $data = array('bannerAll'           => $bannerAll,
                      'categoriesAll'       => $categoriesAll,
                      'subcategoriesAll'    => $subcategoriesAll,
                      'productImages'       => $productImages,
                      'pageInfo'            => $this->pageInfo(),
                      'categories'          => $this->listCategories(),
                      'footer'              => $this->footer());
        
        return view('ecommerce', $data);
    }

    public function listCategories(){

        $categories = $this->CategoriesModel->select('*')->get()->getResult();
        
        return $categories;

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
}
