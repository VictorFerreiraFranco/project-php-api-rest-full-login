<?php

namespace Api\libraries\apiResponse;

use Api\libraries\apiResponse\messages\IMessages;

class ApiResponse
{
    /**
     * Envia a resposta para API
     * @param IMessages $messages
     * @return void
     */
    public static function send(IMessages $messages): void
    {
        $content = [
            'status' => $messages->getStatus()->get(),
            'code' => $messages->getStatus()->getCode()
        ];

        if (!empty($messages->getMessages()))
            $content['message'] = $messages->getMessages();
        
        if ($messages->getData() !== null)
            $content['data'] = $messages->getData();

        $messages->log();

        ob_clean();
        
        header("Content-Type: application/json");

        http_response_code($messages->getStatus()->getCode());

        echo json_encode($content);
    }
}