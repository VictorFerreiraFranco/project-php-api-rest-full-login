<?php

namespace Api\libraries\apiResponse\messages;

use Api\libraries\apiResponse\Status;

class SendSuccess implements IMessages
{
    protected ?string $message;
    
    public function __construct(?string $message = null)
    {
        $this->message = $message;
    }
    
    public function getStatus(): Status
    {
        return Status::NO_CONTENT;
    }
    
    public function getMessages(): null|string
    {
        return $this->message;
    }
    
    public function getData(): null|array
    {
        return null;
    }
    
    public function log(): void
    {
    
    }
}