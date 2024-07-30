<?php

namespace App\Controllers\api;

use CodeIgniter\RESTful\ResourceController;
use App\Models\BannerModel;

class BannerController extends ResourceController {


    protected $bannerModel;
    protected $format = 'json';
    protected $message;
    protected $messageError;
    protected $validateArray;


   public function __construct(){

        $this->bannerModel = new bannerModel();
        $this->message      = "Banner Found";
        $this->messageError = "Banner not Found";
        $this->validateArray = ['', null, NULL];

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
            $data = $this->bannerModel->where('banner.deleted_at', NULL)->paginate($size, 'default', $page);

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

                $this->message = 'El id de la Banner no es válido.';

                $response = [
                    'status' => 400,
                    'error'  => $this->message,
                    'data'   => null,
                    'message'=> $this->message
                    ];
                
                return $this->respond($response);

            }


            $query = $this->bannerModel->where('banner.id', $id)->where('banner.deleted_at', NULL);

            $responseQuery = $query->get()->getResult();

            if($responseQuery){

                $response = array("status" => 200, "message" => $this->message, "data" => $responseQuery);

            }else{

                $response = array("status" => 404, "message" => $this->messageError, "data" => "");

            }


            return $this->respond($response);
        }
    }

    public function create(){
        
        $image              = $this->request->getFile('image');
        $keywords           = $this->request->getPost("keywords");
        
        $queryResponseImage = $this->saveImage($image);

        if($queryResponseImage["status"]){

            $this->message = "The fields are required. ";

        
            $data = array("id_user"       => 1,
                          "title"         => $this->request->getPost("title"),
                          "description"   => $this->request->getPost("description"),
                          "discount"      => $this->request->getPost("discount"),
                          "keywords"      => $keywords,
                          "position"      => "verticcal",
                          "image"         => $queryResponseImage["data"]);

            $responseValidate = $this->validateInfo($data);

            if( !empty($responseValidate) ){
    
                $response = array("status"  => false, 
                                  "message" => "The fields are required. ", 
                                  "data"    => $this->message,
                                  "code"    => 500);
    
                return $this->respond($response);
    
            }

            $responseQuery = $this->bannerModel->insert($data);

            if($responseQuery){
                
                $newId = $this->bannerModel->insertID();

                $response = [
                    'status'    => true,
                    'message'   => 'Banner create successfull',
                    'data'      => $newId,
                    'code'      => 200
                ];

                return $this->respond($response); 

            }else{
    
                $response = array('status'   => false,
                                  'message'  => 'Banner not was create successfull',
                                  'data'     => "",
                                  'code'      => 500);
    
                return $this->respond($response);
    
            }

        }else{

            $response = array('status'   => false,
                              'message'  => 'Banner not was create successfull',
                              'data'     => $queryResponseImage->data,
                              'code'     => 500);

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

            $this->message = 'El ID Del Banner no existe.';

            $response = [
                'status' => 400,
                'error' => $this->message,
                'data' => null,
                'message' => $this->message
                ];
            
            return $this->respond($response);

        }

        $image = $this->request->getFile('image');

        if($image == null){

            $image    = $this->request->getPost("image");
            $keywords = $this->request->getPost("keywords");

            $this->message = "The fields are required. ";

            $data = array("id_user"       => 1,
                          "title"         => $this->request->getPost("title"),
                          "description"   => $this->request->getPost("description"),
                          "discount"      => $this->request->getPost("discount"),
                          "keywords"      => $keywords,
                          "position"      => $this->request->getPost("position"),
                          "image"         => $image);

            $responseValidate = $this->validateInfo($data);

            if( !empty($responseValidate) ){
    
                $response = array("status"  => false, 
                                "message" => "The fields are required. ", 
                                "data"    => $this->message,
                                "code"    => 500);
    
                return $this->respond($response);
    
            }
            
            $responseQuery = $this->bannerModel->set($data)->where('id', $id)->update();

            if($responseQuery){
        
                $response = [
                    'status'    => true,
                    'message'   => 'Banner Update successfull',
                    'data'      => '',
                    'code'      => 200
                ];

                return $this->respond($response); 

            }else{
    
                $response = array('status'   => false,
                                    'message'  => 'Banner not was Update successfull',
                                    'data'     => "",
                                    'code'      => 500);
    
                return $this->respond($response);
    
            }
    
        }else{

            $keywords           = $this->request->getPost("keywords");
            
            $queryResponseImage = $this->saveImage($image);
    
            if($queryResponseImage["status"]){
    
                $this->message = "The fields are required. ";
    
                $data = array("id_user"       => 1,
                              "title"         => $this->request->getPost("title"),
                              "description"   => $this->request->getPost("description"),
                              "discount"      => $this->request->getPost("discount"),
                              "keywords"      => $keywords,
                              "position"      => $this->request->getPost("position"),
                              "image"         => $queryResponseImage["data"]);
    
                $responseValidate = $this->validateInfo($data);
    
                if( !empty($responseValidate) ){
        
                    $response = array("status"  => false, 
                                    "message" => "The fields are required. ", 
                                    "data"    => $this->message,
                                    "code"    => 500);
        
                    return $this->respond($response);
        
                }

                $responseQuery = $this->bannerModel->set($data)->where('id', $id)->update();
    
                if($responseQuery){
            
                    $response = [
                        'status'    => true,
                        'message'   => 'Banner Update successfull',
                        'data'      => '',
                        'code'      => 200
                    ];
    
                    return $this->respond($response); 
    
                }else{
        
                    $response = array('status'   => false,
                                      'message'  => 'Banner not was Update successfull',
                                      'data'     => "",
                                      'code'      => 500);
        
                    return $this->respond($response);
        
                }
    
            }else{
    
                $response = array('status'   => false,
                                  'message'  => 'Banner not was Update successfull',
                                  'data'     => $queryResponseImage["data"],
                                  'code'     => 500);
    
                return $this->respond($response);
    
            }

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


    public function saveImage($image = null){
        // Obtener el archivo
        $image = $image;
    
        // Validar si es una imagen y si fue subida correctamente
        if ($image->isValid() && !$image->hasMoved()) {
            // Validar el tipo de archivo
            
            $validated = $this->validate([
                'image' => [
                    'uploaded[image]',
                    'mime_in[image,image/jpg,image/jpeg,image/gif,image/png]',
                    'max_size[image,2048]', // Tamaño máximo de 2MB
                ],
            ]);

            $validated = true;

            if ($validated) {
            
                // Generar un nombre único para la imagen
                $originalName = pathinfo($image->getName(), PATHINFO_FILENAME);

                $newName = $originalName.'_'.$image->getRandomName();
    
                // Mover la imagen a la carpeta 'asset/image'
                $image->move(ROOTPATH . 'public/assets/img/banner/top/', $newName);
               
                // Preparar los datos para guardar en la base de datos
                $dataImage =  '/assets/img/banner/top/'.$newName;
                
                return array("status" => true, "message" => "successfull", "data" => $dataImage);

            } else {
                
                // Manejar la validación fallida
                $errors = $this->validator->getErrors();

                return array("status" => false, "message" => "Error", "data" => "Validation failed: " . implode(', ', $errors));

            }
        } else {
            return "Invalid image file or no file uploaded.";
        }
    }


    public function validateRegister($id = null){

        if($id){

            $queryValidate = $this->bannerModel->find($id);

            if($queryValidate){

                return true;

            }else{

                return false;

            }

        }

    }

    public function validateImage($id = null){

        if($id){

            $queryValidate = $this->bannerModel->where("id", $id)->first();

            if($queryValidate){

                $response = array("status" => true, "id" => $queryValidate->id, "code" => 200);
                
                return $response;
            
            }else{

                return false;
            
            }

        }

    }

    public function delete($id = null){
        
        if( in_array($id, $this->validateArray, true) ){

            $this->message = 'El id de la Banner no es válido.';

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

            $responseQueryDeleteImage = $this->bannerModel->where("id", $id)->delete();
            
            if($responseQueryDeleteImage){

                $response = array("status" => true, "message" => "Banner delete successfull", "data" => "", "code" => 200);
            
                return $this->respond($response);

            }else{

                $response = array("status" => true, "message" => "Error in delete the Banner", "data" => "", "code" => 404);
            
                return $this->respond($response);

            }
            

            
            
        }else{

            $response = array("status" => true, "message" => "Banner not found", "data" => "","code" => 404);
            return $this->respond($response);

        }

    }


}