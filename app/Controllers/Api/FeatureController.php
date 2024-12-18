<?php

namespace App\Controllers\api;

use CodeIgniter\RESTful\ResourceController;
use App\Models\FeatureModel;

class FeatureController extends ResourceController {
    
    protected $featureModel;
    protected $format = 'json';
    protected $message;
    protected $messageError;
    protected $validateArray;


    public function __construct(){

        $this->featureModel = new FeatureModel();
        $this->message      = "Feature Found";
        $this->messageError = "Feature not Found";
        $this->validateArray = ['', null, NULL];
    }


    public function create(){
    
        $img         = $this->request->getPost('img');
        $title       = $this->request->getPost('title');
        $description = $this->request->getPost('description');
        
        $this->message = "The fields are required. ";

        $data = array("img"         => $img,
                      "title"       => $title,
                      "description" => $description);

        $responseValidate = $this->validateInfo($data);

        if(!empty($responseValidate) ){

            $response = array("status"  => false, 
                                "message" => "The fields are required. ", 
                                "data"    => $this->message,
                                "code"    => 500);

            return $this->respond($response);

        }

        $responseQuery = $this->featureModel->insert($data);

        if($responseQuery){
            
            $newId = $this->featureModel->insertID();

            $response = [
                'status'    => true,
                'message'   => 'Feature create successfull',
                'data'      => $newId,
                'code'      => 200
            ];

            return $this->respond($response); 

        }else{

            $response = array('status' => false,
                            'message'  => 'Feature not was create successfull',
                            'data'     => "",
                            'code'     => 500);

            return $this->respond($response);

        }

        
    }


    public function validateInfo($data){

        $errors = [];

        foreach($data as $key => $value){

            if(empty($value)){

                $errors[$key] = "They $key field is required"; 

            }

        }

        return $errors;
    }

    public function listAll(){

        $method    = strtoupper($this->request->getMethod());

        if($method == 'GET'){

            // Establece el tamaño de la página
            $size = $this->request->getVar('size') ?: 20;

            // Obtiene el número de la página actual desde la solicitud (GET parameter)
            $page = $this->request->getVar('page') ?: 1;

            // Ejecuta la consulta con paginación
            $data = $this->featureModel->where('deleted_at', NULL)->paginate($size, 'default', $page);

            // Obtiene el objeto pager para obtener los datos de paginación
            $pager = \Config\Services::pager();

            // Prepara la respuesta
            $response = [
                'status' => 200,
                'error' => null,
                'data' => $data,
                'message' => $this->message,
                'pager' => [
                    'currentPage' => $pager->getCurrentPage(),
                    'totalPages'  => $pager->getPageCount(),
                    'perPage'     => $pager->getPerPage(),
                    'totalItems'  => $pager->getTotal(),
                ]
            ];

            return $this->respond($response);

        }


    }
    
    public function show($id = null){

        $method = strtoupper($this->request->getMethod());

        if($method === 'GET'){

            if( in_array($id, $this->validateArray, true) ){

                $this->message = 'El id de la Feature no es válido.';

                $response = [
                    'status' => 400,
                    'error'  => $this->message,
                    'data'   => null,
                    'message'=> $this->message
                    ];
                
                return $this->respond($response);

            }


            $query = $this->featureModel->where('id', $id)->where('deleted_at', NULL);

            $responseQuery = $query->get()->getResult();

            if($responseQuery){

                $response = array("status" => 200, "message" => $this->message, "data" => $responseQuery);

            }else{

                $response = array("status" => 404, "message" => $this->messageError, "data" => "");

            }


            return $this->respond($response);
        }
    }
    
    public function update($id = null){
        
        if( in_array($id, $this->validateArray, true) ){

            $this->message = 'El ID no es válido.';

            $response = [
                'status' => 400,
                'error' => $this->message,
                'data' => null,
                'message' => $this->message
                ];
            
            return $this->respond($response);

        }

        $validate = $this->validateRegister($id);

        if(!$validate){

            $this->message = 'El ID Del gender no existe.';

            $response = [
                'status' => 400,
                'error' => $this->message,
                'data' => null,
                'message' => $this->message
                ];
            
            return $this->respond($response);

        }

        $this->message = "The fields are required. ";

        $data = array("img"         => $this->request->getPost("img"),
                      "title"       => $this->request->getPost("title"),
                      "description" => $this->request->getPost("description"));

        $responseValidate = $this->validateInfo($data);

        if( !empty($responseValidate) ){

            $response = array("status"  => false, 
                            "message" => "The fields are required. ", 
                            "data"    => $this->message,
                            "code"    => 500);

            return $this->respond($response);

        }
        
        $responseQuery = $this->featureModel->set($data)->where('id', $id)->update();

        if($responseQuery){
    
            $response = [
                'status'    => true,
                'message'   => 'Feature Update successfull',
                'data'      => '',
                'code'      => 200
            ];

            return $this->respond($response); 

        }else{

            $response = array('status'   => false,
                                'message'  => 'Feature not was Update successfull',
                                'data'     => "",
                                'code'      => 500);

            return $this->respond($response);

        }
    
    }

    public function delete($id = null){
        
        if( in_array($id, $this->validateArray, true) ){

            $this->message = 'El id de la Feature no es válido.';

            $response = [
                'status' => 400,
                'error' => $this->message,
                'data' => null,
                'message' => $this->message
                ];
            
            return $this->respond($response);

        }

        $responseQuery = $this->validateRegister($id);

        if($responseQuery){

            $responseQueryDeleteImage = $this->featureModel->where("id", $id)->delete();
            
            if($responseQueryDeleteImage){

                $response = array("status" => true, "message" => "Feature delete successfull", "data" => "", "code" => 200);
            
                return $this->respond($response);

            }else{

                $response = array("status" => true, "message" => "Error in delete the Feature", "data" => "", "code" => 404);
            
                return $this->respond($response);

            }
               
        }else{

            $response = array("status" => true, "message" => "Feature not found", "data" => "","code" => 404);
            return $this->respond($response);

        }

    }
    
    public function createMany(){

        $data = $this->request->getPost("data");
  
        foreach($data as $key => $value){
        
            $dataCategory = array("id_user"     => 1,
                                    "id_categories" => $value["id_categories"],
                                    "name"        => $value["name"],
                                    "slug"        => $value["slug"],
                                    "description" => $value["description"],
                                    "keywords"    => $value["keywords"],
                                    "icon"        => "icon");


            if ($this->request->getFile('data.' . $key . '.image')) {
                $image = $this->request->getFile('data.' . $key . '.image');
            }
            
            $responseQuery = $this->subCategoriesModel->insert($dataCategory);

                if($responseQuery){
        
                    $newId = $this->subCategoriesModel->insertID();
        
                    $responseQueryImage = $this->saveImage($newId, $image, $value["keywords"]);
        
                    if($responseQueryImage){
        
                        $response = [
                            'status'    => $responseQueryImage['status'],
                            'message'   => 'SubCategory create successfull',
                            'data'      => $responseQueryImage['newId']
                        ];
        
                        
                    }else{
        
                        $response = array('status'  => 404,
                                        'message'  => 'SubCategory Image not was create successfull',
                                        'data'     => "");
        
        
                    }
        
                }else{
        
                    $response = array('status'  => 404,
                                    'message'  => 'SubCategory not was create successfull',
                                    'data'     => "");
        
        
                }

        }

        return $this->respond($response); 

    }

    public function validateRegister($id = null){

        if($id){

            $queryValidate = $this->featureModel->find($id);

            if($queryValidate){

                return true;

            }else{

                return false;

            }

        }

    }



}