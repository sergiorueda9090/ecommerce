<?php
namespace App\Controllers;


class EpaycoController extends BaseController{
    
    public function index(){

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
        $customer       = $AccountCustomers->informationCustomer();

        $data = [
           'pageInfo'      => $pageInfo,
           'categories'    => $categories,
           'header'        => $header,
           'footer'        => $footer,
           'customer'      => $customer
       ];
    
        return view("epayco",$data);
    
    }

}
