<?php

namespace App\Controllers;

use App\Models\CategoriesModel;
use App\Models\SubCategoriesModel;

class SubCategoriesController extends BaseController{

    private $CategoriesModel;
    private $subCategoryModel;

    public function __construct(){
        $this->CategoriesModel = new CategoriesModel();
        $this->subCategoryModel = new SubCategoriesModel();
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
           'products'      => $this->showProductsBySubcategory($subcategory),
           'category'      => $subcategory];

        return view('subcategories',$data);

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

    public function showProductsBySubcategory($subcategory=null){
        /*
            SELECT 
                p.id AS product_id,
                sc.id AS subcategory_id,
                sc.name AS subcategory_name,
                p.name AS product_name,
                MIN(pi.image) AS product_image -- Usamos MIN para obtener solo una imagen por producto
            FROM 
                subcategories sc
            INNER JOIN 
                products p ON sc.id = p.id_subcategories
            INNER JOIN 
                productimages pi ON pi.id_product = p.id
            WHERE 
                sc.name = "Smartphones"
            GROUP BY 
                p.id;
        */
        $productsBySubcategory = $this->subCategoryModel->select('p.id AS productoid, p.slug, p.keywords, p.sale_price, 
                                                                  p.description, p.discount, 
                                                                  subcategories.id AS idSc, subcategories.name AS nameSc, p.name, MIN(pi.image) AS image')
                                                            ->join('products p', 'subcategories.id = p.id_subcategories')
                                                            ->join('productimages pi', 'pi.id_product = p.id')
                                                            ->where('subcategories.name', $subcategory)
                                                            ->where('subcategories.deleted_at', NULL)
                                                            ->groupBy('p.id')
                                                            ->get()
                                                            ->getResult();
        return $productsBySubcategory;

    }


    public function showSubcategoriesBySlug($slug = null){

        if($slug){

            $response = $this->CategoriesModel->where("slug", $slug)->get()->getResult();

            if($response){

                $responseSubCategory = $this->showSubCategoryByIdCategory($response[0]->id);

                if($responseSubCategory){

                    return $responseSubCategory;
                
                }else{

                    return array();

                }
            
            }else{

                return array();

            }

        }else{

            return array();

        }

    }

    public function showSubCategoryByIdCategory($idCategory = null){

        if($idCategory != null){

            $response = $this->subCategoryModel->select("id, name, slug")
                                               ->where("id_categories", $idCategory)
                                               ->where("deleted_at",NULL)
                                               ->get()
                                               ->getResult();
            
        }else{

            $response = [];

        }

        return $response;

    }



}