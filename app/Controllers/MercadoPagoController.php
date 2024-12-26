<?php

namespace App\Controllers;

use App\Models\OrdersModel;
use Dompdf\Dompdf;

// SDK de Mercado Pago
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\Client\Common\RequestOptions;

use MercadoPago\Client\PaymentMethod\PaymentMethodClient;

class MercadoPagoController extends BaseController{
    
    private $OrdersModel;
    private $responseMercado;

    public function __construct(){
        $this->OrdersModel = new OrdersModel();
        MercadoPagoConfig::setAccessToken(getenv('MERCADO_PAGO_ACCESS_TOKEN'));
    }

    public function index(){
        MercadoPagoConfig::setAccessToken(getenv('MERCADO_PAGO_ACCESS_TOKEN'));
        $client = new PaymentMethodClient();
        $payment_methods = $client->list();
        return view("mercadopago", array("payment_methods" =>  $payment_methods));
    }

    public function payment_methods(){
           // Configuración del token de MercadoPago
           MercadoPagoConfig::setAccessToken(getenv('MERCADO_PAGO_ACCESS_TOKEN'));

           // Obtener métodos de pago
           $client = new PaymentMethodClient();
           $payment_methods = $client->list();
   
           // Devolver los métodos de pago en formato JSON
           return $this->response->setJSON($payment_methods);
    }

    public function process_payment() {
     
        MercadoPagoConfig::setAccessToken(getenv('MERCADO_PAGO_ACCESS_TOKEN'));
        
        $client = new PaymentClient();
        $request_options = new RequestOptions();
        $request_options->setCustomHeaders(["X-Idempotency-Key: <SOME_UNIQUE_VALUE>"]);
        
        $client = new PaymentClient();
        $createRequest = [
            "transaction_amount" => 5000, // Monto de la transacción en COP
            "description" => "Compra de ejemplo", // Descripción del producto o servicio
            "payment_method_id" => "pse", // Método de pago
            "callback_url" => "https://pidelibre.com/", // URL de retorno
            "notification_url" => "https://pidelibre.com/", // URL de notificaciones
            "additional_info" => [
                "ip_address" => "127.0.0.1" // Dirección IP del cliente
            ],
            "transaction_details" => [
                "financial_institution" => "1007" // Ejemplo: Bancolombia (ID ficticio)
            ],
            "payer" => [
                "email" => "usuario@ejemplo.com", // Correo del pagador
                "entity_type" => "individual", // Tipo de entidad
                "first_name" => "Juan", // Nombre
                "last_name" => "Pérez", // Apellido
                "identification" => [
                    "type" => "CC", // Tipo de identificación (CC = Cédula de ciudadanía)
                    "number" => "123456789" // Número de identificación
                ],
                "address" => [
                    "zip_code" => "110111", // Código postal
                    "street_name" => "Calle Falsa", // Dirección
                    "street_number" => "123", // Número de la calle
                    "neighborhood" => "Centro", // Barrio
                    "city" => "Bogotá", // Ciudad
                    "federal_unit" => "Cundinamarca" // Departamento o región
                ],
                "phone" => [
                    "area_code" => "1", // Código de área
                    "number" => "3001234567" // Número telefónico
                ],
            ],
        ];
        
        $payment = $client->create($createRequest, $request_options);
        print_r($payment);
    }



}
