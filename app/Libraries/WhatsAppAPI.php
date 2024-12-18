<?php

namespace App\Libraries;

class WhatsappAPI{

    private $apiUrl;
    private $token;

    public function __construct(){

        $this->apiUrl = getenv('WHATSAPP_API_URL');
        $this->token  = getenv('WHATSAPP_API_TOKEN');

    }

    /**
     * Enviar mensaje por WhatsApp
     *
     * @param string $phone Número de teléfono en formato internacional (incluye código de país)
     * @param string $message Contenido del mensaje
     * @param string $type text, image, document, video, audio
     * @return array|bool Respuesta de la API o false en caso de error
     */
    public function sendMessage(string $phone, $message, string $type)
    {   

        if($type == "image" || $type == "document" || $type == "audio" || $type == "video"){

            $keyy = "link";

            $data = [
                'messaging_product' => 'whatsapp',
                'to'                => $phone,
                'type'              => $type,
                $type               => [$keyy => $message],
            ];

        }else if($type == "location"){

            $keyy = "location";

            $data = [
                'messaging_product' => 'whatsapp',
                'to'                => $phone,
                'type'              => $type,
                $type               =>  $message,
            ];

        }else if($type == "interactive"){
            
            $keyy = "interactive";

            $data = [
                'messaging_product' => 'whatsapp',
                'to'                => $phone,
                'type'              => $type,
                $type               =>  $message,
            ];

        }else{

            $keyy = "body";

            $data = [
                'messaging_product' => 'whatsapp',
                'to'                => $phone,
                'type'              => $type,
                $type               =>  [$keyy => $message],
            ];
        }



        $ch = curl_init($this->apiUrl);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $this->token,
            'Content-Type: application/json',
        ]);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            // Manejo de errores de cURL
            return [
                'error' => true,
                'message' => curl_error($ch),
            ];
        }

        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        // Manejo de la respuesta de la API
        if ($httpCode >= 200 && $httpCode < 300) {
            return json_decode($response, true);
        }

        return [
            'error' => true,
            'message' => 'HTTP Error: ' . $httpCode,
            'response' => $response,
        ];
    }


}


?>