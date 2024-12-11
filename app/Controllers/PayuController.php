<?php
namespace App\Controllers;
use App\Models\ProductQuantityColorModel;
use App\Models\OrdersModel;
use App\Models\TransactionsModel;


class PayuController extends BaseController{

    private $TransactionsModel;
    private $OrdersModel;
    private $ProductQuantityColorModel;

    public function __construct(){

        $this->TransactionsModel         = new TransactionsModel();
        $this->OrdersModel               = new OrdersModel();
        $this->ProductQuantityColorModel = new ProductQuantityColorModel();
    
    }

    public function response()
    {
        $data = "2-1-2-1,2-1-2-1,2-1-2-1,2-1-2-1";
        
        $data = explode(",", $data);
        
        var_dump($data);

        return var_dump($data);

        $data = array_map(function($item) {
            return explode("-", $item);
        });
        

        

        //$logData = "Received POST data: " . print_r($postData, true) . PHP_EOL;

        //file_put_contents(WRITEPATH . 'logs/payu_response_log.log', $logData);
        
        //file_put_contents(WRITEPATH . 'logs/payu_response_log.log', "Captured params: " . print_r($params, true) . PHP_EOL, FILE_APPEND);
    
        // Aquí puedes continuar con el resto de tu lógica.
        
        //file_put_contents(WRITEPATH . 'logs/payu_response_log.log', "End of index method" . PHP_EOL, FILE_APPEND);
    }


    /*public function confirmation()
    {
        // Registrar el inicio del método
        file_put_contents(WRITEPATH . 'logs/payu_confirmation_log.log', "Inicio del método confirmation" . PHP_EOL, FILE_APPEND);
    
        try {
            $params = $this->request->getGet();
            $postData = $this->request->getPost();

            // Validar que se reciba una firma
            if (empty($postData['signature'])) {
                file_put_contents(WRITEPATH . 'logs/payu_confirmation_log.log', "Firma faltante en los datos POST." . PHP_EOL, FILE_APPEND);
                return $this->response->setStatusCode(400, 'Firma faltante');
            }

            // Calcular la firma esperada
            $apiKey = '4Vj8eK4rloUd272L48hsrarnUA'; // Reemplaza con tu API Key de PayU
            $merchantId = $postData['merchant_id'] ?? '';
            $referenceSale = $postData['reference_sale'] ?? '';
            $value = number_format((float)$postData['value'], 1, '.', '');
            $currency = $postData['currency'] ?? '';
            $statePol = $postData['state_pol'] ?? '';

            $expectedSignature = md5("$apiKey~$merchantId~$referenceSale~$value~$currency~$statePol");
            
            if ($postData['signature'] !== $expectedSignature) {
                file_put_contents(WRITEPATH . 'logs/payu_confirmation_log.log', "Firma inválida: {$postData['signature']} esperada: $expectedSignature" . PHP_EOL, FILE_APPEND);
                return $this->response->setStatusCode(403, 'Firma inválida');
            }
    
            file_put_contents(WRITEPATH . 'logs/payu_confirmation_log.log', "Firma validada correctamente." . PHP_EOL, FILE_APPEND);
    
            // Registrar parámetros GET
            if (!empty($params)) {
                foreach ($params as $key => $value) {
                    file_put_contents(WRITEPATH . 'logs/payu_confirmation_log.log', "GET - $key: $value" . PHP_EOL, FILE_APPEND);
                }
            }
    
            // Registrar parámetros POST
            if (!empty($postData)) {
                file_put_contents(WRITEPATH . 'logs/payu_confirmation_log.log', "Datos POST recibidos" . PHP_EOL, FILE_APPEND);
    
                // Datos principales de la transacción
                $data = [
                    "merchant_id" => $postData['merchant_id'] ?? 'N/A',
                    "state_pol" => $postData['state_pol'] ?? 'N/A',
                    "payment_method" => $postData['payment_method'] ?? 'N/A',
                    "payment_method_type" => $postData['payment_method_type'] ?? 'N/A',
                    "value" => $postData['value'] ?? 0.00,
                    "currency" => $postData['currency'] ?? 'N/A',
                    "email_buyer" => $postData['email_buyer'] ?? 'N/A',
                    "date" => $postData['date'] ?? 'N/A',
                    "data" => json_encode($postData)
                ];
    
                // Guardar transacción en la base de datos
                if ($this->TransactionsModel->insert($data)) {
                    $idTransaction = $this->TransactionsModel->insertID();
                    file_put_contents(WRITEPATH . 'logs/payu_confirmation_log.log', "Transacción registrada con ID: $idTransaction" . PHP_EOL, FILE_APPEND);
    
                    // Procesar productos
                    $productsArray = isset($params['productos']) ? explode(",", $params['productos']) : [];
                    $orders = [];
    
                    foreach ($productsArray as $product) {
                        list($id_color, $id_size, $quantity, $idProduct, $img, $price) = explode("-", $product);
    
                        $orders[] = [
                            "email" => $postData['email_buyer'],
                            "id_user" => 1, // Reemplazar con el ID de usuario real si está disponible
                            "id_product" => $idProduct,
                            "id_size" => (int)$id_size,
                            "id_color" => (int)$id_color,
                            "quantity" => (int)$quantity,
                            "price" => $price,
                            "image" => $img,
                            "transactions_id" => $idTransaction,
                            "status" => 1
                        ];
    
                        // Actualizar inventario
                        $this->ProductQuantityColorModel
                            ->set('count', 'count-' . (int)$quantity, false)
                            ->where('id', (int)$id_color)
                            ->update();
                    }
    
                    // Insertar órdenes en la base de datos
                    if (!$this->OrdersModel->insertBatch($orders)) {
                        $errors = $this->OrdersModel->errors();
                        file_put_contents(WRITEPATH . 'logs/payu_confirmation_log.log', "Error al insertar órdenes: " . print_r($errors, true) . PHP_EOL, FILE_APPEND);
                    } else {
                        file_put_contents(WRITEPATH . 'logs/payu_confirmation_log.log', "Órdenes registradas con éxito" . PHP_EOL, FILE_APPEND);
                    }
                } else {
                    $errors = $this->TransactionsModel->errors();
                    file_put_contents(WRITEPATH . 'logs/payu_confirmation_log.log', "Error al registrar transacción: " . print_r($errors, true) . PHP_EOL, FILE_APPEND);
                }
            } else {
                file_put_contents(WRITEPATH . 'logs/payu_confirmation_log.log', "No se recibieron datos POST." . PHP_EOL, FILE_APPEND);
            }
        } catch (Exception $e) {
            file_put_contents(WRITEPATH . 'logs/payu_confirmation_log.log', "Excepción: " . $e->getMessage() . PHP_EOL, FILE_APPEND);
        }
    }*/

