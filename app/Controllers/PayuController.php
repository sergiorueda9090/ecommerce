<?php
namespace App\Controllers;
use App\Models\ProductQuantityColorModel;
use App\Models\OrdersModel;

class PayuController extends BaseController{

    public function index()
    {
        // Escribir un log personalizado al iniciar el controlador
        file_put_contents(WRITEPATH . 'logs/payu_custom_log.log', "Logging directly to file at start of index method" . PHP_EOL, FILE_APPEND);
        
        // Capturar los parámetros GET
        $params = $this->request->getGet();
        
        // Registrar los parámetros en el log personalizado
        $logMessage = "PayU Transaction Response:\n";
        $logMessage .= "Merchant ID: " . ($params['merchantId'] ?? 'N/A') . "\n";
        $logMessage .= "Reference Code: " . ($params['referenceCode'] ?? 'N/A') . "\n";
        // Añadir más detalles...
        
        // Escribir los detalles de la transacción en el archivo de log personalizado
        file_put_contents(WRITEPATH . 'logs/payu_custom_log.log', $logMessage . PHP_EOL, FILE_APPEND);
        
        // Escribir un log al final del procesamiento
        file_put_contents(WRITEPATH . 'logs/payu_custom_log.log', "Finished logging transaction details" . PHP_EOL, FILE_APPEND);
        
        // Puedes continuar con cualquier otra lógica que necesites después
    }

}