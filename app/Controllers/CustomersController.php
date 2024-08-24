<?php
namespace App\Controllers;
use App\Models\CustomersModel;

class CustomersController extends BaseController{

    private $CustomerModel;

    public function __construct(){
        $this->CustomerModel = new CustomersModel();
    }

    public function register(){
    
        $request = \Config\Services::request();
        $method = strtoupper($request->getMethod());
       
        if($method == 'POST'){

            $json = $request->getJSON();

            if(isset($json->email) && !empty($json->email) ){
                
                $email = $json->email;
                
                $checkEmail = $this->CustomerModel->where('email', $email)->first();
                
                if ($checkEmail) {

                    return $this->response->setJSON(['status' => 400,'exists' => true, 'message'=>'Email already exist'],400);

                } else {

                    $userData = ['email' => $email];
                    $success = $this->CustomerModel->insert($userData);

                    if ($success) {

                      
                        return $this->response->setJSON(['status' => 200, 'exists' => false, 'message' => 'User created successfully'],200);
                   
                    }else{
                  
                        return $this->response->setJSON(['status' => 404, 'exists' => true,  'message' => 'Failed to create user'],200);
                  
                    }
                }
                   
            }

        }

    }

    public function validateEmail(){

        $request = \Config\Services::request();

        $method = strtoupper($request->getMethod());
       
        if($method == 'POST'){

            $json = $request->getJSON();

            if(isset($json->email) && !empty($json->email) ){
                
                $email = $json->email;
                
                $checkEmail = $this->CustomerModel->where('email', $email)->first();
                
                if ($checkEmail) {

                    return $this->response->setJSON(['status' => 200,'exists' => true, 'message'=>'Email already exist'],200);

                } else {

                    return $this->response->setJSON(['status' => 404,'exists' => true, 'message'=>'Email no exist'],404);
               
                }
                   
            }

        }
    }

    function authenticationCustomer(){
        
        $request = \Config\Services::request();
        $session = \Config\Services::session();

        $session = session();
        
        $method = strtoupper($request->getMethod());

        if($method == "POST"){

            $json = $request->getJson();

            if( isset($json->email) && isset($json->password) ){
                 
                $email     = $json->email;
                $password  = $json->password;

                $checkEmail = $this->CustomerModel->where('email', $email)->first();

                if($checkEmail){

                    $checkCustomer = $this->CustomerModel->where("email", $email)->where('password', $password)->first();
                    
                    if($checkCustomer){

                        $session->set('email',      $email);
                        $session->set('idUser',     $checkCustomer->id);
                        $session->set('nameUser',   $checkCustomer->name.' '.$checkCustomer->surname);

                        return $this->response->setJson(['status'  => 200, 'exists' => true, 
                                                         'message' => 'Customer already exist', 
                                                         'data'    => json_encode($checkCustomer, true)],200);

                    }else{

                        return $this->response->setJson(['status' => 404, 'exists' => false, 
                                                         'message' => 'Error in the authentication'], 404);

                    }

                }else{

                    return $this->response->setJson(['status' => 404, 'exists' => false, 'message' => 'Email not exist '.$email], 404);

                }

            }

        }


    }

    function createCustomer(){

        $request = \Config\Services::request();

        $method = strtoupper($request->getMethod());

        if($method == 'POST'){

            $json = $request->getJSON();
            
            if(isset($json->email) && !empty($json->email) ){
                
                $email = $json->email;
                
                $checkEmail = $this->CustomerModel->where('email', $email)->first();
                
                if ($checkEmail) {

                    return $this->response->setJSON(['status' => 400,'exists' => true, 'message'=>'Email already exist'],400);

                } else {

                    $userData = ['name'         => $json->firstName,
                                'lastname'      => $json->lastName,
                                'phone'         => $json->phone,
                                'address'       => $json->address,
                                'department'    => $json->departments,
                                'city'          => $json->city,
                                'email'         => $json->email,
                                'password'      => $json->password];

                    $success = $this->CustomerModel->insert($userData);

                    if ($success) {

                      
                        return $this->response->setJSON(['status' => 200, 'exists' => false, 'message' => 'User created successfully'],200);
                   
                    }else{
                  
                        return $this->response->setJSON(['status' => 404, 'exists' => true,  'message' => 'Failed to create user'],200);
                  
                    }
                }
                   
            }

        }

    }

    function forgetPasswordCustomer(){
        
        $method = strtoupper($request->getMethod());

        if($method == "POST"){

            $json = $request->getJson();

            if( isset($json->email) ){
                 
                $email = $json->email;

                $checkEmail = $this->CustomerModel->where('email', $email)->first();

                if($checkEmail){

                return $this->response->setJson(['status'  => 200, 'exists' => true, 
                                                 'message' => 'Email was sending to '.$email, 
                                                 'data'    => ""],200);

                }else{

                    return $this->response->setJson(['status' => 404, 'exists' => false, 'message' => 'Email was not send '.$email], 404);

                }

            }else{

                return $this->response->setJson(['status' => 500, 'exists' => false, 'message' => 'Email was not send '.$email], 500);

            }

        }else{

            return $this->response->setJson(['status' => 500, 'exists' => false, 'message' => 'Email was not send '.$email], 500);

        }


    }

    public function cerrarSession(){
        
        $request = \Config\Services::request();
        $session = \Config\Services::session();

        $session = session();
        
        $method = strtoupper($request->getMethod());

        if($method == "POST"){

            $session->destroy();

            return $this->response->setJSON(['status' => 200, 'exists' => 'false', 'message' => 'Session destroy succesfully'], 200);

        }


    }

    public function showCustomer(){
        
        $checkEmail = $this->CustomerModel->where('email', $email)->first();

    }

}
