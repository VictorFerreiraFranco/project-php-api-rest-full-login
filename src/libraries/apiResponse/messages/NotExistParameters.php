<?php

namespace Api\libraries\apiResponse\messages;

use Api\libraries\apiResponse\Status;
use Api\libraries\translator\Translator;

class NotExistParameters implements IMessages
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
        return Translator::get('validation.parameter.not.found', ['parameter' => $this->parameter]);
    }
    
    public function getData(): null|array
    {
        return null;
    }
    
    public function log(): void
    {
    
    }
}