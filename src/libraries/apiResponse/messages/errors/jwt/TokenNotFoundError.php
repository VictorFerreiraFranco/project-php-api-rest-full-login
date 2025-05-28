<?php

namespace Api\libraries\apiResponse\messages\errors\jwt;

use Api\libraries\apiResponse\messages\IMessages;
use Api\libraries\apiResponse\Status;
use Api\libraries\translator\Translator;
use Exception;

class TokenNotFoundError implements IMessages
{
    public function getStatus(): Status
    {
        return Status::UNAUTHORIZED;
    }
    
    /**
     * @return string
     * @throws Exception
     */
    public function getMessages(): string
    {
        return Translator::get('error.jwt.token.not.provided');
    }
    
    public function getData(): null|array
    {
        return null;
    }
    
    public function log(): void
    {
    
    }
}