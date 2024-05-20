<?php

namespace App\Controllers;
use App\Models\ProductColorModel;


class ProductColorController extends BaseController{

    private $ProductColorModel;

    function __construct(){
        $this->ProductColorModel = new ProductColorModel();
    }

    function colors(){

        $request = \Config\Services::request();

        $method = strtoupper($request->getMethod());

        if($method == "POST"){

            $json = $request->getJSON();

            if(isset($json->idSize) && !empty($json->idSize) ){
                
                $idSize = $json->idSize;
                
                $requestColor = $this->ProductColorModel->where('id_productsize', $idSize)->get()->getResult();
                
                if ($requestColor) {

                    return $this->response->setJSON(['status' => 200,'exists' => true, 'colors'=>$requestColor],200);

                } else {

                    return $this->response->setJSON(['status' => 404, 'exists' => true,  'message' => 'Failed to call colors'],400);
                    
                }
                   
            }

        }

    }

}