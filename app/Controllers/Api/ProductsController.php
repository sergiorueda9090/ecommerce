<?php

namespace App\Controllers\api;
use CodeIgniter\RESTful\ResourceController;
use App\Models\ProductsModel;
use App\Models\ProductAttributesModel;
use App\Models\ValueAttributesModel;

use App\Models\ProductsImageModel;
use App\Models\ProductSizeModel;
use App\Models\ProductColorModel;
use App\Models\ProductQuantityColorModel;


class ProductsController extends ResourceController{

    protected $productModel;
    protected $productAttributesModel;
    protected $valueAttributesModel;
    protected $productImageModel;
    protected $productSizeModel;
    protected $productColorModel;
    protected $productQuantityModel;
    protected $format = "json";
    protected $message;
    protected $validateArray;

    public function __construct(){
        $this->productModel            = new ProductsModel();
        $this->productAttributesModel = new ProductAttributesModel();
        $this->valueAttributesModel   = new ValueAttributesModel();

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
    

    public function saveImage($id = null, $image = null, $keywords = "", $name_category = "", $name_subcategory = "", $newIdColor = null) {
        // Obtener el archivo
        $image = $image;
    
        // Validar si es una imagen y si fue subida correctamente
        if ($image->isValid() && !$image->hasMoved()) {
            // Validar el tipo de archivo
            $validated = true; // Ajustar según sea necesario.
    
            if ($validated) {
                // Generar un nombre único para la imagen
                $originalName = pathinfo($image->getName(), PATHINFO_FILENAME);
                
                // Limpiar el nombre original y la categoría para que sean seguros en la URL
                $safeName     = $this->sanitizeString($originalName);
                $safeCategory = $this->sanitizeString($name_category);
    
                $newName = $safeName . '_' . $image->getRandomName();
    
                // Mover la imagen a la carpeta 'asset/image' con el nuevo nombre
                $image->move(ROOTPATH . 'public/assets/img/products/' . $safeCategory, $newName);
    
                // Preparar los datos para guardar en la base de datos
                $dataImage = [
                    'id_product' => $id,
                    'id_color' => $newIdColor,
                    'image' => '/assets/img/products/' . $safeCategory . '/' . $newName,
                    'keywords' => $keywords
                ];
    
                // Insertar en la base de datos
                $queryResponse = $this->productImageModel->insert($dataImage);
                if ($queryResponse) {
                    return "Image saved successfully.";
                } else {
                    return "Error saving image to the database.";
                }
            } else {
                // Manejar la validación fallida
                $errors = $this->validator->getErrors();
                return array("status" => false, "message" => "Error", "data" => "Validation failed: " . implode(', ', $errors));
            }
        } else {
            return "Invalid image file or no file uploaded.";
        }
    }

    /**
     * Sanitiza una cadena para que sea segura en URLs o nombres de archivo.
     *
     * @param string $string
     * @return string
     */
    private function sanitizeString($string) {
        // Convertir a minúsculas
        $string = strtolower($string);
        // Reemplazar espacios por guiones
        $string = str_replace(' ', '-', $string);
        // Eliminar caracteres no permitidos
        $string = preg_replace('/[^a-z0-9\-]/', '', $string);
        // Eliminar guiones consecutivos
        $string = preg_replace('/\-+/', '-', $string);
        // Retornar el nombre limpio
        return trim($string, '-');
    }

    /* ======================================
                CREATE PRODUCT
       ====================================== */
    
    public function create(){
        
        $files  = $this->request->getFiles();

        if (empty($files) || !is_array($files)) {
            return [
                'status'  => false,
                'message' => 'Files are required.',
                'data'    => null,
                'code'    => 400
            ];
        }

        //$sizes          = $this->request->getPost("sizes");
 
        $arrayAttributes  = $this->request->getPost("arrayAttributes");

        // Verificar que arrayAttributes esté presente, no esté vacío y sea un array
        if (empty($arrayAttributes) || !is_array($arrayAttributes)) {
            return [
                'status'  => false,
                'message' => 'arrayAttributes is required and must be a non-empty array.',
                'data'    => null,
                'code'    => 400
            ];
        }


        // Obtén los límites de PHP
        $maxUploads = ini_get("max_file_uploads");
        $maxFileSize = $this->parseSize(ini_get("upload_max_filesize"));
        $postMaxSize = $this->parseSize(ini_get("post_max_size"));

        // Verificar el número de archivos
        $fileCount = 0;
        $totalSize = 0;

        foreach ($files as $file) {
            // Manejo de archivos múltiples o individuales
            if (is_array($file)) {
                foreach ($file as $singleFile) {
                    $fileCount++;
                    $totalSize += $this->checkFileSize($singleFile, $maxFileSize);
                }
            } else {
                $fileCount++;
                $totalSize += $this->checkFileSize($file, $maxFileSize);
            }
        }

        // Verificar límite de cantidad de archivos
        if ($fileCount > $maxUploads) {
            return $this->response->setJSON([
                'status'  => false,
                'message' => "Se excede el número máximo de archivos permitidos: $maxUploads.",
                'data'    => null,
                'code'    => 400
            ]);
        }

        // Verificar el tamaño total de la carga
        if ($totalSize > $postMaxSize) {
            return $this->response->setJSON([
                'status'  => false,
                'message' => "El tamaño total de los archivos excede el máximo permitido de " . ini_get("post_max_size") . ".",
                'data'    => null,
                'code'    => 400
            ]);
        }


        $attribute        = $this->request->getPost("attribute");
        $description      = $this->request->getPost("description");
        $details          = $this->request->getPost("details");

        $discount          = $this->request->getPost("discount");
        $id_categories     = $this->request->getPost("id_categories");
        $id_category       = $this->request->getPost("id_category");
        $id_subcategories  = $this->request->getPost("id_subcategories");
        $id_user           = 1;

        $keywords = $this->request->getPost("keywords");
        $keywords = !empty($keywords) ? implode(", ", $keywords) : null;
        if (is_null($keywords)) {
            return $this->respond([
                "status"  => false,
                "message" => "The fields are required.",
                "data"    => "Keywords are required and cannot be empty.",
                "code"    => 500
            ]);
        }

        $name              = $this->request->getPost("name");
        $name_category     = $this->request->getPost("name_category");
        $name_subcategory  = $this->request->getPost("name_subcategory");
        $percentage_profit = $this->request->getPost("percentage_profit");
        $purchase_price    = $this->request->getPost("purchase_price");
        $originalPrice     = $this->request->getPost("originalPrice");

        $sale_price     = $this->request->getPost("sale_price");
        $slug           = $this->request->getPost("slug");
        $specifications = $this->request->getPost("specifications");
        // Validar que specifications tenga un valor y sea un array
        if (empty($specifications) || !is_array($specifications)) {
            return $this->respond([
                "status"  => false,
                "message" => "The fields are required.",
                "data"    => "specifications are required and cannot be empty.",
                "code"    => 500
            ]);
        }

        $this->message = "The fields are required. ";
        
        $data = array("id_subcategories"    => $id_subcategories,
                        "id_categories"     => $id_categories,
                        "id_user"           => 1,
                        "name"              => $name,
                        "slug"              => $slug,
                        "description"       => $description,
                        "details"           => $details,
                        "specifications"    => json_encode($specifications),
                        "keywords"          => $keywords,
                        "purchase_price"    => $purchase_price,
                        "percentage_profit" => $percentage_profit,
                        "sale_price"        => $sale_price,
                        "originalPrice"     => $originalPrice,
                        "discount"          => $discount);

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
            
            $dataAttribute          = array("id_product" => $newId, "name" => $attribute);
            $responseQueryAttribute = $this->productAttributesModel->insert($dataAttribute);
            
            if($responseQueryAttribute){

                $newIdAtt = $this->productAttributesModel->insertID();

                // Array para almacenar los colores únicos y sus imágenes
                $uniqueImagesByColor = [];

                foreach ($arrayAttributes as $key => $arrayAttribute){
                   
                    // Guardar el valor de atributo
                    $dataValueAttribute = [
                        "id_product"            => $newId,
                        "id_productattributes"  => $newIdAtt,
                        "name"                  => $arrayAttribute['value']
                    ];

                    $responseQueryValueAtt = $this->valueAttributesModel->insert($dataValueAttribute);

                    if($responseQueryValueAtt){

                        $newIdValueAttr = $this->valueAttributesModel->insertID();
                        
                        // Guardar el color asociado con el atributo
                        $dataColor = [
                            "id_product"     => $newId,
                            "id_productsize" => $newIdValueAttr,
                            "color"          => $arrayAttribute['color']
                        ]; 

                        $responseQueryColor = $this->productColorModel->insert($dataColor);

                        if($responseQueryColor){
                            
                            $newIdColor = $this->productColorModel->insertID();
                            
                            // Verificar si el color ya fue procesado para evitar duplicados
                            $dataQuantity = ["id_productcolor" => $newIdColor, "count" => $arrayAttribute['cantidad'], "id_product" => $newId,];
                            $responseQueryQuantity = $this->productQuantityModel->insert($dataQuantity);

                            if($responseQueryQuantity){

                                $color = $arrayAttribute['color'];

                                if (!isset($uniqueImagesByColor[$color])) {

                                    $uniqueImagesByColor[$color] = $arrayAttribute['images'];
            
                                    // Guardar las imágenes de este color único
                                    foreach ($uniqueImagesByColor[$color] as $imageData) {
                                        // Llamar a la función saveImage para cada imagen
                                        // Suponiendo que `$imageData` es un objeto con los métodos necesarios.
                                        $n = $imageData["name"];
                                        
                                        $selectedFile = "";
                                       

                                        foreach ($files['images'] as $file) {
                                            // Verificar si el nombre del archivo coincide
                                            if ($file->getClientName() === $imageData["name"]) {
                                                $selectedFile = $file; // Guardar el archivo seleccionado
                                                break; // Salir del bucle si se encuentra el archivo
                                            }
                                        }
                                        $this->saveImage(
                                            $newId,                          // ID del producto
                                            $selectedFile,                      // Imagen a procesar
                                            $keywords,                              // Palabras clave
                                            $name_category,          // Categoría del producto
                                            $name_subcategory,       // Subcategoría del producto
                                            $newIdColor                      // ID del color
                                        );
                                    }
                                }

                            }
                    
                        }

                    }
                }
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

    // Verificar y sumar tamaño de archivo, lanzando error si excede el límite
    private function checkFileSize($file, $maxFileSize) {
        if ($file->getSize() > $maxFileSize) {
            throw new \RuntimeException("El archivo '{$file->getName()}' excede el tamaño máximo permitido de " . ini_get("upload_max_filesize") . ".");
        }
        return $file->getSize();
    }

    // Función auxiliar para convertir el tamaño a bytes
    private function parseSize($size) {
        $units = ["K" => 1024, "M" => 1024 * 1024, "G" => 1024 * 1024 * 1024];
        $unit = strtoupper(substr($size, -1));
        $num = (float) substr($size, 0, -1);
        return isset($units[$unit]) ? $num * $units[$unit] : (float) $size;
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
                        "originalPrice"     => $this->request->getPost("originalPrice"),
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

    public function updateOnlyProduct($id){

        // Validate the existence of the product by ID
        $existingProduct = $this->productModel->find($id);
        
        if (!$existingProduct) {
            return $this->respond([
                'status'  => false,
                'message' => 'Product not found.',
                'data'    => null,
                'code'    => 404,
            ]);
        }

        $id_subcategories   = $this->request->getPost("id_subcategories");
        $id_categories      = $this->request->getPost("id_categories");
        $name               = $this->request->getPost("name");
        $slug               = $this->request->getPost("slug");
        $keywords           = $this->request->getPost("keywords");
        $keywords           = !empty($keywords) ? implode(", ", $keywords) : null;
        $purchase_price     = $this->request->getPost("purchase_price");
        $percentage_profit  = $this->request->getPost("percentage_profit");
        $sale_price         = $this->request->getPost("sale_price");
        $discount           = $this->request->getPost("discount");
        $originalPrice      = $this->request->getPost("originalPrice");
    
        if (is_null($keywords)) {
            return $this->respond([
                'status'  => false,
                'message' => 'Keywords are required and cannot be empty.',
                'data'    => null,
                'code'    => 400,
            ]);
        }

        $data = array("id_subcategories"    => $id_subcategories,
                        "id_categories"     => $id_categories,
                        "id_user"           => 1,
                        "name"              => $name,
                        "slug"              => $slug,
                        "keywords"          => $keywords,
                        "purchase_price"    => $purchase_price,
                        "percentage_profit" => $percentage_profit,
                        "sale_price"        => $sale_price,
                        "discount"          => $discount,
                        "originalPrice"     => $originalPrice);

        $responseValidate = $this->validateInfo($data);

        if(!empty($responseValidate) ){
            $response = array("status"  => false, 
                              "message" => "The fields are required. ", 
                              "data"    => $this->message,
                              "code"    => 500);
            return $this->respond($response);
        }

        $responseUpdate = $this->productModel->update($id, $data);

        if (!$responseUpdate) {
            return $this->respond([
                'status'  => false,
                'message' => 'Failed to update product.',
                'data'    => null,
                'code'    => 500,
            ]);
        }

        return $this->respond([
            'status'  => true,
            'message' => 'Product updated successfully.',
            'data'    => $data,
            'code'    => 200,
        ]);


    }

    public function updateAddValueattributes($idProduct, $idAtrributo){
        /**
         * 1. Select Id of the table productattributes
         * 2. Create the new element in the table valueattributes
         * 3. id, id_productattributes, id_product, name, created_at, updated_at, deleted_at
         * 4. table productcolor
         * 5. table productquantity
         * 6. table productimages
         */

        $files  = $this->request->getFiles();

        $name_category  = $this->request->getPost("name_category");

        $keywords = $this->request->getPost("keywords");
        $keywords = !empty($keywords) ? implode(", ", $keywords) : null;

        if (empty($files) || !is_array($files)) {
            return [
                'status'  => false,
                'message' => 'Files are required.',
                'data'    => null,
                'code'    => 400
            ];
        }

        //$arrayAttributes  = $this->request->getPost("arrayAttributes");

        $arrayAttributes = array("attribute" => $this->request->getPost("attribute"),
                                  "value"     => $this->request->getPost("value"),
                                  "color"     => $this->request->getPost("color"),
                                  "cantidad"  => $this->request->getPost("cantidad"));

        // Verificar que arrayAttributes esté presente, no esté vacío y sea un array
        if (empty($arrayAttributes) || !is_array($arrayAttributes)) {
            return [
                'status'  => false,
                'message' => 'arrayAttributes is required and must be a non-empty array.',
                'data'    => null,
                'code'    => 400
            ];
        }

        // Array para almacenar los colores únicos y sus imágenes
        $uniqueImagesByColor = [];

        // Guardar el valor de atributo
        $dataValueAttribute = [
            "id_product"            => $idProduct,
            "id_productattributes"  => $idAtrributo,
            "name"                  => $arrayAttributes['value']
        ];

        $responseQueryValueAtt = $this->valueAttributesModel->insert($dataValueAttribute);

        if($responseQueryValueAtt){

            $newIdValueAttr = $this->valueAttributesModel->insertID();
            
            // Guardar el color asociado con el atributo
            $dataColor = [
                "id_product"     => $idProduct,
                "id_productsize" => $newIdValueAttr,
                "color"          => $arrayAttributes['color']
            ]; 

            $responseQueryColor = $this->productColorModel->insert($dataColor);

            if($responseQueryColor){
                
                $newIdColor = $this->productColorModel->insertID();
                
                // Verificar si el color ya fue procesado para evitar duplicados
                $dataQuantity = ["id_productcolor" => $newIdColor, "count" => $arrayAttributes['cantidad'], "id_product" => $idProduct];

                $responseQueryQuantity = $this->productQuantityModel->insert($dataQuantity);

                if($responseQueryQuantity){

                    $color = $arrayAttributes['color'];

                    if (!isset($uniqueImagesByColor[$color])) {

                        $selectedFile = "";
                    
                        foreach ($files['imagesFiles'] as $file) {

                            $selectedFile = $file;
                            
                            $this->saveImage(
                                $idProduct,            // ID del producto
                                $selectedFile,         // Imagen a procesar
                                $keywords,             // Palabras clave
                                $name_category,        // Categoría del producto
                                $name_subcategory = "",// Subcategoría del producto
                                $newIdColor            // ID del color
                            );

                        }

                    }

                }
        
            }

        }
        
        $response = array('status'   => true,
                        'message'  => 'Product create successfull',
                        'data'     => "",
                        'code'     => 200);

        return $this->respond($response);
    }

    public function updateDescriptionProduct($id){

        $description = $this->request->getPost("description");

        $data = array("description" => $description);

        $responseValidate = $this->validateInfo($data);

        if(!empty($responseValidate) ){
            $response = array("status"  => false, 
                                "message" => "The fields are required. ", 
                                "data"    => $this->message,
                                "code"    => 500);
            return $this->respond($response);
        }

        $responseUpdate = $this->productModel->update($id, $data);

        if (!$responseUpdate) {

            return $this->respond([
            'status'  => false,
            'message' => 'Failed description to update product.',
            'data'    => null,
            'code'    => 500,
            ]);

        }

        return $this->respond([
            'status'  => true,
            'message' => 'Product description updated successfully.',
            'data'    => $data,
            'code'    => 200,
        ]);
    }

    public function updateDetailsProduct($id){

        $details = $this->request->getPost("details");

        $data = array("details" => $details);

        $responseValidate = $this->validateInfo($data);

        if(!empty($responseValidate) ){

            $response = array("status"  => false, 
                        "message" => "The fields are required. ", 
                        "data"    => $this->message,
                        "code"    => 500);
            return $this->respond($response);

        }

        $responseUpdate = $this->productModel->update($id, $data);

        if (!$responseUpdate) {

            return $this->respond([
            'status'  => false,
            'message' => 'Failed details to update product.',
            'data'    => null,
            'code'    => 500,
            ]);

        }

        return $this->respond([
            'status'  => true,
            'message' => 'Product details updated successfully.',
            'data'    => $data,
            'code'    => 200,
        ]);
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

            $arrayProductos = array("products"            => [],
                                    "productattributes"   => [],
                                    "valueattributes"     => [],
                                    "productimages"       => []);

            $responseQuery = $this->productModel->select("id, id_subcategories, id_categories, id_user, id_brand, id_gender,name, 
                                                          slug, description, details, specifications, keywords,
                                                          purchase_price, percentage_profit, sale_price, discount, originalPrice")
                                                ->where('id', $id)
                                                ->where('deleted_at', NULL)
                                                ->get()
                                                ->getResult();

            if($responseQuery){

                $arrayProductos["products"] = $responseQuery;

                $responseAttributes = $this->showAttributes($id);

                if($responseAttributes){

                    $arrayProductos["productattributes"] = $responseAttributes;

                    $id_productattributes = $responseAttributes[0]->id;

                    $responseValueattribute = $this->showValueattributes($id, $id_productattributes);
                    
                    if($responseValueattribute){
                        
                        //$id_productsize = array_column($responseValueattribute, 'id');
                        $arrayProductos["valueattributes"] = $responseValueattribute;

                        foreach ($arrayProductos["valueattributes"] as $key => $image) {
                            // Convertir el objeto a un array para manipularlo
                            $imageArray = (array) $image;
                        
                            // Obtener las imágenes
                            $responseImages = $this->showImage($id, $image->id_color);
                        
                            // Si hay imágenes, agregarlas
                            if ($responseImages) {
                                $imageArray["images"] = $responseImages;
                                $arrayProductos["productimages"] = $responseImages;
                            } else {
                                $imageArray["images"] = []; // Si no hay imágenes, agregar un array vacío
                            }
                        
                            // Reemplazar el objeto original con el array modificado
                            $arrayProductos["valueattributes"][$key] = (object) $imageArray;
                        }
                    }

                }

                $response = array("status" => 200, "message" => "Show Product successfull", "data" => $arrayProductos);

            }else{

                $response = array("status" => 404, "message" => "Error Show Product successfull", "data" => "");

            }


            return $this->respond($response);
        }

    }

    public function showAttributes($id){
        $query = $this->productAttributesModel->select("id, id_product, name")->where("id_product", $id)
                                              ->where('productattributes.deleted_at', NULL)
                                              ->get()
                                              ->getResult();
        return $query;
    }

    public function showValueattributes($id, $idProductAttribute){

        $showColumns = "productattributes.id, productattributes.id_product, productattributes.name AS attribute, 
                        va.id as id_v, va.id_productattributes, va.id_product, va.name AS value,
                        pc.id as id_color, pc.id_productsize, pc.color,
                        pq.id as id_q, pq.count AS cantidad";

        $query = $this->productAttributesModel->select($showColumns)
                                            ->join('valueattributes AS va', 'va.id_productattributes = productattributes.id')
                                            ->join('productcolor AS pc', 'pc.id_productsize = va.id')
                                            ->join('productquantity AS pq', 'pq.id_productcolor  = pc.id')
                                            ->where("productattributes.id_product", $id)
                                            ->where("pc.id_product", $id)
                                            ->get()
                                            ->getResult();

        /*$query = $this->valueAttributesModel->select("id, id_productattributes, id_product, name")
                                            ->where("id_product", $id)
                                            ->where("id_productattributes", $idProductAttribute)
                                            ->where('valueattributes.deleted_at', NULL)
                                            ->get()->getResult();*/
        return $query;
    }

    /*public function showProductColor($id){
        $query = $this->productColorModel->select("id, color")->where("id_product", $id)
                                         ->get()
                                         ->getResult();
        return $query;
    }

    public function showProductQuantity($id){
        $query = $this->productQuantityModel->select("id, count")->where("id_product", $id)
                                        ->get()
                                        ->getResult();
        return $query;
    }*/

    public function showImage($id, $id_color){
        $query = $this->productImageModel->select("id, image, image as name")
                                         ->where("id_product", $id)
                                         ->where("id_color",   $id_color)
                                         ->where('productimages.deleted_at', NULL)
                                         ->get()
                                         ->getResult();
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