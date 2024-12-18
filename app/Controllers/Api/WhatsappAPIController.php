<?php

namespace App\Controllers\api;
use CodeIgniter\RESTful\ResourceController;
use App\Libraries\WhatsAppAPI;

class WhatsappAPIController extends ResourceController {

    private $whatsapp;

    public function __construct(){
        // Instancia de la clase WhatsappAPI
        $this->whatsapp = new WhatsAppAPI();
    }


    public function VerifyToken(){

        try{
            $accessToken = "555566666TTTTTTT"; //getenv('WHATSAPP_API_TOKEN');
        
            $token      = $this->request->getGet("hub_verify_token");
            $challenge  = $this->request->getGet("hub_challenge");
    
            if($token == null || $token == "" && $challenge == null){
               
                $response = [
                    'status' => 400,
                    'message' => 'Error',
                    'data' => null
                ];
    
                return $this->respond($response);
                
            }else if($accessToken !== $token){
               
                $response = [
                    'status' => 400,
                    'message' => 'ErrorToken ',
                    'data' => null
                ];
    
                return $this->respond($response);
    
            }else{
    
                $response = [
                    'status' => 200,
                    'message' => $challenge,
                    'data' => null
                ];
    
                return $this->respond($response);
    
            }

        }catch(Exception $e){

            $response = [
                'status' => 500,
                'message' => $e->getMessage(),
                'data' => null
            ];

            return $this->respond($response);

        }

    }

    public function ReceivedMessage(){

        try{

            $data    = $this->request->getJSON();  
            $message = $data->entry[0]->changes[0]->value->messages[0];
            $phone   = $data->entry[0]->changes[0]->value->messages[0]->from;
            
           
            //TEXTO
            $response = $this->GetTextUser($message);
            
            if($response["type"] == "text"){

                $sendMsg = $data->entry[0]->changes[0]->value->messages[0]->text->body;

                $responseTXT = $this->TextMessage($sendMsg, $phone);

            }elseif($response["type"] == "format"){

                $responseTXT = $this->TextFormatMessage($phone);

            }elseif($response["type"] == "image"){

                $responseTXT = $this->ImageMessage($phone);


            }elseif($response["type"] == "video"){

                $responseTXT = $this->VideoMessage($phone);

            }elseif($response["type"] == "audio"){

                $responseTXT = $this->AudioMessage($phone);

            }elseif($response["type"] == "document"){

                $responseTXT = $this->DocumentMessage($phone);

            }elseif($response["type"] == "location"){

                $responseTXT = $this->LocationMessage($phone);

            }elseif($response["type"] == "button"){

                $responseTXT = $this->ButttonMessage($phone);

            }elseif($response["type"] == "list"){

                $responseTXT = $this->ButttonListMessage($phone);

            }

            //SEND WHATSAPP
            $response = $this->sendMessage($responseTXT);

            return $this->respond($response);
    

        }catch(Exception $e){
            $response = [
                'status' => 500,
                'message' => $e->getMessage(),
                'data' => ""
            ];
    
            return $this->respond($response);
        }

    }

    public function sendMessage($data){

        try{

            $type =  $data["type"];

            $phone = $data["to"];
            
            if($type == "image"){

                $message = $data['image']['link'];

            }elseif($type == "document"){

                $message = $data['document']['link'];

            }elseif($type == "audio"){

                $message = $data['audio']['link'];

            }elseif($type == "video"){

                $message = $data['video']['link'];

            }elseif($type == "location"){

                $message = $data['location'];

            }elseif($type == "interactive"){

                $message = $data['interactive'];

            }elseif($type == "list"){

                $message = $data['interactive'];

            }else{

                $message = $data['text']['body'];

            }
            
            
            $response = $this->whatsapp->sendMessage($phone, $message, $type);
    
            return $this->respond($response);

        }catch(Exception $e){

            $response = [
                'status' => 500,
                'message' => $e->getMessage(),
                'data' => null
            ];

            return $this->respond($response);

        }



    }

    public function GetTextUser($message){

        $text = "";

        $typeText = $message->type;

        if($typeText == "text"){
        
            $text = $message->text->body;
        
        }else if($typeText == "interactive"){
            
            $interactiveObject = $message->interactive;
            $typeInteractive   = $interactiveObject->type;

            if($typeInteractive == "button_reply"){

                $text = $interactiveObject->button_reply->title;

            }else if($typeInteractive == "list_reply"){

                $text = $interactiveObject->list_reply->title;

            }else{

                $text = "Sin mensaje";

            }

        }else{
            $text = "sin mensaje t";
        }

        return array("text" => $text, "type" => $typeText);
    }

