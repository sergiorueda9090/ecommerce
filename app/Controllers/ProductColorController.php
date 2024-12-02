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
                
                $idSize         = $json->idSize;
                $id_attribute   = $json->id_attribute;
                $name           = $json->name;
                
                $requestColor = $this->ProductColorModel->select('productcolor.id, productcolor.id_productsize, productcolor.color, valueattributes.id_product')
                                                        ->join("valueattributes","productcolor.id_productsize = valueattributes.id")
                                                        ->where('id_productattributes', $id_attribute)
                                                        ->where('valueattributes.name', $name)                                                
                                                        ->get()
                                                        ->getResult();
                
                if ($requestColor) {

                    return $this->response->setJSON(['status' => 200,'exists' => true, 'colors'=>$requestColor],200);

                } else {

                    return $this->response->setJSON(['status' => 404, 'exists' => true,  'message' => 'Failed to call colors'],400);
                    
                }
                   
            }

        }

    }

}