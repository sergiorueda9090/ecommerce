<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use App\Models\SocialNetworkModel;

class SocialNetworkController extends ResourceController{
    
    protected $SocialNetworkModel;
    protected $format = 'json';

    public function __construct(){
        $this->SocialNetworkModel = new SocialNetworkModel();
    }
    
    public function listAll(){

        $SocialNetworkModel =$this->SocialNetworkModel->findAll();
    
        return $this->respond($SocialNetworkModel);
    
    }

    public function show($id = null){

        if($id != null){

            $userModel = $this->SocialNetworkModel->find( $id );

            if($userModel == null){

                $response = [
                    'status' => false,
                    'message' => 'Failed Social Network not exist',
                    'data' => null
                ];

            }else{

                $response = [
                    'status' => true,
                    'message' => 'Social Network found',
                    'data' => $userModel
                ];

                return $this->respond($response);
            }


        }else{

            $response = [
                'status' => false,
                'message' => 'Failed to show Social Network',
                'data' => null
            ];
    
            return $this->fail($response);

        }
        

    }

    public function create(){

        $dataSocialNetwork = array(
            "icon"      => $this->request->getPost("icon"),
            "url"       => $this->request->getPost("url"),
        );

        $insertSocialNetwork = $this->SocialNetworkModel->insert($dataSocialNetwork);

        if($insertSocialNetwork){

            $idSocialNetwork = $this->SocialNetworkModel->insertID();

            $response = [
                'status' => true,
                'message' => 'Social Network created successfully',
                'data' => $idSocialNetwork
            ];

            return $this->respondCreated($response);

        }else{

            $response = [
                'status' => false,
                'message' => 'Failed to create Social Network',
                'data' => null
            ];
    
            return $this->fail($response);

        }

    }

    public function update($id = null) {

        if ($id != null) {

            $dataSocialNetwork = array(
                "url"      => $this->request->getPost("url"),
                "icon"     => $this->request->getPost("icon"),
            );
    
            // Check if user exists
            $socialNetworkResponse = $this->SocialNetworkModel->find($id);
    
            if ($socialNetworkResponse == null) {

                $response = [
                    'status' => false,
                    'message' => 'Social Network not found',
                    'data' => null
                ];
    
                return $this->respond($response);

            } else {

                // Update user data
                $socialNetworkResponse = $this->SocialNetworkModel->update($id, $dataSocialNetwork);
    
                if ($socialNetworkResponse) {

                    $socialNetworkResponse['id'] = $id; // Ensure the ID is included in the response
    
                    $response = [
                        'status' => true,
                        'message' => 'Social Network updated successfully',
                        'data' => $socialNetworkResponse
                    ];
    
                    return $this->respond($response);

                } else {

                    $response = [
                        'status' => false,
                        'message' => 'Failed to update Social Network',
                        'data' => null
                    ];
    
                    return $this->fail($response);
                }
            }
        } else {

            $response = [
                'status' => false,
                'message' => 'Invalid Social Network ID',
                'data' => null
            ];
    
            return $this->fail($response);
        }
    }

    public function delete($id = null){

        if($id != null){

            $socialNetworkFind = $this->SocialNetworkModel->find( $id );

            if($socialNetworkFind){

                $deleteSocialNetwork = $this->SocialNetworkModel->delete( $id );

                if($deleteUser){

                    $response = [
                        'status'    => true,
                        'message'   => 'Social Network Delete successfully',
                        'data'      => $deleteSocialNetwork
                    ];
    
                    return $this->respond($response);


                }else{

                    $response = [
                        'status'    => false,
                        'message'   => 'Social Network Delete error',
                        'data'      => $deleteUser
                    ];
    
                    return $this->respond($response); 

                }

            }else{

                $response = [
                    'status'    => true,
                    'message'   => 'Social Network not found',
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