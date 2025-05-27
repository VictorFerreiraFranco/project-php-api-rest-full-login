<?php

namespace Api\libraries\apiResponse\messages;

use Api\libraries\apiResponse\Status;

class InvalidParameters implements IMessages
{
    private string $parameter;
    
    public function __construct(string $parameter)
    {
        $this->parameter = $parameter;
    }
    
    public function getStatus(): Status
    {
        return Status::VALIDATION_ERROR;
    }
    
    public function getMessages(): string
    {
        return "O parâmetro {$this->parameter} é inválido.";
    }
    
    public function getData(): null|array
    {
        return null;
    }
    
    public function log(): void
    {
    
    }
}