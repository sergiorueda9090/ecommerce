<?php
namespace App\Controllers;
use App\Models\ProductQuantityColorModel;
use App\Models\OrdersModel;
use App\Models\TransactionsModel;

class PayuController extends BaseController{

    private $TransactionsModel;
    private $OrdersModel;

    public function __construct(){

        $this->TransactionsModel = new TransactionsModel();
        $this->OrdersModel       = new OrdersModel();

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


    public function confirmation()
    {
        file_put_contents(WRITEPATH . 'logs/payu_confirmation_log.log', "Start of index method" . PHP_EOL, FILE_APPEND);
    


        $params = $this->request->getGet();
 
        $postData = $this->request->getPost();

        if (!empty($params)) {

            foreach ($params as $key => $value) {
                $logDataget = "GET - $key: $value" . PHP_EOL;
                file_put_contents(WRITEPATH . 'logs/payu_confirmation_log.log', $logDataget. PHP_EOL, FILE_APPEND);
            }
       
        }

        // Log POST data
        if (!empty($postData)) {
            
            file_put_contents(WRITEPATH . 'logs/payu_confirmation_log.log',"INGRESO". PHP_EOL, FILE_APPEND);

            // Data to be saved
            $data = array(
                "merchant_id"           => $postData['merchant_id'] ?? 'N/A',
                "state_pol"             => $postData['state_pol'] ?? 'N/A',
                "payment_method"        => $postData['payment_method'] ?? 'N/A',
                "payment_method_type"   => $postData['payment_method_type'] ?? 'N/A',
                "value"                 => $postData['value'],
                "currency"              => $postData['currency']  ?? 'N/A',
                "email_buyer"           => $postData['email_buyer']  ?? 'N/A',
                "date"                  => $postData['date']  ?? 'N/A',
                "data"                  => json_encode($postData)
            );

            if($this->TransactionsModel->insert($data)){

                file_put_contents(WRITEPATH . 'logs/payu_confirmation_log.log', "REGISTRO AGREGADO CORRECTAMENTE". PHP_EOL, FILE_APPEND);

                $products  = $this->request->getGet(); // position-1 = id_color, position-2 = id_size, position-3 = quantity, position-4 = idProduct

                $productsArray = explode(",",$products);

                $arrayB = [];
        
                foreach($productsArray as $array){
                    // Explota cada elemento en subelementos
                    list($id_color, $id_size, $quantity, $idProduct) = explode("-", $array);
        
                    // Crea un array asociativo para cada producto
                    $arrayB[] = [
                        "email"             => $postData['email_buyer'],
                        "id_user"           => 1,
                        "id_product"        => $idProduct,
                        "id_size"           => (int)$id_size,
                        "id_color"          => (int)$id_color,
                        "quantity"          => (int)$quantity,
                        "transactions_id"   => $postData['state_pol'] ?? 'N/A',
                        "status"            => 1
                    ];
                }
        
                $result = $this->ordersModel->insertBatch($arrayB);

                if ($result === false) {

                    
                    $error = $this->ordersModel->errors();

                    log_message('error', 'Failed to insert batch orders: ' . print_r($error, true));
                  
                } else {
                    
                    log_message('info', 'Successfully inserted ' . $result . ' batch orders.');
                   
                }

            }else{
                
                $error = $this->transactionModel->errors();

                $logError = "Failed to save the transaction. Error: " . print_r($error, true);
                
                file_put_contents(WRITEPATH . 'logs/payu_confirmation_log.log', $logError, FILE_APPEND);


            }
        }
    }

}