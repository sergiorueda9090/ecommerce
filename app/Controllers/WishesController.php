<?php
namespace App\Controllers;

class WishesController extends BaseController{
    

    public function index(){
        $homeController = new Home();
        $pageInfo       = $homeController->pageInfo();
        $categories     = $homeController->listCategories();
        $footer         = $homeController->footer();
        $header         = $homeController->header();
        
        $data = [
           'pageInfo'      => $pageInfo,
           'categories'    => $categories,
           'header'        => $header,
           'footer'        => $footer,
       ];

        return view('my_account_wishlist',$data);
    }




}