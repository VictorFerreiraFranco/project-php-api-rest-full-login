<?php

namespace Api\libraries\apiResponse\messages\errors\jwt;

use Api\libraries\apiResponse\messages\IMessages;
use Api\libraries\apiResponse\Status;

class ExpiredTokenError implements IMessages
{
    public function getStatus(): Status
    {
        return Status::UNAUTHORIZED;
    }
    
    public function getMessages(): string
    {
        return 'Token expirado!';
    }
    
    public function getData(): null|array
    {
        return null;
    }
    
    public function log(): void
    {
    
    }
}