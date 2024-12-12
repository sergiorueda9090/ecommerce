<?php
namespace App\Controllers;

use App\Models\OrdersModel;
use Dompdf\Dompdf;

class FacturaController extends BaseController{
    
    private $OrdersModel;

    public function __construct(){

        $this->OrdersModel = new OrdersModel();

    }


    public function index($transactions_id = null){

        $request = \Config\Services::request();
        $session = \Config\Services::session();
        $session = session();
        $method  = strtoupper($request->getMethod());


        $homeController = new Home();
        $AccountCustomers = new AccountController();
        $pageInfo       = $homeController->pageInfo();
        $categories     = $homeController->listCategories();
        $footer         = $homeController->footer();
        $header         = $homeController->header();
        $orders         = $this->getOrderCustomer($session->idUser, $transactions_id);
        $customer       = $AccountCustomers->informationCustomer();

        $data = [
           'pageInfo'      => $pageInfo,
           'categories'    => $categories,
           'header'        => $header,
           'footer'        => $footer,
           'orders'        => $orders,
           'customer'      => $customer
       ];

       if($session->idUser && $transactions_id != null){
            return view('factura',$data);
       }else{
            $url = base_url();
            return redirect()->to($url);
        }
        
    }

    
    public function getOrderCustomer($idUser = "", $transactions_id = ""){

        if($idUser != "" && $transactions_id != ""){

            $result = $this->OrdersModel->select('products.id, products.name, products.slug, orders.quantity, 
                                                 orders.status, orders.image, orders.price, transactions.value,
                                                 orders.created_at')
                                        ->join('products' ,     'products.id = orders.id_product', 'inner')
                                        ->join('transactions',  'orders.transactions_id = transactions.id')
                                        ->where('orders.id_user', $idUser)
                                        ->where('transactions.id', $transactions_id)
                                        ->get()->getResult();

            return $result;
        }else{
            return [];
        }

    }

    public function pdf($orderId="121211111")
    { 
        // Crear el contenido HTML de la factura
        $html = view('facturaprint');
        // Crear una instancia de Dompdf y configurarla
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->render();
        $output = $dompdf->output();
        
        // Create the directory if it doesn't exist
        helper('filesystem');
        if (!is_dir('writable/uploads')) {
            mkdir('writable/uploads', 777, true);
        }
        // Guardar el PDF en el archivo temporal
        $tempFilePath = WRITEPATH . 'uploads/temp_factura_' . $orderId . '.pdf';
        file_put_contents($tempFilePath, $output);

        // Forzar la descarga con cabeceras HTTP
        header('Content-Description: File Transfer');
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="factura_' . $orderId . '.pdf"');
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        readfile($tempFilePath);
        exit;
    }

}