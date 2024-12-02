<?php

namespace App\Controllers;
use App\Models\ProductsImageModel;


class ProductImagesControlles extends BaseController{

    private $ProductsImageModel;

    function __construct(){
        $this->ProductsImageModel = new ProductsImageModel();
    }

    public function showImagesByProduct($idProduct){

        if($idProduct != null){

            $response = $this->ProductsImageModel->select("id, id_product, image, keywords")
                                                 ->where("id_product", $idProduct)
                                                 ->limit(1)
                                                 ->get()
                                                 ->getResult();

        }else{

            $response = [];

        }

        return $response;

    }
}