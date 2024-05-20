<?php
namespace App\Controllers;
use App\Models\TransactionsModel;


class TransactionsController extends BaseController{

    private $transactionModel;

    public function __construct(){
        $this->transactionModel = new TransactionsModel();
    }

    public function createTransactions($data){

        $success = $this->transactionModel->insert($data);

        if($success){
            return redirect()->to('/payuconfirmation')->with('success', 'Transaction created successfully');
        }else{
            return redirect()->to('/payuconfirmation')->with('error', 'Transaction creation failed');
        }

    }

}