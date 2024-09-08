<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use App\Models\TransactionsModel;


class TransactionsController extends ResourceController{
    

    protected $transactionsModel;
    protected $format = 'json';
    protected $validateArray;
    protected $message;

    public function __construct(){

        $this->transactionsModel = new TransactionsModel();
        $this->validateArray     = ['', null, NULL];

    }


    public function listAll(){

        // Verificar si el método es GET
        $method = strtoupper($this->request->getMethod());
       
        if ($method !== 'GET') {
            return $this->fail('Invalid HTTP method. Only GET is allowed.', 405);
        }
    
        // Validar el parámetro 'size'
        $size = $this->request->getVar('size');
        if ($size !== null && (!is_numeric($size) || (int)$size <= 0)) {
            return $this->fail('The "size" parameter must be a positive integer.', 400);
        }

        $size = $size ?: 1000;  // Valor por defecto
    
        // Validar el parámetro 'page'
        $page = $this->request->getVar('page');

        if ($page !== null && (!is_numeric($page) || (int)$page <= 0)) {
            return $this->fail('The "page" parameter must be a positive integer.', 400);
        }

        $page = $page ?: 1;  // Valor por defecto
    
        try {

            // Verificar que el modelo de transacciones esté instanciado
            if (!isset($this->transactionsModel)) {
                throw new \Exception('Transactions model is not loaded.');
            }
    
            // Obtener los datos paginados
            $data = $this->transactionsModel->where('deleted_at', NULL)
                                            ->orderBy('id', 'ASC')
                                            ->paginate($size, 'default', $page);
    
            // Verificar si se obtuvieron datos
            if (empty($data)) {

                return $this->respond([
                    'status' => 404,
                    'error' => true,
                    'message' => 'No records found.',
                ], 404);

            }
    
            // Obtener el objeto de paginación
            $pager = \Config\Services::pager();
    
            // Preparar la respuesta
            $response = [
                'status' => 200,
                'error' => null,
                'data' => $data,
                'pager' => [
                    'currentPage' => $pager->getCurrentPage(),
                    'totalPages'  => $pager->getPageCount(),
                    'perPage'     => $pager->getPerPage(),
                    'totalItems'  => $pager->getTotal(),
                ],
            ];
    
            return $this->respond($response, 200);
    
        } catch (\Exception $e) {
            return $this->fail('An error occurred: ' . $e->getMessage(), 500);
        }
    }


    public function show($id = null) {

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
                
                return $this->respond($response, 200);

            } else {

                $this->messageError = "Transaction not found.";
    
                // Respuesta si no se encuentra la transacción
                $response = [
                    'status' => 404,
                    'error' => true,
                    'data' => null,
                    'message' => $this->messageError,
                ];
    
                return $this->respond($response, 404);
            }
    
        } catch (\Exception $e) {
            // Manejar cualquier excepción y devolver un error 500
            $response = ['status' => 500,'error' => true,'message' => 'An error occurred while retrieving the transaction: ' . $e->getMessage()];
            return $this->respond($response, 500);
        }
    }

}