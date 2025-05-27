<?php

namespace Api\libraries\apiResponse\messages\errors;

use Api\libraries\apiResponse\messages\IMessages;
use Api\libraries\apiResponse\Status;

class ShutDownSystemError implements IMessages
{

    public function getStatus(): Status
    {
        return Status::SERVICE_UNAVAILABLE;
    }

    public function getMessages(): string
    {
        return 'O sistema está desligado ou suspenso temporariamente para manutenção.';
    }

    public function getData(): null|array
    {
        return null;
    }

    public function log(): void
    {
    
    }
}