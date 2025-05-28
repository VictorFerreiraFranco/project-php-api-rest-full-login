<?php

namespace Api\libraries\apiResponse\messages\errors;

use Api\libraries\apiResponse\messages\IMessages;
use Api\libraries\apiResponse\Status;
use Api\libraries\translator\Translator;
use Exception;

class ShutDownSystemError implements IMessages
{

    public function getStatus(): Status
    {
        return Status::SERVICE_UNAVAILABLE;
    }
    
    /**
     * @return string
     * @throws Exception
     */
    public function getMessages(): string
    {
        return Translator::get('error.system.shut.down');
    }

    public function getData(): null|array
    {
        return null;
    }

    public function log(): void
    {
    
    }
}