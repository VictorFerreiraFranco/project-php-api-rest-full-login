<?php

namespace Api\libraries\apiResponse\messages\errors;

use Api\libraries\apiResponse\messages\IMessages;
use Api\libraries\apiResponse\Status;
use Api\libraries\translator\Translator;
use Exception;

class NotFoundError implements IMessages
{
    public function getStatus(): Status
    {
        return Status::NOT_FOUND;
    }
    
    /**
     * @return string
     * @throws Exception
     */
    public function getMessages(): string
    {
        return Translator::get('error.route.not.found');
    }
    
    public function getData(): null|array
    {
        return null;
    }
    
    public function log(): void
    {
    
    }
}