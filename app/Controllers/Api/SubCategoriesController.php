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
        $size = $this->request->getVar('size') ?: 3;

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

        // Retorna la respuesta en formato JSON
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
        
        $data = array("id_categories" => 1,
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
      
    public function createMany(){
        
        $image    = $this->request->getFile('image');
        $data     = $this->request->getPost("data");
        $dataJson = json_decode($data);


        foreach($dataJson as $key => $value){
            
            $dataCategory = array("id_user"     => $value->id_user,
                                  "name"        => $value->name,
                                  "slug"        => $value->slug,
                                  "description" => $value->description,
                                  "keywords"    => $value->keywords,
                                  "icon"        => $value->icon);
            
            $queryCategory = $this->subCategoriesModel->insert($dataCategory);

                if($queryCategory){
        
                    $newId = $this->subCategoriesModel->insertID();
        
                    $queryCategoryImage = $this->saveCategoryImage($newId, $image, $value->keywords);
        
                    if($queryCategoryImage){
        
                        $response = [
                            'status'    => $queryCategoryImage['status'],
                            'message'   => 'Category create successfull',
                            'data'      => $queryCategoryImage['newId']
                        ];
        
                        return $this->respond($response); 
        
                    }else{
        
                        $response = array('status'  => 404,
                                        'message'  => 'Category Image not was create successfull',
                                        'data'     => "");
        
                        return $this->respond($response);
        
                    }
        
                }else{
        
                    $response = array('status'  => 404,
                                    'message'  => 'Category not was create successfull',
                                    'data'     => "");
        
                    return $this->respond($response);
        
                }

        }


    }


    public function update($id = null){
        
        $image    = $this->request->getFile('image');

        if($image == null){

            $image = $this->request->getPost("image");

        }

        $keywords = $this->request->getPost("keywords");

        $dataCategory = array("id_user"     => $this->request->getPost("id_user"),
                              "name"        => $this->request->getPost("name"),
                              "slug"        => $this->request->getPost("slug"),
                              "description" => $this->request->getPost("description"),
                              "keywords"    => $keywords,
                              "icon"        => $this->request->getPost("icon"));
        
        $validate = $this->validateCategory($id);

        if($validate){

            $queryCategory = $this->subCategoriesModel->set($dataCategory)
                                   ->where('id', $id)
                                   ->update();

            if($queryCategory){
    
                $queryCategoryImage = $this->updateCategoryImage($id, $image, $keywords);
    
                if($queryCategoryImage){
    
                    $response = [
                        'status'    => $queryCategoryImage['status'],
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


    public function saveImage($id_categories = null, $image = null, $keywords = ""){
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
    
            if ($validated) {
                // Generar un nombre único para la imagen
                $originalName = pathinfo($image->getName(), PATHINFO_FILENAME);
                $newName = $originalName.'_'.$image->getRandomName();
    
                // Mover la imagen a la carpeta 'asset/image'
                $image->move(ROOTPATH . 'public/assets/img/categories/', $newName);
    
                // Preparar los datos para guardar en la base de datos
                $dataImage = [
                    'id_subcategories' => $id_categories,
                    'image'             => '/assets/img/categories/'.$newName,
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
                    $image->move(ROOTPATH . 'public/assets/img/categories/', $newName);
        
                    // Preparar los datos para guardar en la base de datos
                    $dataCategoryImage = [
                        'id_categories' => $id_categories,
                        'image'         => '/assets/img/categories/'.$newName,
                        'keywords'      => $keywords,
                    ];
        
                    // Insertar los datos en la base de datos
                    $queryUpdate = $this->CategoriesImageModel->set($dataCategoryImage)->where("id", $validate["id"])->update();
                    
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
                $dataCategoryImage = [
                    'id_categories' => $id_categories,
                    'image'         => $image,
                    'keywords'      => $keywords,
                ];

                // Insertar los datos en la base de datos
                $queryUpdate = $this->CategoriesImageModel->set($dataCategoryImage)->where("id", $validate["id"])->update();
                
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


    public function validateCategory($id = null){

        if($id){

            $queryValidate = $this->subCategoriesModel->find($id);

            if($queryValidate){

                return true;

            }else{

                return false;

            }

        }

    }

    public function validateCategoryImage($id = null){

        if($id){

            $queryValidate = $this->CategoriesImageModel->where("id_categories", $id)->first();

            if($queryValidate){

                $response = array("status" => true, "id" => $queryValidate->id, "code" => 200);
                
                return $response;
            
            }else{

                return false;
            
            }

        }

    }

    public function deleteCategory($id = null){

        $queryCategory = $this->validateCategory($id);

        if($queryCategory){

            $queryCategoryImage = $this->validateCategoryImage($id);

            if($queryCategoryImage["status"]){

                $queryDeleteCategoryImage = $this->CategoriesImageModel->where("id", $queryCategoryImage["id"])->delete();

                if($queryDeleteCategoryImage){

                    $queryDeleteCategory = $this->subCategoriesModel->where("id",$id)->delete();

                    if($queryDeleteCategory){

                        $response = array("status" => true, "message" => "Category and Category Image delete successfull", "data" => "", "code" => 200);
                        return $this->respond($response);

                    }else{

                        $response = array("status" => true, "message" => "Error Category not delete", "data" => "", "code" => 404);
                        return $this->respond($response); 

                    }

                }else{

                    $response = array("status" => true, "message" => "Error Category Image not delete", "data" => "", "code" => 404);
                    return $this->respond($response); 

                }

            }else{

                $response = array("status" => true, "message" => "Category Image not found", "data" => "", "code" => 404);
                return $this->respond($response);

            }

        }else{

            $response = array("status" => true, "message" => "Category not found", "data" => "","code" => 404);
            return $this->respond($response);

        }

    }

}