<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use App\Models\SubCategoriesModel;
use App\Models\SubCategoriesImageModel;


class SubCategoriesController extends ResourceController{
    
    protected $subCategoriesModel;
    protected $subCategoriesImageModel;
    protected $format = 'json';
    protected $message;
    protected $validateArray;

    public function __construct(){

        $this->subCategoriesModel       = new SubCategoriesModel();
        $this->subCategoriesImageModel  = new SubCategoriesImageModel();
        $this->message                  = "SubCategories Found";
        $this->messageError             = "SubCategories not Found";
        $this->validateArray            = ['', null, NULL];

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
        $data = $this->subCategoriesModel->select('subcategories.id, subcategories.id_categories, subcategories.id_user, 
                                        subcategories.name, subcategories.slug,subcategories.description, 
                                        subcategories.keywords, subcategories.icon,
                                        subcategories.created_at, subcategories.deleted_at,
                                        subcategoriesimages.image')
                            ->join('subcategoriesimages', 'subcategories.id = subcategoriesimages.id_subcategories')
                            ->where('subcategories.deleted_at', NULL)
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
      

    public function show($id = null){

        $method = strtoupper($this->request->getMethod());

        if($method === 'GET'){

            if( in_array($id, $this->validateArray, true) ){

                $this->message = 'El id de la categoría no es válido.';

                $response = [
                    'status' => 400,
                    'error' => $this->message,
                    'data' => null,
                    'message' => $this->message
                    ];
                
                return $this->respond($response);

            }


            $query = $this->subCategoriesModel->select('subcategories.id, subcategories.id_categories, subcategories.id_user, 
                                                        subcategories.name, subcategories.slug,subcategories.description, 
                                                        subcategories.keywords, subcategories.icon,
                                                        subcategories.created_at, subcategories.deleted_at,
                                                        subcategoriesimages.image')
                                                ->join('subcategoriesimages', 'subcategories.id = subcategoriesimages.id_subcategories')
                                                ->where('subcategories.id', $id)
                                                ->where('subcategories.deleted_at', NULL);

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
        
        $image    = $this->request->getFile('image');
        $keywords = $this->request->getPost("keywords");

        $this->message = "The fields are required. ";
        
        $data = array("id_categories" => $this->request->getPost("id_categories"),
                      "id_user"       => 1,
                      "name"          => $this->request->getPost("name"),
                      "slug"          => $this->request->getPost("slug"),
                      "description"   => $this->request->getPost("description"),
                      "keywords"      => $keywords,
                      "icon"          => 'ICON');

        $responseValidate = $this->validateInfo($data);

        if( !empty($responseValidate) ){

            $response = array("status"  => false, 
                              "message" => "The fields are required. ", 
                              "data"    => $this->message,
                              "code"    => 500);

            return $this->respond($response);

        }

        $responseQuery = $this->subCategoriesModel->insert($data);

        if($responseQuery){

            $newId = $this->subCategoriesModel->insertID();

            $queryResponseImage = $this->saveImage($newId, $image, $keywords);

            if($queryResponseImage){

                $response = [
                    'status'    => $queryResponseImage['status'],
                    'message'   => 'SubCategory create successfull',
                    'data'      => $queryResponseImage['newId'],
                    'code'      => 200
                ];

                return $this->respond($response); 

            }else{

                $response = array('status'   => false,
                                  'message'  => 'SubCategory Image not was create successfull',
                                  'data'     => "",
                                  'code'     => 500);

                return $this->respond($response);

            }

        }else{

            $response = array('status'   => false,
                              'message'  => 'SubCategory not was create successfull',
                              'data'     => "",
                              'code'      => 500);

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

        $image = $this->request->getFile('image');

        if($image == null){

            $image = $this->request->getPost("image");

        }

        $keywords = $this->request->getPost("keywords");

        $dataCategory = array("id_user"     => 1,
                            "id_categories" => $this->request->getPost("id_categories"),
                              "name"        => $this->request->getPost("name"),
                              "slug"        => $this->request->getPost("slug"),
                              "description" => $this->request->getPost("description"),
                              "keywords"    => $keywords,
                              "icon"        => $this->request->getPost("icon"));
        
        $validate = $this->validateRegister($id);

        if($validate){

            $responseQuery = $this->subCategoriesModel->set($dataCategory)
                                   ->where('id', $id)
                                   ->update();

            if($responseQuery){
    
                $responseQueryImage = $this->updateImage($id, $image, $keywords);
    
                if($responseQueryImage){
    
                    $response = [
                        'status'    => $responseQueryImage['status'],
                        'message'   => 'Category update successfull',
                        'data'      => ""
                    ];
    
                    return $this->respond($response); 
    
                }else{

                    $response = array("status" => 404, "message" => "Error in update Category", "data" => "");
                    return $this->respond($response);
                
                }
    
            }else{
            
                $response = array("status" => 404, "message" => "Category not found", "data" => "");
                return $this->respond($response);    
            
            }

        }else{

            $response = array("status" => 404, "message" => "Category not found", "data" => "");
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


    public function saveImage($id_categories = null, $image = null, $keywords = ""){
        // Obtener el archivo
        $image = $image;
    
        // Validar si es una imagen y si fue subida correctamente
        if ($image->isValid() && !$image->hasMoved()) {
            // Validar el tipo de archivo
            
            /*$validated = $this->validate([
                'image' => [
                    'uploaded[image]',
                    'mime_in[image,image/jpg,image/jpeg,image/gif,image/png]',
                    'max_size[image,2048]', // Tamaño máximo de 2MB
                ],
            ]);*/

            $validated = true;

            if ($validated) {
            
                // Generar un nombre único para la imagen
                $originalName = pathinfo($image->getName(), PATHINFO_FILENAME);
                $newName = $originalName.'_'.$image->getRandomName();
    
                // Mover la imagen a la carpeta 'asset/image'
                $image->move(ROOTPATH . 'public/assets/img/subcategories/', $newName);
    
                // Preparar los datos para guardar en la base de datos
                $dataImage = [
                    'id_subcategories' => $id_categories,
                    'image'             => '/assets/img/subcategories/'.$newName,
                    'keywords'          => $keywords,
                ];
    
                // Insertar los datos en la base de datos
                $queryRresponse = $this->subCategoriesImageModel->insert($dataImage);
                
                if($queryRresponse){

                    $newId    = $this->subCategoriesImageModel->insertID();

                    $response = array("status" => true, "newId" => $newId, "code" => 200);
    
                    return $response;

                }else{

                    $response = array("status" => false, "newId" => "", "code" => 404);
    
                    return $response;

                }

               
            } else {
                // Manejar la validación fallida
                $errors = $this->validator->getErrors();
                return "Validation failed: " . implode(', ', $errors);
            }
        } else {
            return "Invalid image file or no file uploaded.";
        }
    }


    public function updateImage($id_categories = null, $image = null, $keywords = ""){

        $validate = $this->validateImage($id_categories);

        if($validate["status"]){

            // Obtener el archivo
            $image = $image;
        
            // Validar si es una imagen y si fue subida correctamente
            if (!is_string($image) && $image->isValid() && !$image->hasMoved()) {
                // Validar el tipo de archivo
                $validated = $this->validate([
                    'image' => [
                        'uploaded[image]',
                        'mime_in[image,image/jpg,image/jpeg,image/gif,image/png]',
                        'max_size[image,2048]', // Tamaño máximo de 2MB
                    ],
                ]);
        
                if ($validated) {
                    // Generar un nombre único para la imagen
                    $originalName = pathinfo($image->getName(), PATHINFO_FILENAME);
                    $newName = $originalName.'_'.$image->getRandomName();
        
                    // Mover la imagen a la carpeta 'asset/image'
                    $image->move(ROOTPATH . 'public/assets/img/subcategories/', $newName);
        
                    // Preparar los datos para guardar en la base de datos
                    $dataImage = [
                        'id_subcategories' => $id_categories,
                        'image'            => '/assets/img/subcategories/'.$newName,
                        'keywords'         => $keywords,
                    ];
        
                    // Insertar los datos en la base de datos
                    $queryUpdate = $this->subCategoriesImageModel->set($dataImage)->where("id", $validate["id"])->update();
                    
                    if($queryUpdate){
                    
                        $dataResponse = array("status" => true, "data" => $queryUpdate, "code" => 200);

                        return $dataResponse;
                    
                    }else{
                   
                        $dataResponse = array("status" => false, "data" => "", "code" => 404);
                        
                        return $dataResponse;

                    }
                    
                
                } else {
                    // Manejar la validación fallida
                    $errors = $this->validator->getErrors();
                    return "Validation failed: " . implode(', ', $errors);
                }
            }else if((!empty($image) && is_string($image))){

                // Preparar los datos para guardar en la base de datos
                $dataImage = [
                    'id_categories' => $id_categories,
                    'image'         => $image,
                    'keywords'      => $keywords,
                ];

                // Insertar los datos en la base de datos
                $queryUpdate = $this->subCategoriesImageModel->set($dataImage)->where("id", $validate["id"])->update();
                
                if($queryUpdate){
                
                    $dataResponse = array("status" => true, "data" => $queryUpdate, "code" => 200);

                    return $dataResponse;
                
                }else{
                
                    $dataResponse = array("status" => false, "data" => "", "code" => 404);
                    
                    return $dataResponse;

                }

            }else {

                return "Invalid image file or no file uploaded.";
            
            }

        }

    }


    public function validateRegister($id = null){

        if($id){

            $queryValidate = $this->subCategoriesModel->find($id);

            if($queryValidate){

                return true;

            }else{

                return false;

            }

        }

    }

    public function validateImage($id = null){

        if($id){

            $queryValidate = $this->subCategoriesImageModel->where("id_subcategories", $id)->first();

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

            $this->message = 'El id de la categoría no es válido.';

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

            $responseQueryImage = $this->validateImage($id);

            if($responseQueryImage["status"]){

                $responseQueryDeleteImage = $this->subCategoriesImageModel->where("id", $responseQueryImage["id"])->delete();

                if($responseQueryDeleteImage){

                    $responseQueryDelete = $this->subCategoriesModel->where("id",$id)->delete();

                    if($responseQueryDelete){

                        $response = array("status" => true, "message" => "SubCategory and Image delete successfull", "data" => "", "code" => 200);
                        return $this->respond($response);

                    }else{

                        $response = array("status" => true, "message" => "Error SubCategory not delete", "data" => "", "code" => 404);
                        return $this->respond($response); 

                    }

                }else{

                    $response = array("status" => true, "message" => "Error SubCategory Image not delete", "data" => "", "code" => 404);
                    return $this->respond($response); 

                }

            }else{

                $response = array("status" => true, "message" => "SubCategory Image not found", "data" => "", "code" => 404);
                return $this->respond($response);

            }

        }else{

            $response = array("status" => true, "message" => "SubCategory not found", "data" => "","code" => 404);
            return $this->respond($response);

        }

    }

    public function options($id = null){

        $responseQuery = $this->subCategoriesModel->select('id as value, name as label')->where("id_categories",$id)->where('subcategories.deleted_at',NULL)->get()->getResult();
        
        $response = array("status" => true, "message" => "SubCategory list", "data" => $responseQuery, "code" => 200);
        
        return $this->respond($response);

    }

}