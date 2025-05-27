<?php

namespace Api\libraries\apiResponse\messages\auth;

use Api\libraries\apiResponse\messages\IMessages;
use Api\libraries\apiResponse\Status;

class CredentialsDenied implements IMessages
{
    public function getStatus(): Status
    {
        return Status::VALIDATION_ERROR;
    }
    
    public function getMessages(): string
    {
        return 'Usuário ou senha incorretos';
    }
    
    public function getData(): null|array
    {
        return null;
    }
    
    public function log(): void
    {
    
    }
}