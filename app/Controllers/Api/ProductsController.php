<?php

namespace App\Controllers\api;
use CodeIgniter\RESTful\ResourceController;
use App\Models\ProductsModel;
use App\Models\ProductsImageModel;
use App\Models\ProductSizeModel;
use App\Models\ProductColorModel;
use App\Models\ProductQuantityColorModel;


class ProductsController extends ResourceController{

    protected $productModel;
    protected $productImageModel;
    protected $productSizeModel;
    protected $productColorModel;
    protected $productQuantityModel;
    protected $format = "json";
    protected $message;
    protected $validateArray;

    public function __construct(){
        $this->productModel         = new ProductsModel();
        $this->productImageModel    = new ProductsImageModel();
        $this->productSizeModel     = new ProductSizeModel();
        $this->productColorModel    = new ProductColorModel();
        $this->productQuantityModel = new ProductQuantityColorModel();
        $this->validateArray        = ['', null, NULL];
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

    public function saveImage($id = null, $image = null, $keywords = "", $name_category = ""){
        
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
                $image->move(ROOTPATH . 'public/assets/img/products/'.$name_category.'/', $newName);
    
                // Preparar los datos para guardar en la base de datos
                $dataImage = [
                    'id_product' =>  $id,
                    'image'      => '/assets/img/products/'.$name_category.'/'.$newName,
                    'keywords'   => $keywords,
                ];
    
                // Insertar los datos en la base de datos
                $queryRresponse = $this->productImageModel->insert($dataImage);
                
                if($queryRresponse){

                    $newId    = $this->productImageModel->insertID();

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

    /* ======================================
                CREATE PRODUCT
       ====================================== */
    
    public function create(){
        
        $images         = $this->request->getFiles();
        $keywords       = $this->request->getPost("keywords");
        $sizes          = $this->request->getPost("sizes");
        $name_category  = $this->request->getPost("name_category");

        $this->message = "The fields are required. ";
        
        $data = array("id_subcategories"    => $this->request->getPost("id_subcategories"),
                        "id_categories"     => $this->request->getPost("id_categories"),
                        "id_user"           => 1,
                        "name"              => $this->request->getPost("name"),
                        "slug"              => $this->request->getPost("slug"),
                        "description"       => $this->request->getPost("description"),
                        "details"           => $this->request->getPost("details"),
                        "specifications"    => $this->request->getPost("specifications"),
                        "keywords"          => $keywords,
                        "purchase_price"    => $this->request->getPost("purchase_price"),
                        "percentage_profit" => $this->request->getPost("percentage_profit"),
                        "sale_price"        => $this->request->getPost("sale_price"),
                        "discount"          => $this->request->getPost("discount"));

        $responseValidate = $this->validateInfo($data);

        if( !empty($responseValidate) ){

            $response = array("status"  => false, 
                              "message" => "The fields are required. ", 
                              "data"    => $this->message,
                              "code"    => 500);

            return $this->respond($response);

        }

        $responseQuery = $this->productModel->insert($data);

        if($responseQuery){

            $newId = $this->productModel->insertID();

            foreach ($images['images'] as $key => $image){

                $queryResponseImage = $this->saveImage($newId, $image, $keywords, $name_category);
           
            }


            foreach($sizes as $key => $size){
                
                $size["id"] = $newId;

                $this->createSize($size);

            }

            $response = array('status'   => true,
                              'message'  => 'Product create successfull',
                              'data'     => "",
                              'code'     => 200);

            return $this->respond($response);

        }else{

            $response = array('status'   => false,
                                'message'  => 'Product not was create successfull',
                                'data'     => "",
                                'code'      => 500);

            return $this->respond($response);

        }

    }


    public function createSize($size){

        if($size){
     
            $newSize = array("id_product" => $size["id"], "size" =>$size["size"]);

            $queryResponseSize = $this->productSizeModel->insert($newSize);

            if($queryResponseSize){

                $sizeNewId = $this->productSizeModel->insertID();

                $this->createColor($sizeNewId, $size["color"], $size["quantity"]);
            }
        }

    }

    public function createColor($id_productsize, $color, $quantity){

        if($id_productsize && $color){
            
            $color = array("id_productsize" => $id_productsize, "color" => $color);

            $queryResponseColor = $this->productColorModel->insert($color);

            if($queryResponseColor){

                $colorNewId = $this->productColorModel->insertID();

                $this->createQuantity($colorNewId, $quantity);

            }
        }

    }

    public function createQuantity($id_productcolor, $count){

        $quantity = array("id_productcolor" => $id_productcolor, "count" => $count);

        $queryResponseColor = $this->productQuantityModel->insert($quantity);

    }

    /* ======================================
                END CREATE PRODUCT
       ====================================== */


    /* ==================================
             UPDATE PRODUCT
       ================================== */
    public function updateProduct($id){

        $images         = $this->request->getFiles();
        $keywords       = $this->request->getPost("keywords");
        $sizes          = $this->request->getPost("sizes");
        $name_category  = $this->request->getPost("name_category");

        $this->message = "The fields are required. ";
        
        $data = array("id_subcategories"    => $this->request->getPost("id_subcategories"),
                        "id_categories"     => $this->request->getPost("id_categories"),
                        "id_user"           => 1,
                        "name"              => $this->request->getPost("name"),
                        "slug"              => $this->request->getPost("slug"),
                        "description"       => $this->request->getPost("description"),
                        "details"           => $this->request->getPost("details"),
                        "specifications"    => $this->request->getPost("specifications"),
                        "keywords"          => $keywords,
                        "purchase_price"    => $this->request->getPost("purchase_price"),
                        "percentage_profit" => $this->request->getPost("percentage_profit"),
                        "sale_price"        => $this->request->getPost("sale_price"),
                        "discount"          => $this->request->getPost("discount"));

        $responseValidate = $this->validateInfo($data);

        if( !empty($responseValidate) ){

            $response = array("status"  => false, 
                                "message" => "The fields are required. ", 
                                "data"    => $this->message,
                                "code"    => 500);

            return $this->respond($response);

        }

        $responseQuery = $this->productModel->set($data)
                                            ->where('id', $id)
                                            ->update();

        if($responseQuery){

            if( !in_array($images, $this->validateArray, true) ){

                if( count($images) > 0 ){
                
                    foreach ($images['images'] as $key => $image){
    
                        $queryResponseImage = $this->saveImage($id, $image, $keywords, $name_category);
                   
                    }
    
                }

            }


            if( !in_array($sizes, $this->validateArray, true) ){

                if( count($sizes) > 0){

                    foreach($sizes as $key => $size){
                    
                        $size["id"] = $id;
        
                        $this->createSize($size);
        
                    }

                }

            }

            $response = array("status"  => true, 
                              "message" => "SUCCESS", 
                              "data"    => $this->message,
                              "code"    => 200);

            return $this->respond($response);

        }else{

            $response = array("status"  => false, 
                              "message" => "ERROR ", 
                              "data"    => $this->message,
                              "code"    => 500);

            return $this->respond($response);

        }
    }

    /* ==================================
             END UPDATE PRODUCT
    ==================================== */
    public function listAll(){

        $method    = strtoupper($this->request->getMethod());
    
        if($method == 'GET'){
   
           // Establece el tamaño de la página
           $size = $this->request->getVar('size') ?: 1000;
   
           // Obtiene el número de la página actual desde la solicitud (GET parameter)
           $page = $this->request->getVar('page') ?: 1;
   
           // Ejecuta la consulta con paginación
           $data = $this->productModel->orderBy('id', 'DESC')->paginate($size, 'default', $page);
   
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

                $this->message = 'El id de la product no es válido.';

                $response = [
                    'status' => 400,
                    'error' => $this->message,
                    'data' => null,
                    'message' => $this->message
                    ];
                
                return $this->respond($response);

            }

            $arrayProductos = array("product" => [],
                                    "image"   => [],
                                    "size"    => []);

            $query = $this->productModel->where('products.id', $id)->where('products.deleted_at', NULL);

            $responseQuery = $query->get()->getResult();
            
            if($responseQuery){

                $arrayProductos["product"] = $responseQuery;

                $responseImage = $this->showImage($id);

                if($responseImage){

                    $arrayProductos["image"] = $responseImage;

                    $responseSize = $this->showSize($id);
                    
                    if($responseSize){

                        $arrayProductos["size"] = $responseSize;

                    }

                }

                $response = array("status" => 200, "message" => $this->message, "data" => $arrayProductos);

            }else{

                $response = array("status" => 404, "message" => $this->messageError, "data" => "");

            }


            return $this->respond($response);
        }

    }

    public function showImage($id){
        $query = $this->productImageModel->where("id_product", $id)->where('productimages.deleted_at', NULL)->get()->getResult();
        return $query;
    }

    public function showSize($id){
        $query = $this->productSizeModel->select('productsize.id as id, productsize.size as size,
                                                  productcolor.id as idColor, productcolor.color as color,
                                                  productquantity.id as idQuantity, productquantity.count as quantity
                                                ')
                                        ->join('productcolor',     'productcolor.id_productsize = productsize.id')
                                        ->join('productquantity',  'productquantity.id_productcolor = productcolor.id')
                                        ->where("productsize.id_product", $id)
                                        ->where('productsize.deleted_at', NULL)
                                        ->get()
                                        ->getResult();
        return $query;
    }

    public function showColor($id){
        $query = $this->productColorModel->where("id_productsize", $id)->get()->getResult();
        return $query;
    }

    public function showQuantity($id){
        $query = $this->productQuantityModel->where("id_productcolor", $id)->get()->getResult();
        return $query;
    }

    /* ============================
                DELETE
      ============================= */
    public function deleteSize($idSize, $idColor, $idQuantity){

        $responseQuerySize = $this->productSizeModel->where("id",$idSize)->delete();

        if($responseQuerySize){

            $responseQueryQuantity = $this->productQuantityModel->where("id", $idQuantity)->delete();

            if($responseQueryQuantity){

                $responseQueryColor = $this->productColorModel->where("id", $idColor)->delete();

                if($responseQueryColor){

                    $response = array("status" => 200, "message" => "Delete record sucessfull", "data" => "");

                    return $this->respond($response); 

                }else{

                    $response = array("status" => 404, "message" => "value not found responseQueryColor", "data" => "");
                    return $this->respond($response); 

                }

            }else{

                $response = array("status" => 404, "message" => "value not found responseQueryQuantity", "data" => "");
                return $this->respond($response);

            }

        }else{

            $response = array("status" => 404, "message" => "value not found responseQuerySize", "data" => "");
            return $this->respond($response);
        }
    }

    public function deleteImage($id){
        
        $responseQuery = $this->productImageModel->where('id', $id)->delete();

        if($responseQuery){

            $response = array("status" => 200, "message" => "Delete Image successfull", "data" => "");
            return $this->respond($response);

        }else{

            $response = array("status" => 404, "message" => "value not found Image", "data" => "");
            return $this->respond($response);

        }

    }

    public function deleteProduct($id){
        if (!$this->productModel->where("id", $id)->delete()) {
            return $this->respondWithError("Error in removing the product");
        }
    
        if (!$this->productImageModel->where("id_product", $id)->delete()) {
            return $this->respondWithError("Error in removing the image of the product");
        }
    
        $productSizes = $this->productSizeModel->where('id_product', $id)->get()->getResult();
        if (!$productSizes) {
            return $this->respondWithError("Error in selecting the size");
        }
    
        if (!$this->productSizeModel->where('id_product', $id)->delete()) {
            return $this->respondWithError("Error in removing the size");
        }
    
        foreach ($productSizes as $productSize) {
            
            $productColors = $this->productColorModel->where('id_productsize', $productSize->id)->get()->getResult();
            
            if (!$productColors) {
                return $this->respondWithError("Error in selecting the color");
            }

            if (!$this->productColorModel->where('id_productsize',$productSize->id)->delete()) {
                return $this->respondWithError("Error in removing the color");
            }
    
            foreach ($productColors as $productColor) {
                if (!$this->productQuantityModel->where('id_productcolor', $productColor->id)->delete()) {
                    return $this->respondWithError("Error in removing the quantity");
                }
            }
            
        }
    
        return $this->respond(array("status" => 200, "message" => "Product deleted successfully", "data" => ""));
    }

    function respondWithError($message)
    {
        return $this->respond(array("status" => 404, "message" => $message, "data" => ""));
    }
    /* ============================
                ENDDELETE
       ============================= */
}