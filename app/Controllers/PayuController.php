<?php
namespace App\Controllers;
use App\Models\ProductQuantityColorModel;
use App\Models\OrdersModel;
use App\Models\TransactionsModel;

class PayuController extends BaseController{

    private $TransactionsModel;

    public function __construct(){

        $this->TransactionsModel = new TransactionsModel();

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
    
        //$params = $this->request->getGet();

        //$postData = $this->request->getPost();

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

            $date                   = $postData['date'] ?? 'N/A';
            $pse_reference3         = $postData['pse_reference3'] ?? 'N/A';
            $payment_method_type    = $postData['payment_method_type'] ?? 'N/A';
            $pse_reference2         = $postData['pse_reference2'] ?? 'N/A';
            $franchise              = $postData['franchise'] ?? 'N/A';
            $commission_pol         = $postData['commission_pol'] ?? 'N/A';
            $pse_reference1         = $postData['pse_reference1'] ?? 'N/A';
            $shipping_city          = $postData['shipping_city'] ?? 'N/A';
            $bank_referenced_name   = $postData['bank_referenced_name'] ?? 'N/A';
            $sign                   = $postData['sign'] ?? 'N/A';
            $extra2                 = $postData['extra2'] ?? 'N/A';
            $extra3                 = $postData['extra3'] ?? 'N/A';
            $operation_date         = $postData['operation_date'] ?? 'N/A';
            $payment_request_state  = $postData['payment_request_state'] ?? 'N/A';
            $billing_address        = $postData['billing_address'] ?? 'N/A';
            $extra1                 = $postData['extra1'] ?? 'N/A';
            $administrative_fee     = $postData['administrative_fee'] ?? 'N/A';
            $administrative_fee_tax = $postData['administrative_fee_tax'] ?? 'N/A';
            $bank_id                = $postData['bank_id'] ?? 'N/A';
            $nickname_buyer         = $postData['nickname_buyer'] ?? 'N/A';
            $payment_method         = $postData['payment_method'] ?? 'N/A';
            $attempts               = $postData['attempts'] ?? 'N/A';
            $transaction_id         = $postData['transaction_id'] ?? 'N/A';
            $transaction_date       = $postData['transaction_date'] ?? 'N/A';
            $test                   = $postData['test'] ?? 'N/A';
            $exchange_rate          = $postData['exchange_rate'] ?? 'N/A';
            $ip                     = $postData['ip'] ?? 'N/A';
            $reference_pol          = $postData['reference_pol'] ?? 'N/A';
            $cc_holder              = $postData['cc_holder'] ?? 'N/A';
            $tax                    = $postData['tax'] ?? 'N/A';
            $antifraudMerchantId    = $postData['antifraudMerchantId'] ?? 'N/A';
            $pse_bank               = $postData['pse_bank'] ?? 'N/A';
            $transaction_type       = $postData['transaction_type'] ?? 'N/A';
            $state_pol              = $postData['state_pol'] ?? 'N/A';
            $billing_city           = $postData['billing_city'] ?? 'N/A'; // Appears twice in your list, so ensure to handle it appropriately
            $phone                  = $postData['phone'] ?? 'N/A';
            $error_message_bank     = $postData['error_message_bank'] ?? 'N/A';
            $shipping_country       = $postData['shipping_country'] ?? 'N/A';
            $error_code_bank        = $postData['error_code_bank'] ?? 'N/A';
            $cus                    = $postData['cus'] ?? 'N/A';
            $commission_pol_currency= $postData['commission_pol_currency'] ?? 'N/A';
            $customer_number        = $postData['customer_number'] ?? 'N/A';
            $description            = $postData['description'] ?? 'N/A';
            $merchant_id            = $postData['merchant_id'] ?? 'N/A';
            $administrative_fee_base = $postData['administrative_fee_base'] ?? 'N/A';
            $authorization_code     = $postData['authorization_code'] ?? 'N/A';
            $currency               = $postData['currency'] ?? 'N/A';
            $shipping_address       = $postData['shipping_address'] ?? 'N/A';
            $nickname_seller        = $postData['nickname_seller'] ?? 'N/A';
            $cc_number              = $postData['cc_number'] ?? 'N/A'; // Ensure to handle sensitive data like credit card numbers carefully
            $installments_number    = $postData['installments_number'] ?? 'N/A';
            $value                  = $postData['value'] ?? 'N/A';
            $transaction_bank_id    = $postData['transaction_bank_id'] ?? 'N/A';
            $billing_country        = $postData['billing_country'] ?? 'N/A';
            $cardType               = $postData['cardType'] ?? 'N/A';
            $response_code_pol      = $postData['response_code_pol'] ?? 'N/A';
            $payment_method_name    = $postData['payment_method_name'] ?? 'N/A';
            $office_phone           = $postData['office_phone'] ?? 'N/A';
            $email_buyer            = $postData['email_buyer'] ?? 'N/A';
            $payment_method_id      = $postData['payment_method_id'] ?? 'N/A';
            $response_message_pol   = $postData['response_message_pol'] ?? 'N/A';
            $account_id             = $postData['account_id'] ?? 'N/A';
            $bank_referenced_code   = $postData['bank_referenced_code'] ?? 'N/A';
            $airline_code           = $postData['airline_code'] ?? 'N/A';
            $pseCycle               = $postData['pseCycle'] ?? 'N/A';
            $risk                   = $postData['risk'] ?? 'N/A';
            $reference_sale         = $postData['reference_sale'] ?? 'N/A';
            $additional_value       = $postData['additional_value'] ?? 'N/A';
            //$jsonData               = json_encode($postData);

            // Data to be saved
            $data = array(
                "merchant_id"           => $postData['merchant_id'] ?? 'N/A',
                "state_pol"             => $postData['state_pol'] ?? 'N/A',
                "payment_method"        => $postData['payment_method'] ?? 'N/A',
                "payment_method_type"   => $postData['payment_method_type'] ?? 'N/A',
                "value"                 => "value",
                "currency"              => $postData['currency']  ?? 'N/A',
                "email_buyer"           => $postData['email_buyer']  ?? 'N/A',
                "date"                  => $postData['date']  ?? 'N/A',
                "data"                  => json_encode($postData)
            );

            if($this->TransactionsModel->insert($data)){

                file_put_contents(WRITEPATH . 'logs/payu_confirmation_log.log', "REGISTRO AGREGADO CORRECTAMENTE". PHP_EOL, FILE_APPEND);

            }else{
                
                $error = $this->transactionModel->errors();

                $logError = "Failed to save the transaction. Error: " . print_r($error, true);
                
                file_put_contents(WRITEPATH . 'logs/payu_confirmation_log.log', $logError, FILE_APPEND);


            }

            /*foreach ($postData as $key => $value) {
                $logDatapost = "POST - $key: $value" . PHP_EOL;
                file_put_contents(WRITEPATH . 'logs/payu_confirmation_log.log', $logDatapost. PHP_EOL, FILE_APPEND);
            }*/
        }

        //$logData = "Received POST data: " . print_r($postData, true) . PHP_EOL;
       
        //file_put_contents(WRITEPATH . 'logs/payu_confirmation_log.log', $logData);

        //file_put_contents(WRITEPATH . 'logs/payu_confirmation_log.log', "Captured params: " . print_r($params, true) . PHP_EOL, FILE_APPEND);
    
        // Aquí puedes continuar con el resto de tu lógica.
        
        //file_put_contents(WRITEPATH . 'logs/payu_confirmation_log.log', "End of index method" . PHP_EOL, FILE_APPEND);
    }

}