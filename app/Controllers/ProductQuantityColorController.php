<?php

namespace App\Controllers;
use App\Models\ProductQuantityColorModel;
use App\Models\ProductsImageModel;

class ProductQuantityColorController extends BaseController{

    private $ProductQuantityColorModel;
    private $productsImageModel;

    function __construct(){
        $this->ProductQuantityColorModel = new ProductQuantityColorModel();
        $this->productsImageModel        = new ProductsImageModel();
    }

    function quantity(){

        $request = \Config\Services::request();

        $method = strtoupper($request->getMethod());

        if($method == "POST"){

            $json = $request->getJSON();

            if(isset($json->idquantity) && !empty($json->idquantity) ){
                
                $idquantity = $json->idquantity;
                $color      = $json->color;
                $id_product = $json->id_product;
                
                $requestQuantity = $this->ProductQuantityColorModel->where('id_productcolor', $idquantity)->first();

                $requestImage    = $this->productsImageModel
                                        ->join("productcolor", "productimages.id_color = productcolor.id")
                                        ->where('productimages.id_product', $id_product)
                                        ->where('productcolor.color', $color)
                                        ->get()
                                        ->getResult();
                
                if ($requestQuantity && $requestImage) {

                    return $this->response->setJSON(['status' => 200,'exists' => true, 'data'=>$requestQuantity, 'images' => $requestImage],200);

                } else {

                    return $this->response->setJSON(['status' => 404, 'exists' => true,  'message' => 'Failed to call Quantity'],400);
                    
                }
                   
            }

        }

    }

}