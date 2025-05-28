<?php

namespace Api\libraries\apiResponse\messages\auth;

use Api\libraries\apiResponse\messages\SendSuccessData;
use Api\libraries\apiResponse\Status;
use Api\libraries\translator\Translator;
use Exception;

class AcceptedCredentials extends SendSuccessData
{
    /**
     * @param string $token
     *  Define o token de autenticação
     * @throws Exception
     */
    public function __construct(string $token) {
        $data['token'] = $token;
        
        parent::__construct($data, Translator::get('auth.authentication.successfully'));
    }
    
    public function getStatus(): Status
    {
        return Status::ACCEPTED;
    }
}