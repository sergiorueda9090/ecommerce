<?php

namespace App\Controllers\api;
use CodeIgniter\RESTful\ResourceController;
use App\Libraries\WhatsAppAPI;
use CodeIgniter\Log\Logger;

class WhatsappAPIController extends ResourceController {

    private $whatsapp;

    public function __construct(){
        // Instancia de la clase WhatsappAPI
        $this->whatsapp = new WhatsAppAPI();
    }


    public function VerifyToken(){
        try {
            $accessToken = "555566666TTTTTTT"; // getenv('WHATSAPP_API_TOKEN');
            
            $token = $this->request->getGet("hub_verify_token");
            $challenge = $this->request->getGet("hub_challenge");
    
            log_message('info', 'VerifyToken method called. Token received: {token}', ['token' => $token]);
    
            if ($token === null || $token === "" || $challenge === null) {
                log_message('warning', 'Missing token or challenge in VerifyToken.');
                return $this->response->setStatusCode(400)->setBody('Error: Missing token or challenge');
            }
    
            if ($accessToken !== $token) {
                log_message('warning', 'Token mismatch in VerifyToken. Expected: {accessToken}, Received: {token}', [
                    'accessToken' => $accessToken,
                    'token' => $token
                ]);
                return $this->response->setStatusCode(403)->setBody('Error: Invalid token');
            }
    
            log_message('info', 'Token verified successfully. Challenge: {challenge}', ['challenge' => $challenge]);
            
            // Facebook validation requires plain text response
            return $this->response
                        ->setStatusCode(200)
                        ->setHeader('Content-Type', 'text/plain')
                        ->setBody($challenge);
        } catch (Exception $e) {
            log_message('error', 'Exception in VerifyToken: {message}', ['message' => $e->getMessage()]);
            return $this->response->setStatusCode(500)->setBody('Internal Server Error');
        }
    }

    public function ReceivedMessage(){
        try {
            log_message('info', 'ReceivedMessage: Method called');
    
            // Obtiene el cuerpo de la solicitud como JSON
            $data = $this->request->getJSON();
    
            if (!$data) {
                log_message('error', 'ReceivedMessage: Missing or invalid JSON payload');
                return $this->respond([
                    'status' => 400,
                    'message' => 'Bad Request: Missing or invalid JSON payload',
                    'data' => null
                ], 400);
            }
    
            // Extrae el mensaje y el número de teléfono
            $message = $data->entry[0]->changes[0]->value->messages[0] ?? null;
            $phone = $data->entry[0]->changes[0]->value->messages[0]->from ?? null;
    
            log_message('info', 'ReceivedMessage: Extracted message and phone', ['phone' => $phone]);
    
            if (!$message || !$phone) {
                log_message('error', 'ReceivedMessage: Missing message or phone data');
                return $this->respond([
                    'status' => 400,
                    'message' => 'Bad Request: Missing message or phone data',
                    'data' => null
                ], 400);
            }
    
            // Procesa el mensaje según el tipo
            $response = $this->GetTextUser($message);
            log_message('info', 'ReceivedMessage: Message type identified as {type}', ['type' => $response['type']]);
            
            $bodyMsg = strtolower($message->text->body);

            if ($bodyMsg == "text") {

                $sendMsg = $bodyMsg;
                
                log_message('info', 'ReceivedMessage: Processing text message: {text}', ['text' => $sendMsg]);
    
                $responseTXT = $this->ProcessMessage($sendMsg, $phone); //$this->TextMessage($sendMsg, $phone);
    
            } elseif ($bodyMsg == "format") {

                log_message('info', 'ReceivedMessage: Processing formatted text message');
    
                $responseTXT = $this->TextFormatMessage($phone);
    
            } elseif ($bodyMsg == "image") {
                
                log_message('info', 'ReceivedMessage: Processing image message');
    
                $responseTXT = $this->ImageMessage($phone);
    
            } elseif ($bodyMsg == "video") {

                log_message('info', 'ReceivedMessage: Processing video message');
    
                $responseTXT = $this->VideoMessage($phone);
    
            } elseif ($bodyMsg == "audio") {

                log_message('info', 'ReceivedMessage: Processing audio message');
    
                $responseTXT = $this->AudioMessage($phone);
    
            } elseif ($bodyMsg == "document") {

                log_message('info', 'ReceivedMessage: Processing document message');
    
                $responseTXT = $this->DocumentMessage($phone);
    
            } elseif ($bodyMsg == "location") {

                log_message('info', 'ReceivedMessage: Processing location message');
    
                $responseTXT = $this->LocationMessage($phone);
    
            } elseif ($bodyMsg == "button") {

                log_message('info', 'ReceivedMessage: Processing button message');
    
                $responseTXT = $this->ButttonMessage($phone);
    
            } elseif ($bodyMsg == "list") {

                log_message('info', 'ReceivedMessage: Processing list message');
    
                $responseTXT = $this->ButttonListMessage($phone);
    
            } else {
                log_message('warning', 'ReceivedMessage: Unsupported message type: {type}', ['type' => $response['type']]);
                return $this->respond([
                    'status' => 400,
                    'message' => 'Unsupported message type',
                    'data' => null
                ], 400);
            }
    
            // Envía la respuesta de WhatsApp
            log_message('info', 'ReceivedMessage: Sending response to WhatsApp');
            $response = $this->sendMessage($responseTXT);
    
            log_message('info', 'ReceivedMessage: Response sent successfully');
            return $this->respond($response);
    
        } catch (Exception $e) {
            log_message('error', 'ReceivedMessage: Exception occurred: {message}', ['message' => $e->getMessage()]);
            $response = [
                'status' => 500,
                'message' => $e->getMessage(),
                'data' => null
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

    public function ProcessMessage($text, $number){

        $text = strtolower($text);
        
        $listaData = [];

        if($text == "hi" || $text == "hola" || $text == "hello" || $text == "option"){

            $responseTXT = $this->TextMessage("Hello can how help you? ", $number);
            
            $dataOption  = $this->ButttonListMessage($number);
            
            array_push($listaData, $responseTXT, $dataOption);

        }elseif($text == "thank" || $text == "gracias"){

            $responseTXT = $this->TextMessage("Thank you for contacting me. ", $number);

        }else{

            $responseTXT = $this->TextMessage("I'm Sorry, I can't understand you. ", $number);

        }

        $response = $this->sendMessage($responseTXT);
        
        return $this->respond($response);

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