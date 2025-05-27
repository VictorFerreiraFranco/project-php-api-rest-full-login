<?php

namespace Api\libraries\apiResponse\messages\errors;

use Api\libraries\apiResponse\messages\IMessages;
use Api\libraries\apiResponse\Status;
use Api\libraries\sysLogger\SysLogger;
use Throwable;

class RouteMethodNotDefinedError implements IMessages
{
    public function getStatus(): Status
    {
        return Status::NOT_FOUND;
    }
    
    public function getMessages(): string
    {
        return 'Método da rota não definido!';
    }
    
    public function getData(): null|array
    {
        return null;
    }
    
    public function log(): void
    {
    
    }
}