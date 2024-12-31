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
            "notification_url"      => "https://pidelibre.com/mercadopago/notification",
            "statement_descriptor"  => "pidelibre.COM",
            "external_reference"    => "Reference_1234",
        ]);
    
        return view("mercadopago", array("preference"=>$preference));
    
    }

    public function procesarpago(){

    }


    public function notification()
    {
        // Ruta del archivo de log
        $logFile = WRITEPATH . 'logs/mercadopago_log.log';
    
        // Obtener los datos enviados por el webhook
        $inputData = file_get_contents('php://input'); // Captura el cuerpo de la solicitud en bruto
        $parsedData = json_decode($inputData, true); // Convierte el JSON a un array asociativo
        $headers = $this->request->getHeaders(); // Captura los headers de la solicitud
        $queryParams = $this->request->getGet(); // Captura los parámetros GET, si los hay
    
        // Preparar contenido del log
        $logContent = "[" . date('Y-m-d H:i:s') . "] INFO: Notificación recibida de MercadoPago.\n";
    
        // Agregar los valores específicos del body, si existen
        if ($parsedData) {
            $logContent .= "Detalles de la notificación:\n";
            $logContent .= "  Action: " . ($parsedData['action'] ?? 'No especificado') . "\n";
            $logContent .= "  API Version: " . ($parsedData['api_version'] ?? 'No especificado') . "\n";
            $logContent .= "  Data ID: " . ($parsedData['data']['id'] ?? 'No especificado') . "\n";
            $logContent .= "  Date Created: " . ($parsedData['date_created'] ?? 'No especificado') . "\n";
            $logContent .= "  Notification ID: " . ($parsedData['id'] ?? 'No especificado') . "\n";
            $logContent .= "  Live Mode: " . ($parsedData['live_mode'] ? 'true' : 'false') . "\n";
            $logContent .= "  Type: " . ($parsedData['type'] ?? 'No especificado') . "\n";
            $logContent .= "  User ID: " . ($parsedData['user_id'] ?? 'No especificado') . "\n";
        } else {
            $logContent .= "Body de la notificación no se pudo analizar o está vacío.\n";
        }
    
        // Agregar encabezados y parámetros GET (opcional)
        $logContent .= "Headers:\n" . print_r($headers, true) . "\n";
        $logContent .= "Query Params:\n" . print_r($queryParams, true) . "\n";
        $logContent .= "Body:\n" . $inputData . "\n";
    
        // Escribir en el archivo de log
        file_put_contents($logFile, $logContent . PHP_EOL, FILE_APPEND);
    
        // Opcional: Guardar los datos en un archivo separado (TXT)
        $txtFile = WRITEPATH . 'mercadopago_notification.txt';
        file_put_contents($txtFile, $logContent . PHP_EOL, FILE_APPEND);
    
        // Responder al webhook (MercadoPago requiere un código 200)
        return $this->response->setJSON([
            'message' => 'Notificación registrada correctamente.',
        ])->setStatusCode(200);
    }

}
