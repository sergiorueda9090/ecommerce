<?php

namespace App\Controllers;
use App\Models\CitysModel;

class CityController extends BaseController{
    
    private $citysModel;

    public function __construct(){
        $this->citysModel = new  CitysModel();
    }

    public function city(){

        $request = \Config\Services::request();

        $method = strtoupper($request->getMethod());

        if($method == 'POST'){

            $json = $request->getJSON();

            $departamento_id = $json->idDepartment;

            $city = $this->citysModel->where('departamento_id ', $departamento_id)->findAll();

            if($city){

                return $this->response->setJson(['status'  => 200, 'exists' => true, 
                                                'message' => 'city', 
                                                'data'    => json_encode($city, true)],200); 

            }else{

                return $this->response->setJson(['status'  => 404, 'exists' => false, 
                                                'message' => 'NO exists city'],404); 

            }

        }

    }

}