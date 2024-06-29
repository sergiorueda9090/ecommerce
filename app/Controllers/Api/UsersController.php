<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use App\Models\UsersModel;

class UsersController extends ResourceController{
    
    protected $UsersModel;
    protected $format = 'json';

    public function __construct(){
        $this->UsersModel = new UsersModel();
    }

    public function showUser($id = null){

        if($id != null){

            $userModel = $this->UsersModel->find( $id );

            if($userModel == null){

                $response = [
                    'status' => false,
                    'message' => 'Failed user not exist',
                    'data' => null
                ];

            }else{

                $response = [
                    'status' => true,
                    'message' => 'User found',
                    'data' => $userModel
                ];

                return $this->respond($response);
            }


        }else{

            $response = [
                'status' => false,
                'message' => 'Failed to show user',
                'data' => null
            ];
    
            return $this->fail($response);

        }
        

    }

    public function updateUser($id = null) {

        if ($id != null) {
            $ddd =  $this->request;

            $dataUser = array(
                "name"      => $this->request->getPost("name"),
                "email"     => $this->request->getPost("email"),
                "password"  => $this->request->getPost("password")
            );
    
            // Check if user exists
            $userModel = $this->UsersModel->find($id);
    
            if ($userModel == null) {

                $response = [
                    'status' => false,
                    'message' => 'User not found',
                    'data' => null
                ];
    
                return $this->respond($response);

            } else {

                // Update user data
                $updateUser = $this->UsersModel->update($id, $dataUser);
    
                if ($updateUser) {

                    $dataUser['id'] = $id; // Ensure the ID is included in the response
    
                    $response = [
                        'status' => true,
                        'message' => 'User updated successfully',
                        'data' => $dataUser
                    ];
    
                    return $this->respond($response);

                } else {

                    $response = [
                        'status' => false,
                        'message' => 'Failed to update user',
                        'data' => null
                    ];
    
                    return $this->fail($response);
                }
            }
        } else {
            $response = [
                'status' => false,
                'message' => 'Invalid user ID',
                'data' => null
            ];
    
            return $this->fail($response);
        }
    }

    public function listAllUsers()
    {

        $usersModel =$this->UsersModel->findAll();
    
        return $this->respond($usersModel);
    
    }

    public function createUser(){

        $dataUser = array(
            "name"      => $this->request->getPost("name"),
            "email"     => $this->request->getPost("email"),
            "password"  => $this->request->getPost("password")
        );

        $insertUser = $this->UsersModel->insert($dataUser);

        if($insertUser){

            $dataUser['id'] = $this->UsersModel->insertID();

            $response = [
                'status' => true,
                'message' => 'User created successfully',
                'data' => $dataUser
            ];

            return $this->respondCreated($response);

        }else{

            $response = [
                'status' => false,
                'message' => 'Failed to create user',
                'data' => null
            ];
    
            return $this->fail($response);

        }

    }

    public function deleteUser($id = null){

        if($id != null){

            $userFind = $this->UsersModel->find( $id );

            if($userFind){

                $deleteUser = $this->UsersModel->delete( $id );

                if($deleteUser){

                    $response = [
                        'status'    => true,
                        'message'   => 'User Delete successfully',
                        'data'      => $userFind
                    ];
    
                    return $this->respond($response);


                }else{

                    $response = [
                        'status'    => false,
                        'message'   => 'User Delete error',
                        'data'      => $userFind
                    ];
    
                    return $this->respond($response); 

                }

            }else{

                $response = [
                    'status'    => true,
                    'message'   => 'User not found',
                    'data'      => $id
                ];

                return $this->respond($response);

            }

        }else{

            
            $response = [
                'status'    => true,
                'message'   => 'Id IS NULL',
                'data'      => $id
            ];

            return $this->respond($response);

        }

    }

}