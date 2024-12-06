<?php

namespace App\Controllers;
use App\Models\CategoriesModel;
use App\Models\CategoriesBannerImagesModel;

class CategoriesBannerController extends BaseController{

    private $categoriesBannerImagesModel;
    private $categoriesModel;

    public function __construct(){
        $this->categoriesBannerImagesModel = new CategoriesBannerImagesModel();
        $this->categoriesModel = new CategoriesModel();
    }

    public function showCategoryBySlug($slug = null){

        if($slug){

            $response = $this->categoriesModel->where("slug", $slug)->get()->getResult();

            if($response){

                $responseBanner = $this->showBannerByIdCategory($response[0]->id);

                if($responseBanner){

                    return $responseBanner;
                
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

    public function showBannerByIdCategory($id = null){

        if($id != null){

            $responseBannerImages = $this->categoriesBannerImagesModel->where('id_categories',$id)->get()->getResult();

            if($responseBannerImages){

                return $responseBannerImages;

            }else{

                return array();

            }

        }else{

            return array();
        }

    }


}