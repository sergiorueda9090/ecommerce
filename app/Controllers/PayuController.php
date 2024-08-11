<?php
namespace App\Controllers;
use App\Models\ProductQuantityColorModel;
use App\Models\OrdersModel;

class PayuController extends BaseController{

    public function response()
    {
        file_put_contents(WRITEPATH . 'logs/payu_response_log.log', "Start of index method" . PHP_EOL, FILE_APPEND);
    
        $params = $this->request->getGet();
        
        file_put_contents(WRITEPATH . 'logs/payu_response_log.log', "Captured params: " . print_r($params, true) . PHP_EOL, FILE_APPEND);
    
        // Aquí puedes continuar con el resto de tu lógica.
        
        file_put_contents(WRITEPATH . 'logs/payu_response_log.log', "End of index method" . PHP_EOL, FILE_APPEND);
    }


    public function confirmation()
    {
        file_put_contents(WRITEPATH . 'logs/payu_confirmation_log.log', "Start of index method" . PHP_EOL, FILE_APPEND);
    
        $params = $this->request->getGet();

        $postData = $this->request->getPost();

        $logData = "Received POST data: " . print_r($postData, true) . PHP_EOL;
       
        file_put_contents(WRITEPATH . 'logs/payu_confirmation_log.log', $logData, 'a+');

        file_put_contents(WRITEPATH . 'logs/payu_confirmation_log.log', "Captured params: " . print_r($params, true) . PHP_EOL, FILE_APPEND);
    
        // Aquí puedes continuar con el resto de tu lógica.
        
        file_put_contents(WRITEPATH . 'logs/payu_confirmation_log.log', "End of index method" . PHP_EOL, FILE_APPEND);
    }

}