<?php
namespace App\Controllers;
use App\Models\ProductQuantityColorModel;
use App\Models\OrdersModel;

class PayuController extends BaseController{

    public function index(){
       
        #http://ecommerce/public/payuconfirmation?&payu=true&productos=8-3-2-1,8-2-2-1,8-1-2-1&merchantId=508029&merchant_name=Test+PayU+Test&merchant_address=Av+123+Calle+12&telephone=7512354&merchant_url=http%3A%2F%2Fpruebaslapv.xtrweb.com&transactionState=6&lapTransactionState=DECLINED&message=Declinada&referenceCode=2015-05-27+13%3A04%3A37&reference_pol=7069375&transactionId=f5e668f1-7ecc-4b83-a4d1-0aaa68260862&description=test_payu_01&trazabilityCode=&cus=&orderLanguage=es&extra1=&extra2=&extra3=&polTransactionState=6&signature=e1b0939bbdc99ea84387bee9b90e4f5c&polResponseCode=5&lapResponseCode=ENTITY_DECLINED&risk=1.00&polPaymentMethod=10&lapPaymentMethod=VISA&polPaymentMethodType=2&lapPaymentMethodType=CREDIT_CARD&installmentsNumber=1&TX_VALUE=100.00&TX_TAX=.00&currency=USD&lng=es&pseCycle=&buyerEmail=test%40payulatam.com&pseBank=&pseReference1=&pseReference2=&pseReference3=&authorizationCode=&TX_ADMINISTRATIVE_FEE=.00&TX_TAX_ADMINISTRATIVE_FEE=.00&TX_TAX_ADMINISTRATIVE_FEE_RETURN_BASE=.00
        #https://ecommerce.sergiodevsolutions.com/payuconfirmation?&payu=true&productos=2-1-2-1

               // Capturar todos los parámetros de la URL
               $params = $this->request->getGet(); // Obtiene todos los parámetros GET
               $apiKey = "4Vj8eK4rloUd272L48hsrarnUA";
       
               // Extraer cada parámetro individualmente
               $merchantId = $params['merchantId'] ?? '';
               $referenceCode = $params['referenceCode'] ?? '';
               $TX_VALUE = $params['TX_VALUE'] ?? '';
               $currency = $params['currency'] ?? '';
               $transactionState = $params['transactionState'] ?? '';
               $firma = $params['signature'] ?? '';
               $referencePol = $params['reference_pol'] ?? '';
               $cus = $params['cus'] ?? '';
               $description = $params['description'] ?? '';
               $pseBank = $params['pseBank'] ?? '';
               $lapPaymentMethod = $params['lapPaymentMethod'] ?? '';
               $transactionId = $params['transactionId'] ?? '';
       
               // Calcular la firma para verificarla
               $newValue = number_format($TX_VALUE, 1, '.', '');
               $firmaCadena = "$apiKey~$merchantId~$referenceCode~$newValue~$currency~$transactionState";
               $firmaCreada = md5($firmaCadena);
       
               // Determinar el estado de la transacción
               $estadoTx = '';
               switch ($transactionState) {
                   case 4:
                       $estadoTx = "Transaction approved";
                       break;
                   case 6:
                       $estadoTx = "Transaction rejected";
                       break;
                   case 104:
                       $estadoTx = "Error";
                       break;
                   case 7:
                       $estadoTx = "Pending payment";
                       break;
                   default:
                       $estadoTx = $params['mensaje'] ?? 'Unknown state';
                       break;
               }
       
               // Cargar el servicio de logger
               $logger = \Config\Services::logger();
       
               // Crear un log bien formateado
               $logMessage = "PayU Transaction Response:\n";
               $logMessage .= "Merchant ID: $merchantId\n";
               $logMessage .= "Reference Code: $referenceCode\n";
               $logMessage .= "Transaction ID: $transactionId\n";
               $logMessage .= "Reference POL: $referencePol\n";
               $logMessage .= "Transaction State: $estadoTx\n";
               $logMessage .= "Total Amount: $TX_VALUE\n";
               $logMessage .= "Currency: $currency\n";
               $logMessage .= "Description: $description\n";
               $logMessage .= "PSE Bank: $pseBank\n";
               $logMessage .= "Payment Method: $lapPaymentMethod\n";
               $logMessage .= "Signature Valid: " . (strtoupper($firma) === strtoupper($firmaCreada) ? 'Yes' : 'No') . "\n";
               $logMessage .= "---------------------------------------------------\n";
       
               // Registrar en el log
               $logger->info($logMessage);
          return;
        $session            = \Config\Services::session();
        $session            = session();
        $emailUser          = $session->get('email');
        $idUser             = $session->get('idUser');

        $ApiKey             = "4Vj8eK4rloUd272L48hsrarnUA";
        $merchant_id        = $_REQUEST['merchantId'];
        $referenceCode      = $_REQUEST['referenceCode'];
        $TX_VALUE           = $_REQUEST['TX_VALUE'];
        $New_value          = number_format($TX_VALUE, 1, '.', '');
        $currency           = $_REQUEST['currency'];
        $transactionState   = $_REQUEST['transactionState'];
        $firma_cadena       = "$ApiKey~$merchant_id~$referenceCode~$New_value~$currency~$transactionState";
        $firmacreada        = md5($firma_cadena);
        $firma              = $_REQUEST['signature'];
        $reference_pol      = $_REQUEST['reference_pol'];
        $cus                = $_REQUEST['cus'];
        $extra1             = $_REQUEST['description'];
        $pseBank            = $_REQUEST['pseBank'];
        $lapPaymentMethod   = $_REQUEST['lapPaymentMethod'];
        $transactionId      = $_REQUEST['transactionId'];
        $products           = $_REQUEST['productos']; // position-1 = id_color, position-2 = id_size, position-3 = quantity, position-4 = idProduct
        $payu               = $_REQUEST['payu'];

        if ($_REQUEST['transactionState'] == 4 ) {
            $estadoTx = "Transaction approved";
        }

        else if ($_REQUEST['transactionState'] == 6 ) {
            $estadoTx = "Transaction rejected";
        }

        else if ($_REQUEST['transactionState'] == 104 ) {
            $estadoTx = "Error";
        }

        else if ($_REQUEST['transactionState'] == 7 ) {
            $estadoTx = "Pending payment";
        }

        else {
            $estadoTx=$_REQUEST['mensaje'];
        }

        $TransactionsController     = new TransactionsController();
        $productQuantityColorModel  = new ProductQuantityColorModel();
        $ordersModel                = new OrdersModel();

        // Prepare data array for the view
        $data = array(
            'estadoTx'          => $estadoTx,
            'merchant_id'       => $merchant_id,
            'referenceCode'     => $referenceCode,
            'TX_VALUE'          => $TX_VALUE,
            'currency'          => $currency,
            'transactionState'  => $transactionState,
            'signature'         => $firma,
            'reference_pol'     => $reference_pol,
            'cus'               => $cus,
            'extra1'            => $extra1,
            'pseBank'           => $pseBank,
            'lapPaymentMethod'  => $lapPaymentMethod,
            'transactionId'     => $transactionId,
            'products'          => $products,
            'payu'              => $payu
        );

        $TransactionsController->createTransactions($data);

        $productsArray = explode(",",$products);

        $arrayB = [];

        foreach($productsArray as $array){
            // Explota cada elemento en subelementos
            list($id_color, $id_size, $quantity, $idProduct) = explode("-", $array);

            // Crea un array asociativo para cada producto
            $arrayB[] = [
                "email"             => $emailUser,
                "id_user"           => $idUser,
                "id_product"        => $idProduct,
                "id_size"           => (int)$id_size,
                "id_color"          => (int)$id_color,
                "quantity"          => (int)$quantity,
                "transactions_id"   => $transactionState,
                "status"            => 1
            ];
        }

         $ordersModel->insertBatch($arrayB);

        /**
         * query product - size and color:
         * SELECT * FROM products 
         * INNER JOIN productsize ON productsize.id_product = products.id
         * INNER JOIN  productcolor ON productcolor.id_productsize = productsize.id
         * INNER JOIN  productquantity ON productquantity.id_productcolor = productcolor.id
         * WHERE products.id = 26 and productsize.id = 78 and productcolor.id = 234;
         * 
         * SELECT * FROM `productquantity` WHERE id_productcolor = 234;
         */

        if ($_REQUEST['transactionState'] == 4 ) {
            $estadoTx = "Transaction approved";
        }

        
        foreach($arrayB as $key => $value){
            $idProduct = $value['id_color'];
            $updateProductQuantity = $productQuantityColorModel->set('count', 'count-' . $value['quantity'], FALSE)->where('id_productcolor', $value['id_color'])->update();
        }

        //return view('payuConfirm',$data);
    }

}