    public function confirmation()
    {
        // Registrar el inicio del método
        file_put_contents(WRITEPATH . 'logs/payu_confirmation_log.log', "Inicio del método confirmation" . PHP_EOL, FILE_APPEND);

        try {
            $params = $this->request->getGet();
            $postData = $this->request->getPost();
            
            // Validar que se reciba una firma
            if (empty($postData['sign'])) {
                file_put_contents(WRITEPATH . 'logs/payu_confirmation_log.log', "Firma faltante en los datos POST." . PHP_EOL, FILE_APPEND);
                return $this->response->setStatusCode(400, 'Firma faltante');
            }

            // Calcular la firma esperada
            $apiKey = '4Vj8eK4rloUd272L48hsrarnUA'; // Reemplaza con tu API Key de PayU
            $merchantId = $postData['merchant_id'] ?? '';
            $referenceSale = $postData['reference_sale'] ?? '';
            $value = number_format((float)$postData['value'], 1, '.', '');
            $currency = $postData['currency'] ?? '';
            $statePol = $postData['state_pol'] ?? '';

            $expectedSignature = md5("$apiKey~$merchantId~$referenceSale~$value~$currency~$statePol");

            if ($postData['sign'] !== $expectedSignature) {
                file_put_contents(WRITEPATH . 'logs/payu_confirmation_log.log', "Firma inválida: {$postData['sign']} esperada: $expectedSignature" . PHP_EOL, FILE_APPEND);
                return $this->response->setStatusCode(403, 'Firma inválida');
            }

            file_put_contents(WRITEPATH . 'logs/payu_confirmation_log.log', "Firma validada correctamente." . PHP_EOL, FILE_APPEND);

            // Registrar parámetros GET
            if (!empty($params)) {
                foreach ($params as $key => $value) {
                    file_put_contents(WRITEPATH . 'logs/payu_confirmation_log.log', "GET - $key: $value" . PHP_EOL, FILE_APPEND);
                }
            }

            // Registrar parámetros POST
            if (!empty($postData)) {
                file_put_contents(WRITEPATH . 'logs/payu_confirmation_log.log', "Datos POST recibidos" . PHP_EOL, FILE_APPEND);

                // Datos principales de la transacción
                $data = [
                    "merchant_id" => $postData['merchant_id'] ?? 'N/A',
                    "state_pol" => $postData['state_pol'] ?? 'N/A',
                    "payment_method" => $postData['payment_method'] ?? 'N/A',
                    "payment_method_type" => $postData['payment_method_type'] ?? 'N/A',
                    "value" => $postData['value'] ?? 0.00,
                    "currency" => $postData['currency'] ?? 'N/A',
                    "email_buyer" => $postData['email_buyer'] ?? 'N/A',
                    "date" => $postData['date'] ?? 'N/A',
                    "data" => json_encode($postData)
                ];

                // Guardar transacción en la base de datos
                if ($this->TransactionsModel->insert($data)) {
                    $idTransaction = $this->TransactionsModel->insertID();
                    file_put_contents(WRITEPATH . 'logs/payu_confirmation_log.log', "Transacción registrada con ID: $idTransaction" . PHP_EOL, FILE_APPEND);

                    // Procesar productos
                    $productsArray = isset($params['productos']) ? explode(",", $params['productos']) : [];
                    $orders = [];

                    foreach ($productsArray as $product) {
                        list($id_color, $id_size, $quantity, $idProduct, $img, $price) = explode("-", $product);

                        $orders[] = [
                            "email" => $postData['email_buyer'],
                            "id_user" => 1, // Reemplazar con el ID de usuario real si está disponible
                            "id_product" => $idProduct,
                            "id_size" => (int)$id_size,
                            "id_color" => (int)$id_color,
                            "quantity" => (int)$quantity,
                            "price" => $price,
                            "image" => $img,
                            "transactions_id" => $idTransaction,
                            "status" => 1
                        ];

                        // Actualizar inventario
                        $this->ProductQuantityColorModel
                            ->set('count', 'count-' . (int)$quantity, false)
                            ->where('id', (int)$id_color)
                            ->update();
                    }

                    // Insertar órdenes en la base de datos
                    if (!$this->OrdersModel->insertBatch($orders)) {
                        $errors = $this->OrdersModel->errors();
                        file_put_contents(WRITEPATH . 'logs/payu_confirmation_log.log', "Error al insertar órdenes: " . print_r($errors, true) . PHP_EOL, FILE_APPEND);
                        return $this->response->setStatusCode(202, 'Transacción registrada, pero error en las órdenes');
                    } else {
                        file_put_contents(WRITEPATH . 'logs/payu_confirmation_log.log', "Órdenes registradas con éxito" . PHP_EOL, FILE_APPEND);
                        return $this->response->setStatusCode(200, 'Transacción y órdenes registradas con éxito');
                    }
                } else {
                    $errors = $this->TransactionsModel->errors();
                    file_put_contents(WRITEPATH . 'logs/payu_confirmation_log.log', "Error al registrar transacción: " . print_r($errors, true) . PHP_EOL, FILE_APPEND);
                    return $this->response->setStatusCode(500, 'Error al registrar la transacción');
                }
            } else {
                file_put_contents(WRITEPATH . 'logs/payu_confirmation_log.log', "No se recibieron datos POST." . PHP_EOL, FILE_APPEND);
                return $this->response->setStatusCode(404, 'Datos POST no encontrados');
            }
        } catch (Exception $e) {
            file_put_contents(WRITEPATH . 'logs/payu_confirmation_log.log', "Excepción: " . $e->getMessage() . PHP_EOL, FILE_APPEND);
            return $this->response->setStatusCode(500, 'Error interno del servidor');
        }
    }


}