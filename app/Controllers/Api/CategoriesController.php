<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use App\Models\CategoriesModel;
use App\Models\CategoriesImageModel;
use App\Models\CategoriesBannerImagesModel;

class CategoriesController extends ResourceController{
    
    protected $categoriesModel;
    protected $CategoriesImageModel;
    protected $CategoriesBannerImagesModel;
    protected $format = 'json';

    public function __construct(){

        $this->categoriesModel      = new CategoriesModel();
        $this->CategoriesImageModel = new CategoriesImageModel();
        $this->CategoriesBannerImagesModel = new CategoriesBannerImagesModel();

    }

    public function validateInfo($dataCategory){

        $errors = [];

        foreach($dataCategory as $key => $value){

            if(empty($value)){

                $errors[$key] = "They $key field is required"; 

            }

        }

        return $errors;


    }

    public function listAllCategories(){
    
        $query = $this->categoriesModel->select('categories.id, categories.name, categories.slug,
                                                 categories.description, categories.keywords, categories.icon,
                                                 categories.created_at, categories.deleted_at,
                                                 categoriesimages.image')
                      ->join('categoriesimages','categories.id = categoriesimages.id_categories')
                      ->where('categoriesimages.deleted_at',NULL);
        
        $categories = $query->get()->getResult();

        if($categories){

            $response = array("status" => 200, "message" => "Categories Found", "data" => $categories);

        }else{
            
            $response = array("status" => 404, "message" => "Categories not Found", "data" => "");
        
        }


        return $this->respond($response);

    }
      

    public function showCategory($id = null){

        $query = $this->categoriesModel->select('categories.id, categories.name, categories.slug,
                                                 categories.description, categories.keywords, categories.icon,
                                                 categories.created_at, categories.deleted_at,
                                                 categoriesimages.image')
                      ->join('categoriesimages','categories.id = categoriesimages.id_categories')
                      ->where('categories.id', $id)
                      ->where('categories.deleted_at', NULL);

        $category = $query->get()->getResult();

        if($category){

            $queryImageBanne = $this->CategoriesBannerImagesModel->select('id, image')
                                                                 ->where('id_categories', $id)
                                                                 ->where('deleted_at', NULL)
                                                                 ->get()
                                                                 ->getResult();

                                                                 
            $arrayCategories = array("category"     => $category,
                                    "imageBanners" => $queryImageBanne);

            $response = array("status" => 200, "message" => "Category Found", "data" => $arrayCategories);

        }else{
            
            $response = array("status" => 404, "message" => "Category not Found", "data" => "");
        
        }


        return $this->respond($response);

    }

    public function createCategory(){
        
        $imageBanner = $this->request->getFileMultiple('imageBanner');
        $image       = $this->request->getFile('image');
        $keywords    = $this->request->getPost("keywords");

        $dataCategory = array("id_user"     => 1,
                              "name"        => $this->request->getPost("name"),
                              "slug"        => $this->request->getPost("slug"),
                              "description" => $this->request->getPost("description"),
                              "keywords"    => $keywords,
                              "icon"        => 'ICON');

        $responseValidate = $this->validateInfo($dataCategory);

        if( !empty($responseValidate) ){

            $response = array("status"  => false, 
                              "message" => "The fields are required. ", 
                              "data"    => $responseValidate,
                              "code"    => 500);

            return $this->respond($response);

        }

        $queryCategory = $this->categoriesModel->insert($dataCategory);

        if($queryCategory){

            $newId = $this->categoriesModel->insertID();

            $queryCategoryImage = $this->saveCategoryImage($newId, $image, $keywords);

            if($queryCategoryImage){

                if($imageBanner != null){

                    foreach ($imageBanner as $file) {
                        $queryCategoryImageBanner = $this->saveCategoryImage($newId, $file, $keywords, "banner");
                    }

                }

                $response = [
                    'status'    => true,
                    'message'   => 'Category create successfull',
                    'data'      => $newId,
                    'code'      => 200
                ];

                return $this->respond($response); 

            }else{

                $response = array('status'   => false,
                                  'message'  => 'Category Image not was create successfull',
                                  'data'     => "",
                                  'code'     => 500);

                return $this->respond($response);

            }

        }else{

            $response = array('status'   => false,
                              'message'  => 'Category not was create successfull',
                              'data'     => "",
                              'code'      => 500);

            return $this->respond($response);

        }

    }
      
    public function createCategoryMany(){
        
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
            
            $queryCategory = $this->categoriesModel->insert($dataCategory);

                if($queryCategory){
        
                    $newId = $this->categoriesModel->insertID();
        
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


    public function updateCategory($id = null){

        $imageBanner = $this->request->getFileMultiple('imageBanner');
        $image       = $this->request->getFile('image');

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

            $queryCategory = $this->categoriesModel->set($dataCategory)
                                   ->where('id', $id)
                                   ->update();

            if($queryCategory){
    
                $queryCategoryImage = $this->updateCategoryImage($id, $image, $keywords);
    
                if($queryCategoryImage){
                    
                    if($imageBanner != null){
                        
                        foreach ($imageBanner as $file) {
                            $queryCategoryImageBanner = $this->saveCategoryImage($id, $file, $keywords, "banner");
                        }

                    }
        
                    $response = [
                        'status'    => true,
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


    public function saveCategoryImage($id_categories = null, $image = null, $keywords = "", $banner=""){
        // Obtener el archivo
        $image = $image;
    
        // Validar si es una imagen y si fue subida correctamente
        if ($image->isValid() && !$image->hasMoved()) {
            // Validar el tipo de archivo
            $validated = $this->validate([
                'image' => [
                    'uploaded[image]',
                    'mime_in[image,image/jpg, image/jpeg, image/gif, image/png, image/webp]',
                    'max_size[image,2048]', // Tamaño máximo de 2MB
                ],
            ]);

            $validated = true;
    
            if ($validated) {
                // Generar un nombre único para la imagen
                $originalName = pathinfo($image->getName(), PATHINFO_FILENAME);
                $newName = $originalName.'_'.$image->getRandomName();
    
                // Mover la imagen a la carpeta 'asset/image'
                $banner == "" ? $image->move(ROOTPATH . 'public/assets/img/categories/', $newName) : $image->move(ROOTPATH . 'public/assets/img/categories/banner/', $newName);
            
 
            
                // Preparar los datos para guardar en la base de datos
                $dataCategoryImage = [
                    'id_categories' => $id_categories,
                    'image'         => $banner === "" 
                                        ? '/assets/img/categories/'.$newName 
                                        : '/assets/img/categories/banner/'.$newName,
                    'keywords'      => $keywords,
                ];
    
                // Insertar los datos en la base de datos
                if($banner == ""){

                    $this->CategoriesImageModel->insert($dataCategoryImage);
                    $newId        = $this->CategoriesImageModel->insertID();
                    $dataResponse = array("status" => true, "newId" => $newId, "code" => 200);

                }else{

                    $this->CategoriesBannerImagesModel->insert($dataCategoryImage);
                    $newId        = $this->CategoriesBannerImagesModel->insertID();
                    $dataResponse = array("status" => true, "newId" => $newId, "code" => 200);

                }

            

                return $dataResponse;
               
            } else {
                // Manejar la validación fallida
                $errors = $this->validator->getErrors();
                return "Validation failed: " . implode(', ', $errors);
            }
        } else {
            return "Invalid image file or no file uploaded.";
        }
    }


    public function updateCategoryImage($id_categories = null, $image = null, $keywords = ""){

        $validate = $this->validateCategoryImage($id_categories);

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
                $validated = true;
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

            $queryValidate = $this->categoriesModel->find($id);

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

                    $responseBannerImagesModel = $this->CategoriesBannerImagesModel->where("id_categories",$id)->delete();
                    
                    if($responseBannerImagesModel){

                        $queryDeleteCategory = $this->categoriesModel->where("id",$id)->delete();

                        if($queryDeleteCategory){
    
                            $response = array("status" => true, "message" => "Category and Category Image delete successfull", "data" => "", "code" => 200);
                            return $this->respond($response);
    
                        }else{
    
                            $response = array("status" => true, "message" => "Error Category not delete", "data" => "", "code" => 404);
                            return $this->respond($response); 
    
                        }
                        
                    }else{
                        $response = array("status" => true, "message" => "Error responseBannerImagesModel not delete", "data" => "", "code" => 404);
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

    public function deleteImageBannerCategory($id = null){

        $queryValidate = $this->CategoriesBannerImagesModel->where("id", $id)->first();

        if($queryValidate){

            $response = $this->CategoriesBannerImagesModel->where("id",$id)->delete();

            if($response){

                $response = array("status" => true, "message" => "Banner Image delete successfull", "data" => "", "code" => 200);
                return $this->respond($response);

            }else{

                $response = array("status" => true, "message" => "Error Banner not delete", "data" => "", "code" => 404);
                return $this->respond($response); 

            }

        }else{

            $response = array("status" => true, "message" => "Error Banner Image not delete", "data" => "", "code" => 404);
            return $this->respond($response); 

        }

           

        

    }

    public function options(){

        $responseQuery = $this->categoriesModel->select('id as value, name as label')->where('categories.deleted_at',NULL)->get()->getResult();
        
        $response = array("status" => true, "message" => "Category list", "data" => $responseQuery, "code" => 200);
        
        return $this->respond($response);

    }

}