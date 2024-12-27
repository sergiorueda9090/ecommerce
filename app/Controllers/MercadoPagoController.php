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

        $preference = $client->create([
            "items" => [
                [
                    "id" => "item-ID-1234",
                    "title" => "Title of what you are paying for. It will be displayed in the payment process.",
                    "currency_id" => "COP",
                    "picture_url" => "https://www.mercadopago.com/org-img/MP3/home/logomp3.gif",
                    "description" => "Item description",
                    "category_id" => "art", // Available categories at https://api.mercadopago.com/item_categories
                    "quantity" => 1,
                    "unit_price" => 20000
                ]
            ],
            "payer" => [
                "name" => "user-name",
                "surname" => "user-surname",
                "email" => "user@email.com",
                "date_created" => "2015-06-02T12:58:41.425-04:00",
                "phone" => [
                    "area_code" => "11",
                    "number" => "4444-4444"
                ],
                /*"identification" => [
                    "type" => "RUT", // Available ID types at https://api.mercadopago.com/v1/identification_types
                    "number" => "12345678"
                ],*/
                "address" => [
                    "street_name" => "Street",
                    "street_number" => 123,
                    "zip_code" => "5700"
                ]
            ],
            "back_urls" => [
                "success" => base_url()."mercadopago/success",
                "failure" => base_url()."mercadopago/success",
                "pending" => base_url()."mercadopago/success"
            ],
            "auto_return" => "approved",
            "payment_methods" => [
                "excluded_payment_methods" => [
                    [
                        "id" => "master"
                    ]
                ],
                "excluded_payment_types" => [
                    [
                        "id" => "ticket"
                    ]
                ],
                "installments" => 12,
                "default_payment_method_id" => null,
                "default_installments" => null
            ],
            "shipments" => [
                "receiver_address" => [
                    "zip_code" => "5700",
                    "street_number" => 123,
                    "street_name" => "Street",
                    "floor" => 4,
                    "apartment" => "C"
                ]
            ],
            "notification_url" => base_url()."mercadopago/notification",
            "statement_descriptor" => "MINEGOCIO",
            "external_reference" => "Reference_1234",
            "expires" => true,
            "expiration_date_from" => "2016-02-01T12:00:00.000-04:00",
            "expiration_date_to" => "2016-02-28T12:00:00.000-04:00",
            "taxes" => [
                [
                    "type" => "IVA",
                    "value" => 16
                ]
            ]
        ]);

        
    
        return view("mercadopago", array("preference"=>$preference));
    
    }

    public function notification(){
        // Obtener los datos de la solicitud
        $input = $this->request->getJSON(true); // Lee el cuerpo como JSON y lo convierte a un array asociativo

        // Ruta del archivo de logs personalizado
        $logFile = WRITEPATH . 'logs/mercadopago_notification.log';

        // Escribir los datos en un archivo de log
        file_put_contents(
            $logFile,
            "[" . date('Y-m-d H:i:s') . "] " . json_encode($input, JSON_PRETTY_PRINT) . PHP_EOL,
            FILE_APPEND
        );

        // Registrar en los logs del sistema de CodeIgniter
        log_message('info', 'MercadoPago Notification: ' . json_encode($input));

        // Responder a MercadoPago con código 200
        return $this->response->setJSON(['status' => 'success'])->setStatusCode(200);
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
