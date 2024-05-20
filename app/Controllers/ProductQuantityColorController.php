<?php

namespace App\Controllers;
use App\Models\ProductQuantityColorModel;


class ProductQuantityColorController extends BaseController{

    private $ProductQuantityColorModel;

    function __construct(){
        $this->ProductQuantityColorModel = new ProductQuantityColorModel();
    }

    function quantity(){

        $request = \Config\Services::request();

        $method = strtoupper($request->getMethod());

        if($method == "POST"){

            $json = $request->getJSON();

            if(isset($json->idquantity) && !empty($json->idquantity) ){
                
                $idquantity = $json->idquantity;
                
                $requestQuantity = $this->ProductQuantityColorModel->where('id_productcolor', $idquantity)->first();
                
                if ($requestQuantity) {

                    return $this->response->setJSON(['status' => 200,'exists' => true, 'data'=>$requestQuantity],200);

                } else {

                    return $this->response->setJSON(['status' => 404, 'exists' => true,  'message' => 'Failed to call Quantity'],400);
                    
                }
                   
            }

        }

    }

}