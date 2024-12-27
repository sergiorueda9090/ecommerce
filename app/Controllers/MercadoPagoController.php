<?php

namespace App\Controllers;

use App\Models\OrdersModel;
use Dompdf\Dompdf;

// SDK de Mercado Pago
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Preference\PreferenceClient;


use MercadoPago\Preference;
use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\Client\Common\RequestOptions;


class MercadoPagoController extends BaseController{
    
    private $OrdersModel;
    private $responseMercado;

    public function __construct(){
        $this->OrdersModel = new OrdersModel();
        MercadoPagoConfig::setAccessToken(getenv('MERCADO_PAGO_ACCESS_TOKEN'));
    }

    public function index(){
        
        $client = new PreferenceClient();

        $client->back_urls = array(
            "success" => base_url()."mercadopago/success",
            "failure" => base_url()."mercadopago/success",
            "pending" => base_url()."mercadopago/success"
        );

        $client->auto_return = "approved";
        $client->binary_mode = true;

        $preference = $client->create([
                            "items"=> array(
                                array(
                                "title" => "Mi producto",
                                "quantity" => 1,
                                "unit_price" => 20000
                                )
                                ),
                            "notification_url" => base_url()."mercadopago/notification",
                    ]);
    
        return view("mercadopago", array("preference"=>$preference));
    
    }

    public function notification(){
              // Detectar el método HTTP
              $method = $this->request->getMethod(true); // Retorna el método HTTP en mayúsculas (GET, POST, etc.)

              // Obtener los datos enviados en la solicitud
              $input = [];
              if ($method === 'POST' || $method === 'PUT') {
                  $input = $this->request->getJSON(true) ?? $this->request->getPost();
              } elseif ($method === 'GET') {
                  $input = $this->request->getGet();
              }
      
              // Registrar el método y los datos en un archivo de log
              $logFile = WRITEPATH . 'logs/mercadopago_notification.log';
              file_put_contents(
                  $logFile,
                  "[" . date('Y-m-d H:i:s') . "] Method: $method, Data: " . json_encode($input, JSON_PRETTY_PRINT) . PHP_EOL,
                  FILE_APPEND
              );
      
              // Registrar en los logs del sistema
              log_message('info', 'MercadoPago Notification - Method: ' . $method . ' Data: ' . json_encode($input));
      
              // Responder con un código 200 OK
              return $this->response->setJSON(['status' => 'success', 'method' => $method])->setStatusCode(200);
          
    }

    public function success(){
       
        $respuesta = array(
            'Payment' => $_GET['payment_id'],
            'Status' => $_GET['status'],
            'MerchantOrder' => $_GET['merchant_order_id']        
        ); 

        echo json_encode($respuesta);

        return view("mercadopagosuccess", array("respuesta"=>$respuesta));

    }

}
