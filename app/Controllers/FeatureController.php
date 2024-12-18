<?php

namespace App\Controllers;
use App\Models\FeatureModel;

class FeatureController extends BaseController{

    private $featureModel;


    public function __construct(){
        $this->featureModel = new FeatureModel();
    }

    public function showFeature(){

        $response = $this->featureModel->where('deleted_at',NULL)->get()->getResult();

        if($response){

            return $response;
        
        }else{

            return array();

        }
    
    }


}