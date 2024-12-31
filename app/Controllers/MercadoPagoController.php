<?php
#pagos-pidelibre
namespace App\Controllers;


// SDK de Mercado Pago
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Preference\PreferenceClient;

class MercadoPagoController extends BaseController{
    
    public function __construct(){
        MercadoPagoConfig::setAccessToken(getenv('MERCADO_PAGO_ACCESS_TOKEN'));
    }

    public function index(){
        
        $client = new PreferenceClient();

        $preference = $client->create([
            "items"=> array(
                                array(
                                "title" => "Mi producto",
                                "quantity" => 1,
                                "unit_price" => 20000
                                )
                            ),
            "back_urls " => array(
                                    "success" => base_url() ."mercadopago/success",
                                    "failure" => base_url()."mercadopago/success",
                                    "pending" => base_url()."mercadopago/success"
                                ),
            "payer" => [
                            "name" => "sergio",
                            "surname" => "mauricio",
                            "email" => "sergioruedaweb@gmail.com",
                            "date_created" => "2015-06-02T12:58:41.425-04:00",
                            "phone" => [
                                "area_code" => "11",
                                "number" => "4444-4444"
                            ],
                            "identification" => [
                                "type" => "RUT", // Tipos de identificación disponibles en https://api.mercadopago.com/v1/identification_types
                                "number" => "12345678"
                            ],
                            "address" => [
                                "street_name" => "Street",
                                "street_number" => 123,
                                "zip_code" => "5700"
                            ]
                        ],
            "notification_url"      => "https://www.pidelibre.com/mercadopago/notification",
            "statement_descriptor"  => "pidelibre.COM",
            "external_reference"    => "Reference_1234",
        ]);
    
        return view("mercadopago", array("preference"=>$preference));
    
    }

    public function procesarpago(){

    }


    public function notification(){
        // Ruta del archivo de log
        $logFile = WRITEPATH . 'logs/mercadopago_log.log';

        // Mensajes de log
        $messages = [
            '[' . date('Y-m-d H:i:s') . '] INFO: El método notification() fue llamado.',
            '[' . date('Y-m-d H:i:s') . '] DEBUG: Procesando notificación de MercadoPago.',
            '[' . date('Y-m-d H:i:s') . '] WARNING: Este es un mensaje de advertencia.',
            '[' . date('Y-m-d H:i:s') . '] ERROR: Se produjo un error en el método notification.',
        ];

        // Escribir cada mensaje en el archivo de log
        foreach ($messages as $message) {
            file_put_contents($logFile, $message . PHP_EOL, FILE_APPEND);
        }

        // Respuesta para el usuario
        return $this->response->setJSON([
            'message' => 'Notificación registrada en mercadopago_log.log.',
        ]);
    }

}
