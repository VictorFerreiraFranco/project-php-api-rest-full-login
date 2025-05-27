<?php

namespace Api\libraries\apiResponse\messages\auth;

use Api\libraries\apiResponse\messages\IMessages;
use Api\libraries\apiResponse\messages\SendSuccessData;
use Api\libraries\apiResponse\Status;

class AcceptedCredentials extends SendSuccessData
{
    
    /**
     * @param string $token
     *  Define o token de autenticação
     */
    public function __construct(string $token) {
        $data['token'] = $token;
        
        parent::__construct($data, 'Autenticação realizada com sucesso.');
    }
    
    public function getStatus(): Status
    {
        return Status::ACCEPTED;
    }
}