<?php

namespace Api\libraries\apiResponse\messages\errors;

use Api\libraries\apiResponse\messages\IMessages;
use Api\libraries\apiResponse\Status;

class NotFoundError implements IMessages
{
    public function getStatus(): Status
    {
        return Status::NOT_FOUND;
    }
    
    public function getMessages(): string
    {
        return 'Rota não encontrada!';
    }
    
    public function getData(): null|array
    {
        return null;
    }
    
    public function log(): void
    {
    
    }
}