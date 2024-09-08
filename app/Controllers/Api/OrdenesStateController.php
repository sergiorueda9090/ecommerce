<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use App\Models\CustomersModel;
use App\Models\OrdersStateModel;
use App\Models\OrdersModel;
use App\Models\TransactionsModel;
use App\Models\CategoriesImageModel;

class OrdenesStateController extends ResourceController{
    
    protected $customersModel;
    protected $ordersStateModel;
    protected $ordersModel;
    protected $transactionsModel;
    protected $format = 'json';
    protected $validateArray;
    protected $message;

    public function __construct(){

        $this->customersModel    = new CustomersModel();
        $this->ordersStateModel  = new OrdersStateModel();
        $this->ordersModel       = new OrdersModel();
        $this->transactionsModel = new TransactionsModel();
        $this->validateArray     = ['', null, NULL];

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
           $size = $this->request->getVar('size') ?: 1000;
   
           // Obtiene el número de la página actual desde la solicitud (GET parameter)
           $page = $this->request->getVar('page') ?: 1;
   
           // Ejecuta la consulta con paginación
           $data = $this->ordersModel->select('orders.id, products.name, orders.email, orders.quantity, orders.price, orders.image, 
                                                    transactions.estadoTx, transactions.transactionState, 
                                                    transactions.lapPaymentMethod, transactions.created_at')
                                            ->join('transactions', 'orders.transactions_id = transactions.id')
                                            ->join('products',     'products.id = orders.id_product')
                                            ->orderBy('id', 'ASC')->paginate($size, 'default', $page);
                                            //->where('categoriesimages.deleted_at',NULL); 
   
           // Obtiene el objeto pager para obtener los datos de paginación
           $pager = \Config\Services::pager();
           $this->message = "The fields are required. ";
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
        try {

            $method = strtoupper($this->request->getMethod());
    
            if ($method === 'GET') {
    
                // Validación del ID
                if (in_array($id, $this->validateArray, true)) {
                    $this->message = 'El ID de la orden no es válido.';
    
                    $response = [
                        'status' => 400,
                        'error' => true,
                        'data' => null,
                        'message' => $this->message
                    ];
    
                    return $this->respond($response, 400); // Código de estado 400
                }
    
                // Ejecuta la consulta con el ID
                $query = $this->ordersModel->select('orders.id, products.name, orders.email, 
                                                     orders.quantity, orders.price, orders.image,
                                                     orders.id_user, productsize.size, productcolor.color, 
                                                     orders.quantity, orders.price, orders.image,
                                                     orders.transactions_id, orders.status')
                                           ->join('products',    'products.id = orders.id_product')
                                           ->join('productsize', 'productsize.id = orders.id_size')
                                           ->join('productcolor', 'productcolor.id = orders.id_color')
                                           ->where('orders.transactions_id', $id)
                                           ->where('orders.deleted_at', NULL);
                
                // Obtener el resultado de la consulta
                $responseQuery = $query->get()->getResult();
    
                // Verificar si se encontró la orden
                if (!empty($responseQuery)) {

                    $response = [
                        "status"      => 200,
                        "message"     => "Order found successfully.",
                        "data"        => $responseQuery,
                        "order"       => "",
                        "customer"    => $this->getInfoCustomer($responseQuery[0]->id_user),
                        "transaction" => $this->showTransaction($id),
                        "orderStatusTraceability" => $this->getOrderStatusTraceability($id)
                    ];
    
                } else {
                    
                    $this->messageError = "Order not found.";
    
                    // Respuesta si no se encuentran resultados
                    $response = [
                        "status"      => 404,
                        "message"     => $this->messageError,
                        "data"        => null,
                        "order"       => null,
                        "transaction" => null,
                        "orderStatusTraceability" => null,
                    ];
    
                    return $this->respond($response, 404); // Código de estado 404
                }
    
                // Devolver la respuesta exitosa
                return $this->respond($response, 200);
    
            } else {
                // Método no permitido
                return $this->fail('Invalid request method.', 405); // Código de estado 405
            }
        } catch (\Exception $e) {
            // Manejar cualquier excepción y devolver un error 500
            return $this->respond([
                'status' => 500,
                'error' => true,
                'message' => 'An error occurred while processing the request: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getInfoCustomer($id = null) {
        try {
            // Validación: Verificar si el ID fue proporcionado
            if ($id === null) {
                return[
                    'status'  => 400, // Bad Request
                    'message' => 'Customer ID is required.',
                    'data'    => null
                ];
            }
    
            // Validación: Verificar que el ID sea un número entero válido
            if (!is_numeric($id) || $id <= 0) {
                return [
                    'status'  => 400, // Bad Request
                    'message' => 'Customer ID must be a valid positive number.',
                    'data'    => null
                ];
            }
    
            // Ejecutar la consulta para obtener la información del cliente
            $query = $this->customersModel->where('id', $id)
                                          ->where('deleted_at', NULL)
                                          ->get();
    
            // Obtener el resultado de la consulta
            $result = $query->getResult();
    
            // Validación: Verificar si se encontraron resultados
            if (empty($result)) {
                return [
                    'status'  => 404, // Not Found
                    'message' => 'No customer information found for the provided ID.',
                    'data'    => null
                ];
            }
    
            // Respuesta exitosa con los resultados de la consulta
            return [
                'status'  => 200, // OK
                'message' => 'Customer information retrieved successfully.',
                'data'    => $result
            ];
    
        } catch (\Exception $e) {
            // Manejar cualquier excepción y devolver un error 500
            return [
                'status'  => 500, // Internal Server Error
                'message' => 'An error occurred while retrieving customer information: ' . $e->getMessage(),
                'data'    => null
            ];
        }
    }
    
    public function getOrderStatusTraceability($id = null) {
        try {
            // Validación: Verificar si el ID fue proporcionado
            if ($id === null) {
                return $this->respond([
                    'status'  => 400, // Bad Request
                    'message' => 'Order ID is required.',
                    'data'    => null
                ], 400);
            }
    
            // Ejecutar la consulta para obtener la trazabilidad del estado de la orden
            $query = $this->ordersStateModel->where('id_transaction', $id)
                                            ->where('deleted_at', NULL)
                                            ->orderBy('id', 'DESC')
                                            ->limit(1); 
    
            // Obtener los resultados de la consulta
            $result = $query->get()->getResult();
    
            // Validación: Verificar si se encontraron resultados
            if (empty($result)) {
                return [
                        'status'  => 404, // Not Found
                        'message' => 'No traceability data found for the provided Order ID.',
                        'data'    => ["id"            => "",
                                      "id_user"       => "",
                                      "id_order"      => "",
                                      "id_transaction"=> "",
                                      "order_state"   => "notification",
                                      "order_note"    => " ",
                                      "created_at"    => "",
                                      "updated_at"    => "",
                                      "deleted_at"    => ""]
                    ];
            }
    
            // Respuesta exitosa con los resultados de la consulta
            $response = [
                'status'  => 200, // OK
                'message' => 'Order status traceability data retrieved successfully.',
                'data'    => $result
            ];
    
            return$response;
    
        } catch (\Exception $e) {
            // Manejar cualquier excepción y devolver un error 500
            return [
                'status'  => 500, // Internal Server Error
                'message' => 'An error occurred while retrieving order status traceability: ' . $e->getMessage(),
                'data'    => null
            ];
        }
    }

    public function showTransaction($id = null) {

        try {

            // Validar que el ID no sea nulo y sea un valor numérico válido
            if (is_null($id)) {
                $this->messageError = "The transaction ID is invalid.";
    
                $response = [
                    'status' => 400,
                    'error' => true,
                    'data' => null,
                    'message' => $this->messageError
                ];
    
                return $this->respond($response, 400); // Código de estado 400 (Bad Request)
            }
    
            // Ejecuta la consulta para obtener la transacción
            $query = $this->transactionsModel->where('transactions.id', $id)->where('transactions.deleted_at', NULL);
    
            // Obtener el resultado de la consulta
            $result = $query->get()->getResult();
    
            // Verificar si se encontró la transacción
            if (!empty($result)) {

                $this->message = "Transaction retrieved successfully.";
    
                // Prepara la respuesta exitosa
                $response = [
                    'status' => 200,
                    'error' => null,
                    'data' => $result,
                    'message' => $this->message,
                ];
    
                return $response;
    
            } else {
                $this->messageError = "Transaction not found.";
    
                // Respuesta si no se encuentra la transacción
                $response = [
                    'status' => 404,
                    'error' => true,
                    'data' => null,
                    'message' => $this->messageError,
                ];
    
                return $response;
            }
    
        } catch (\Exception $e) {
            // Manejar cualquier excepción y devolver un error 500
            return ['status' => 500,'error' => true,'message' => 'An error occurred while retrieving the transaction: ' . $e->getMessage()];
        }
    }


    public function create() {
        try {
            // Mensaje por defecto
            $this->message = "The fields are required.";
    
            // Recoger los datos de la solicitud
            $data = [
                "id_user"        => $this->request->getPost("id_user"),
                "id_order"       => $this->request->getPost("id_orders"),
                "id_transaction" => $this->request->getPost("id_transaction"),
                "order_state"    => $this->request->getPost("order_status"),
                "order_note"     => $this->request->getPost("create_note")
            ];
    
            // Validar que la información no esté vacía
            $responseValidate = $this->validateInfo($data);
    
            if (!empty($responseValidate)) {
                // Respuesta si los datos no son válidos
                $response = [
                    "status"  => false, 
                    "message" => $this->message, 
                    "data"    => $responseValidate, // Devolver detalles de validación
                    "code"    => 400 // Bad Request
                ];
    
                return $this->respond($response, 400);
            }
            
            // Convertir id_orders en un array
            $idOrders = explode(',', $this->request->getPost("id_orders"));

            // Eliminar posibles espacios en blanco
            $idOrders = array_map('trim', $idOrders);

            // Iterar sobre cada id_order y hacer el insert
            foreach ($idOrders as $idOrder) {

                $data = [
                    "id_user"        => $this->request->getPost("id_user"),
                    "id_order"       => $idOrder, // Cada id_order
                    "id_transaction" => $this->request->getPost("id_transaction"),
                    "order_state"    => $this->request->getPost("order_status"),
                    "order_note"     => $this->request->getPost("create_note")
                ];

                // Insertar en la base de datos
                $responseQuery = $this->ordersStateModel->insert($data);

                // Si ocurre un error, manejar la respuesta
                if (!$responseQuery) {
                    // Puedes manejar el error aquí, por ejemplo:
                    return $this->response->setJSON([
                        'status' => 'error',
                        'message' => 'Error al insertar en la base de datos.'
                    ]);
                }


            }
    
            if ($responseQuery) {
                // Obtener el ID del nuevo registro creado
                $newId = $this->ordersStateModel->insertID();
    
                $response = [
                    'status'  => true,
                    'message' => 'Change state order created successfully',
                    'data'    => $newId,
                    'code'    => 201 // Created
                ];
    
                return $this->respond($response, 201);
    
            } else {
                // Respuesta en caso de que la inserción falle
                $response = [
                    'status'  => false,
                    'message' => 'Change state was not created successfully',
                    'data'    => null,
                    'code'    => 500 // Internal Server Error
                ];
    
                return $this->respond($response, 400);
            }
    
        } catch (\Exception $e) {
            // Manejar cualquier excepción y devolver un error 500
            return $this->respond([
                'status'  => false,
                'message' => 'An error occurred while creating the change state order: ' . $e->getMessage(),
                'data'    => null,
                'code'    => 500
            ], 500);
        }
    }

}