<?php
namespace App\Controllers;

class ShoppingCartController extends BaseController{
    
    public function index(){
        $homeController = new Home();
        $pageInfo       = $homeController->pageInfo();
        $categories     = $homeController->listCategories();
        $header         = $homeController->header();
        $footer         = $homeController->footer();

        $data = [
           'pageInfo'    => $pageInfo,
           'categories'  => $categories,
           'header'      => $header,
           'footer'      => $footer,
       ];

        return view('shoppingcar',$data);
    }

}
