<?php
namespace App\Controllers;
use App\Models\ProductQuantityColorModel;
use App\Models\OrdersModel;

class PayuController extends BaseController{

    public function index()
    {
        file_put_contents(WRITEPATH . 'logs/payu_custom_log.log', "Start of index method" . PHP_EOL, FILE_APPEND);
    
        $params = $this->request->getGet();
        file_put_contents(WRITEPATH . 'logs/payu_custom_log.log', "Captured params: " . print_r($params, true) . PHP_EOL, FILE_APPEND);
    
        // Aquí puedes continuar con el resto de tu lógica.
        
        file_put_contents(WRITEPATH . 'logs/payu_custom_log.log', "End of index method" . PHP_EOL, FILE_APPEND);
    }

}