    public function TextMessage($text, $number){

        $data = [
            "messaging_product" => "whatsapp",
            "preview_url"       => false,
            "recipient_type"    => "individual",
            "to"                => $number,
            "type"              => "text",
            "text"              => ["body" => $text]
        ];
        
        return $data;

    }

    public function TextFormatMessage($number){

        $data = [
            "messaging_product" => "whatsapp",
            "preview_url"       => false,
            "recipient_type"    => "individual",
            "to"                => $number,
            "type"              => "text",
            "text"              => ["body" => "*Hello user* - Ejemplo _Hello user_ - ~Hello user~ - ``` Hello user ```"]
        ];

        return $data;

    }

    public function ImageMessage($number){

        $data = [
            "messaging_product" => "whatsapp",
            "to"                => $number,
            "type"              => "image",
            "image"              => ["link" => "https://www.clipartbest.com/cliparts/Rcd/agL/RcdagLAki.png"]
        ];

        return $data;

    }


    public function AudioMessage($number){

        $data = [
            "messaging_product" => "whatsapp",
            "to"                => $number,
            "type"              => "audio",
            "audio"              => ["link" => "https://cdn.pixabay.com/audio/2024/12/09/audio_5c5be993bd.mp3"]
        ];
        
        return $data;

    }

    public function VideoMessage($number){

        $data = [
            "messaging_product" => "whatsapp",
            "to"                => $number,
            "type"              => "video",
            "video"              => ["link"   => "https://videos.pexels.com/video-files/9871915/9871915-uhd_2560_1440_30fps.mp4",
                                    "caption" =>"Ejemplo Video"]
        ];
        
        return $data;

    }

    public function DocumentMessage($number){

        $data = [
            "messaging_product" => "whatsapp",
            "to"                => $number,
            "type"              => "document",
            "document"          => ["link"   => "https://downloads.bbc.co.uk/learningenglish/features/6min/241212_6_minute_english_making_mum_friends_transcript.pdf"]
        ];
        
        return $data;

    }

    public function LocationMessage($number){

        $data = [
            "messaging_product" => "whatsapp",
            "to" => $number,
            "type" => "location",
            "location" => [
                "latitude" => "7.136904144273406",
                "longitude" => "-73.11606757754241",
                "name" => "Estadio Departamental Américo José Montanini",
                "address" => "Bucaramanga, Santander"
            ]
        ];

        return $data;

    }


    public function ButttonMessage($number){

        $data = [
            "messaging_product" => "whatsapp",
            "recipient_type" => "individual",
            "to" => $number,
            "type" => "interactive",
            "interactive" => [
                "type" => "button",
                "body" => [
                    "text" => "Confirmar tu registro?"
                ],
                "action" => [
                    "buttons" => [
                        [
                            "type" => "reply",
                            "reply" => [
                                "id" => "001",
                                "title" => "✅ Si"
                            ]
                        ],
                        [
                            "type" => "reply",
                            "reply" => [
                                "id" => "002",
                                "title" => "❌ No"
                            ]
                        ]
                    ]
                ]
            ]
        ];

        return $data;

    }

    public function ButttonListMessage($number){

        $data = [
            "messaging_product" => "whatsapp",
            "to" => "51943662964",
            "type" => "interactive",
            "interactive" => [
                "type" => "list",
                "body" => [
                    "text" => "✅ I have these options"
                ],
                "footer" => [
                    "text" => "Select an option"
                ],
                "action" => [
                    "button" => "See options",
                    "sections" => [
                        [
                            "title" => "Buy and sell products",
                            "rows" => [
                                [
                                    "id" => "main-buy",
                                    "title" => "Buy",
                                    "description" => "Buy the best product for your home"
                                ],
                                [
                                    "id" => "main-sell",
                                    "title" => "Sell",
                                    "description" => "Sell your products"
                                ]
                            ]
                        ],
                        [
                            "title" => "📍Center of attention",
                            "rows" => [
                                [
                                    "id" => "main-agency",
                                    "title" => "Agency",
                                    "description" => "You can visit our agency"
                                ],
                                [
                                    "id" => "main-contact",
                                    "title" => "Contact center",
                                    "description" => "One of our agents will assist you"
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];

        return $data;

    }

}