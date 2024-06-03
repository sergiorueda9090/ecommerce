<?php
namespace App\Controllers;
use App\Models\CustomersModel;

class ClientController extends BaseController{

    private $CustomerModel;

    public function __construct(){
        $this->CustomerModel = new CustomersModel();
    }

    public function index()
    {
        $model = new CustomersModel();
        return $this->getResponse([
                                    'message' => 'Clients retrieved successfully',
                                    'clients' => $model->findAll()
        ]);
    }


}
