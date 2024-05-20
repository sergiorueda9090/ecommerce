<?php
namespace App\Controllers;
use App\Models\DepartamentosModel;

class CheckoutController extends BaseController{
    
    private $DepartamentosModel;

    public function __construct(){
        $this->DepartamentosModel = new DepartamentosModel();
    }

    public function index(){
        $homeController = new Home();
        $pageInfo       = $homeController->pageInfo();
        $categories     = $homeController->listCategories();
        $footer         = $homeController->footer();
        $deparments     = $this->departamentos();
        
        $data = [
           'pageInfo'      => $pageInfo,
           'categories'    => $categories,
           'footer'        => $footer,
           'deparments'    => $deparments,
       ];

        return view('checkout',$data);
    }

    public function departamentos(){
        $departamentos = $this->DepartamentosModel->findAll();
        return $departamentos;
    }

    public function checkout(){}


}