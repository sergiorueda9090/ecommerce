<?php
namespace App\Controllers;

use App\Models\OrdersModel;

class ShoppingController extends BaseController{
    
    private $OrdersModel;

    public function __construct(){

        $this->OrdersModel = new OrdersModel();

    }


    public function index(){

        $request = \Config\Services::request();
        $session = \Config\Services::session();
        $session = session();
        $method  = strtoupper($request->getMethod());


        $homeController = new Home();
        $pageInfo       = $homeController->pageInfo();
        $categories     = $homeController->listCategories();
        $footer         = $homeController->footer();
        $header         = $homeController->header();
        $orders         = $this->getOrderCustomer($session->idUser);

        $data = [
           'pageInfo'      => $pageInfo,
           'categories'    => $categories,
           'header'        => $header,
           'footer'        => $footer,
           'orders'        => $orders
       ];

        return view('my_account_my_shopping',$data);
    }

    
    public function getOrderCustomer($idUser = ""){

        if($idUser != ""){

            $result = $this->OrdersModel->select('products.id, products.name, products.slug, orders.quantity, orders.status, orders.image, orders.price')
                                        ->join('products' , 'products.id = orders.id_product', 'inner')
                                        ->where('orders.id_user', $idUser)
                                        ->get()->getResult();

            return $result;
        }

    }

}