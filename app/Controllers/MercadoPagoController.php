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

class MercadoPagoController extends BaseController{
    
    private $OrdersModel;
    private $responseMercado;

    public function __construct(){
        $this->OrdersModel = new OrdersModel();
        MercadoPagoConfig::setAccessToken(getenv('MERCADO_PAGO_ACCESS_TOKEN'));
    }

    public function index(){
        
        MercadoPagoConfig::setAccessToken(getenv('MERCADO_PAGO_ACCESS_TOKEN'));
        
        $client          = new PaymentClient();
        //$request_options = new RequestOptions();
        //$request_options->setCustomHeaders(["X-Idempotency-Key: <SOME_UNIQUE_VALUE>"]);
        
        $createRequest = [
            "transaction_amount" => 5000, // Monto de la transacción
            "description" => "Camiseta de prueba", // Descripción del producto
            "payment_method_id" => "pse", // Método de pago (simulación PSE)
            "callback_url" => "http://www.tu-sitio.com/callback", // URL de callback (modificar según tus pruebas)
            "notification_url" => "http://www.tu-sitio.com/notification", // URL de notificación
            "additional_info" => [
                "ip_address" => "127.0.0.1" // Dirección IP simulada
            ],
            "transaction_details" => [
                "financial_institution" => "1006" // Banco de prueba
            ],
            "payer" => [
                "email" => "test_user@example.com", // Correo de prueba
                "entity_type" => "individual", // Tipo de entidad
                "first_name" => "Juan", // Nombre de prueba
                "last_name" => "Pérez", // Apellido de prueba
                "identification" => [
                    "type" => "CC", // Tipo de identificación (Cédula de Ciudadanía en Colombia)
                    "number" => "1234567890" // Número de identificación de prueba
                ],
                "address" => [
                    "zip_code" => "110111", // Código postal de prueba
                    "street_name" => "Calle Falsa", // Nombre de calle de prueba
                    "street_number" => "123", // Número de calle de prueba
                    "neighborhood" => "Barrio Central", // Barrio de prueba
                    "city" => "Bogotá", // Ciudad de prueba
                    "federal_unit" => "Cundinamarca" // Departamento de prueba
                ],
                "phone" => [
                    "area_code" => "57", // Código de área (Colombia)
                    "number" => "3001234567" // Número de teléfono de prueba
                ],
            ],
        ];
        $payment = $client->create($createRequest/*, $request_options*/);
        $s = "s";
        $s = "s";
        $s = "s";
        return view("mercadopago", array("preference" =>  $payment));
    }

    public function process_payment() {
        // Capturar todos los datos enviados en la solicitud POST
        $params = $this->request->getJSON();
        
        
        MercadoPagoConfig::setAccessToken(getenv('MERCADO_PAGO_ACCESS_TOKEN'));
        
        $client = new PaymentClient();
        $request_options = new RequestOptions();
        $request_options->setCustomHeaders(["X-Idempotency-Key: <SOME_UNIQUE_VALUE>"]);
        
        $createRequest = [
            "transaction_amount" => 5000, // Monto de la transacción
            "description" => "Camiseta de prueba", // Descripción del producto
            "payment_method_id" => "pse", // Método de pago (simulación PSE)
            "callback_url" => "http://www.tu-sitio.com/callback", // URL de callback (modificar según tus pruebas)
            "notification_url" => "http://www.tu-sitio.com/notification", // URL de notificación
            "additional_info" => [
                "ip_address" => "127.0.0.1" // Dirección IP simulada
            ],
            "transaction_details" => [
                "financial_institution" => "1006" // Banco de prueba
            ],
            "payer" => [
                "email" => "test_user@example.com", // Correo de prueba
                "entity_type" => "individual", // Tipo de entidad
                "first_name" => "Juan", // Nombre de prueba
                "last_name" => "Pérez", // Apellido de prueba
                "identification" => [
                    "type" => "CC", // Tipo de identificación (Cédula de Ciudadanía en Colombia)
                    "number" => "1234567890" // Número de identificación de prueba
                ],
                "address" => [
                    "zip_code" => "110111", // Código postal de prueba
                    "street_name" => "Calle Falsa", // Nombre de calle de prueba
                    "street_number" => "123", // Número de calle de prueba
                    "neighborhood" => "Barrio Central", // Barrio de prueba
                    "city" => "Bogotá", // Ciudad de prueba
                    "federal_unit" => "Cundinamarca" // Departamento de prueba
                ],
                "phone" => [
                    "area_code" => "57", // Código de área (Colombia)
                    "number" => "3001234567" // Número de teléfono de prueba
                ],
            ],
        ];
        $payment = $client->create($createRequest, $request_options);
        print_r($payment);
    }

    protected function authenticate(){
        // Getting the access token from .env file (create your own function)
        $mpAccessToken = getenv('MERCADO_PAGO_ACCESS_TOKEN');
        // Set the token the SDK's config
        MercadoPagoConfig::setAccessToken($mpAccessToken);
        // (Optional) Set the runtime enviroment to LOCAL if you want to test on localhost
        // Default value is set to SERVER
        MercadoPagoConfig::setRuntimeEnviroment(MercadoPagoConfig::LOCAL);
    }

    // Function that will return a request object to be sent to Mercado Pago API
    function createPreferenceRequest($items, $payer): array{
        
        $paymentMethods = [
            "excluded_payment_methods" => [],
            "installments" => 12,
            "default_installments" => 1
        ];

        $backUrls = array(
            'success' => 'mercadopago/success',
            'failure' => 'mercadopago/failure'
        );

        $request = [
            "items" => $items,
            "payer" => $payer,
            "payment_methods" => $paymentMethods,
            "back_urls" => $backUrls,
            "statement_descriptor" => "NAME_DISPLAYED_IN_USER_BILLING",
            "external_reference" => "1234567890",
            "expires" => false,
            "auto_return" => 'approved',
        ];

        return $request;
    }

    public function createPaymentPreference(): ?Preference{
        // Fill the data about the product(s) being pruchased
        $product1 = array(
            "id" => "1234567890",
            "title" => "Product 1 Title",
            "description" => "Product 1 Description",
            "currency_id" => "BRL",
            "quantity" => 12,
            "unit_price" => 9.90
        );

        $product2 = array(
            "id" => "9012345678",
            "title" => "Product 2 Title",
            "description" => "Product 2 Description",
            "currency_id" => "BRL",
            "quantity" => 5,
            "unit_price" => 19.90
        );

        // Mount the array of products that will integrate the purchase amount
        $items = array($product1, $product2);

        // Retrieve information about the user (use your own function)
       

        $payer = array(
            "name" => 'Sergio',
            "surname" =>'Rueda',
            "email" => 'Sergio@hotmail.com',
        );

        // Create the request object to be sent to the API when the preference is created
        $request = $this->createPreferenceRequest($items, $payer);

        // Instantiate a new Preference Client
        $client = new PreferenceClient();

        try {
            // Send the request that will create the new preference for user's checkout flow
            $preference = $client->create($request);

            // Useful props you could use from this object is 'init_point' (URL to Checkout Pro) or the 'id'
            return $preference;
        } catch (MPApiException $error) {
            // Here you might return whatever your app needs.
            // We are returning null here as an example.
            return null;
        }
    }

}
