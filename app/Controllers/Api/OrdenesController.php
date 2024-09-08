<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use App\Models\OrdersModel;
use App\Models\CategoriesImageModel;

class OrdenesController extends ResourceController{
    
    protected $ordersModel;
    protected $format = 'json';
    protected $validateArray;
    protected $message;

    public function __construct(){

        $this->ordersModel = new OrdersModel();
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

    public function listAll() {

        try {
            
            $method = strtoupper($this->request->getMethod());
            
            if ($method == 'GET') {
                // Establece el tamaño de la página
                $size = $this->request->getVar('size') ?: 1000;
        
                // Obtiene el número de la página actual desde la solicitud (GET parameter)
                $page = $this->request->getVar('page') ?: 1;
        
                // Ejecuta la consulta con paginación
                $data = $this->ordersModel->select('orders.id,orders.transactions_id, products.name, orders.email, orders.quantity, orders.price, orders.image, 
                                                    transactions.state_pol, transactions.payment_method, 
                                                    transactions.payment_method_type, transactions.value, transactions.currency,
                                                    transactions.email_buyer,transactions.date,
                                                    transactions.created_at')
                                         ->join('transactions', 'orders.transactions_id = transactions.id')
                                         ->join('products', 'products.id = orders.id_product')
                                         ->groupBy('orders.transactions_id')
                                         ->orderBy('id', 'ASC')
                                         ->paginate($size, 'default', $page);
        
                // Verifica si hay resultados
                if (empty($data)) {
                    // Si no hay resultados, devolver una respuesta de 'No Content'
                    return $this->respond([
                        'status' => 204,
                        'error' => null,
                        'message' => 'No data found.',
                        'data' => []
                    ], 204);
                }
    
                // Obtiene el objeto pager para obtener los datos de paginación
                $pager = \Config\Services::pager();
                $this->message = "Data retrieved successfully.";
        
                // Prepara la respuesta con los resultados
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
        
                return $this->respond($response, 200);
            } else {
                return $this->fail('Invalid request method.', 405);
            }
        } catch (\Exception $e) {
            // Captura cualquier excepción y devuelve un error 500 con un mensaje de error
            return $this->respond([
                'status' => 500,
                'error' => true,
                'message' => 'An error occurred while processing the request: ' . $e->getMessage()
            ], 500);
        }
    }

    public function show($id = null){

        $method = strtoupper($this->request->getMethod());

        if($method === 'GET'){

            if( in_array($id, $this->validateArray, true) ){

                $this->message = 'El id de la orden no es válido.';

                $response = [
                    'status' => 400,
                    'error' => $this->message,
                    'data' => null,
                    'message' => $this->message
                    ];
                
                return $this->respond($response);

            }

            $query = $this->ordersModel->where('id', $id)->where('deleted_at', NULL);

            $responseQuery = $query->get()->getResult();
            
            if($responseQuery){

                $response = array("status" => 200, "message" => $this->message, "data" => $responseQuery);

            }else{

                $response = array("status" => 404, "message" => $this->messageError, "data" => "");

            }

            return $this->respond($response);

        }

    }
    

}