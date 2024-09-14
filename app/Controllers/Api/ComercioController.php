<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use App\Models\ComercioModel;


class ComercioController extends ResourceController{
    

    protected $comercioModel;
    protected $format = 'json';
    protected $validateArray;
    protected $message;

    public function __construct(){

        $this->comercioModel = new ComercioModel();
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
            if (!isset($this->comercioModel)) {
                throw new \Exception('Comercio model is not loaded.');
            }
    
            // Obtener los datos paginados
            $data = $this->comercioModel->paginate($size, 'default', $page);
    
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
            $query = $this->comercioModel->where('idComercio', $id);
    
            // Obtener el resultado de la consulta
            $result = $query->get()->getResult();
    
            // Verificar si se encontró la transacción
            if (!empty($result)) {

                $this->message = "Comercio retrieved successfully.";
    
                // Prepara la respuesta exitosa
                $response = [
                    'status' => 200,
                    'error' => null,
                    'data' => $result,
                    'message' => $this->message,
                ];
                
                return $this->respond($response, 200);

            } else {

                $this->messageError = "Comercio not found.";
    
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

    public function activateTrade($id = null){

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
            $query = $this->comercioModel->where('idComercio', $id);
    
            // Obtener el resultado de la consulta
            $result = $query->get()->getResult();
    
            // Verificar si se encontró la transacción
            if (!empty($result)) {

                $query = $this->comercioModel->set('estado', "CASE WHEN idComercio = {$id} THEN 1 ELSE 0 END", false)
                                             ->where('idComercio IS NOT NULL') // Ensure there's a WHERE clause
                                             ->update();

                 // Check if the query affected any rows
                if ($this->comercioModel->affectedRows() > 0) {
                    $this->message = "Comercio updated successfully.";
                } else {
                    $this->message = "No records were updated.";
                }

                // Prepara la respuesta exitosa
                $response = [
                    'status' => 200,
                    'error' => null,
                    'data' => null,  // You can return some specific data here if needed
                    'message' => $this->message,
                ];
                
                return $this->respond($response, 200);

            } else {

                $this->messageError = "Comercio not found.";
    
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