<?php

namespace App\Controllers;
use App\Models\CategoriesModel;
use App\Models\CategoriesBannerImagesModel;

class BrandsControllers extends BaseController{

    private $categoriesBannerImagesModel;

    public function __construct(){
        $this->categoriesBannerImagesModel = new CategoriesBannerImagesModel();
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