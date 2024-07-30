<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use App\Models\UsersModel;

class EnqueueEmailController extends ResourceController{
    
    protected $UsersModel;
    protected $format = 'json';

    public function __construct(){
        $this->UsersModel = new UsersModel();
    }

    public function enqueueEmail($paramsIn="sergio 1"){

        $queueFile = 'email_queue.txt';
        $task = json_encode($paramsIn) . PHP_EOL;
        file_put_contents($queueFile, $task, FILE_APPEND);
    
        $response = array("status"  => false, 
                        "message"   =>  "Solicitud de envío de correo encolada exitosamente.",
                        "code"      => 200);

        return $this->respond($response);

    }



}