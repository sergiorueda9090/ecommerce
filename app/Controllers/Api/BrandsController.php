<?php

namespace App\Controllers\api;

use CodeIgniter\RESTful\ResourceController;
use App\Models\BrandsModel;

class BrandsController extends ResourceController {


    protected $brandsModel;
    protected $format = 'json';
    protected $message;
    protected $messageError;
    protected $validateArray;


    public function __construct(){

        $this->brandsModel = new BrandsModel();
        $this->message      = "Brands Found";
        $this->messageError = "Brands not Found";
        $this->validateArray = ['', null, NULL];
    }


    public function create(){
    
        $name           = $this->request->getPost('name');
        $description    = $this->request->getPost('description');
        $category_id    = $this->request->getPost('category_id');
        $subcategory_id = $this->request->getPost('subcategory_id');
        $image          = $this->request->getFile('image');
        
        $queryResponseImage = $this->saveImage($image);

        if($queryResponseImage["status"]){

            $this->message = "The fields are required. ";

        
            $data = array("id_user"       => 1,
                          "name"          => $name,
                          "description"   => $description,
                          "category_id"   => $category_id,
                          "subcategory_id"=> $subcategory_id,
                          "image_url"     => $queryResponseImage["data"]);

            $responseValidate = $this->validateInfo($data);

            if( !empty($responseValidate) ){

                $response = array("status"  => false, 
                                  "message" => "The fields are required. ", 
                                  "data"    => $this->message,
                                  "code"    => 500);

                return $this->respond($response);

            }

            $responseQuery = $this->brandsModel->insert($data);

            if($responseQuery){
                
                $newId = $this->brandsModel->insertID();

                $response = [
                    'status'    => true,
                    'message'   => 'Brands create successfull',
                    'data'      => $newId,
                    'code'      => 200
                ];

                return $this->respond($response); 

            }else{

                $response = array('status' => false,
                                'message'  => 'Brands not was create successfull',
                                'data'     => "",
                                'code'     => 500);

                return $this->respond($response);

            }

        }else{

            $response = array('status'  => false,
                              'message' => 'Brands not was create successfull',
                              'data'    => $queryResponseImage->data,
                              'code'    => 500);

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
            $data = $this->brandsModel->where('brands.deleted_at', NULL)->paginate($size, 'default', $page);

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

                $this->message = 'El id de la brands no es válido.';

                $response = [
                    'status' => 400,
                    'error'  => $this->message,
                    'data'   => null,
                    'message'=> $this->message
                    ];
                
                return $this->respond($response);

            }

            $query = $this->brandsModel->select(['id', 'name', 'description', 'image_url AS image','category_id','subcategory_id'])->where('brands.id', $id)->where('brands.deleted_at', NULL);

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

            $this->message = 'El ID Del brand no existe.';

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

            $image = $this->request->getPost("image");
           
            $this->message = "The fields are required. ";

            $data = array("id_user"       => 1,
                          "name"          => $this->request->getPost("name"),
                          "description"   => $this->request->getPost("description"),
                          "category_id"   => $this->request->getPost('category_id'),
                          "subcategory_id"=> $this->request->getPost("subcategory_id"));

            $responseValidate = $this->validateInfo($data);

            if( !empty($responseValidate) ){
    
                $response = array("status"  => false, 
                                "message" => "The fields are required. ", 
                                "data"    => $this->message,
                                "code"    => 500);
    
                return $this->respond($response);
    
            }
            
            $responseQuery = $this->brandsModel->set($data)->where('id', $id)->update();

            if($responseQuery){
        
                $response = [
                    'status'    => true,
                    'message'   => 'Brand Update successfull',
                    'data'      => '',
                    'code'      => 200
                ];

                return $this->respond($response); 

            }else{
    
                $response = array('status'   => false,
                                    'message'  => 'Brand not was Update successfull',
                                    'data'     => "",
                                    'code'      => 500);
    
                return $this->respond($response);
    
            }
    
        }else{

            $queryResponseImage = $this->saveImage($image);
    
            if($queryResponseImage["status"]){
    
                $this->message = "The fields are required. ";

    
                $data = array("id_user"       => 1,
                              "name"          => $this->request->getPost("name"),
                              "description"   => $this->request->getPost("description"),
                              "category_id"   => $this->request->getPost('category_id'),
                              "subcategory_id"=> $this->request->getPost("subcategory_id"),
                              "image_url"     => $queryResponseImage["data"]);

                $responseValidate = $this->validateInfo($data);
    
                if( !empty($responseValidate) ){
        
                    $response = array("status"  => false, 
                                    "message" => "The fields are required. ", 
                                    "data"    => $this->message,
                                    "code"    => 500);
        
                    return $this->respond($response);
        
                }

                $responseQuery = $this->brandsModel->set($data)->where('id', $id)->update();
    
                if($responseQuery){
            
                    $response = [
                        'status'    => true,
                        'message'   => 'Brand Update successfull',
                        'data'      => '',
                        'code'      => 200
                    ];
    
                    return $this->respond($response); 
    
                }else{
        
                    $response = array('status'   => false,
                                      'message'  => 'Brand not was Update successfull',
                                      'data'     => "",
                                      'code'      => 500);
        
                    return $this->respond($response);
        
                }
    
            }else{
    
                $response = array('status'   => false,
                                  'message'  => 'Brand not was Update successfull',
                                  'data'     => $queryResponseImage["data"],
                                  'code'     => 500);
    
                return $this->respond($response);
    
            }

        }

    }


    public function createMany(){

        $data = $this->request->getPost("data");
  
        foreach($data as $key => $value){
        
            if ($this->request->getFile('data.' . $key . '.image')) {
                $image = $this->request->getFile('data.' . $key . '.image');
            }

            $responseQueryImage = $this->saveImage($image);

            if($responseQueryImage){

                $dataCategory = array("id_user"       => 1,
                                      "category_id"   => $value["category_id"],
                                      "subcategory_id"=> $value["subcategory_id"],
                                      "name"          => $value["name"],
                                      "description"   => $value["description"],
                                      "image_url"     => $responseQueryImage["data"]);
                
                $responseQuery = $this->brandsModel->insert($dataCategory);

                if($responseQuery){

                    $newId = $this->brandsModel->insertID();

                    $response = [
                        'status'    => $responseQueryImage['status'],
                        'message'   => 'Brands create successfull',
                        'data'      => $newId
                    ];

                }else{
                    $response = array('status'  => 404, 'message'  => 'Brands not was create successfull','data' => "");
                }
                
            }else{
                $response = array('status'  => 404,'message'  => 'SubCategory Image not was create successfull', 'data' => "");
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
                $image->move(ROOTPATH . 'public/assets/img/brands/', $newName);
               
                // Preparar los datos para guardar en la base de datos
                $dataImage =  '/assets/img/brands/'.$newName;
                
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

            $queryValidate = $this->brandsModel->find($id);

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

            $responseQueryDeleteImage = $this->brandsModel->where("id", $id)->delete();
            
            if($responseQueryDeleteImage){

                $response = array("status" => true, "message" => "Brand delete successfull", "data" => "", "code" => 200);
            
                return $this->respond($response);

            }else{

                $response = array("status" => true, "message" => "Error in delete the Brand", "data" => "", "code" => 404);
            
                return $this->respond($response);

            }
            

            
            
        }else{

            $response = array("status" => true, "message" => "Brand not found", "data" => "","code" => 404);
            return $this->respond($response);

        }

    }


    public function getBrandsByCategory($idCategory=null, $idSubcategory=null){

        $method    = strtoupper($this->request->getMethod());

        if($method == 'GET'){

            // Establece el tamaño de la página
            $size = $this->request->getVar('size') ?: 20;

            // Obtiene el número de la página actual desde la solicitud (GET parameter)
            $page = $this->request->getVar('page') ?: 1;

            // Ejecuta la consulta con paginación
            $data = $this->brandsModel->select(['id AS value','name AS label'])->where('brands.deleted_at', NULL)
                                      ->where('brands.category_id',$idCategory)
                                      ->where('brands.subcategory_id',$idSubcategory)
                                      ->paginate($size, 'default', $page);

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

}