<?php

namespace Api\libraries\apiResponse\messages;

use Api\libraries\apiResponse\Status;

class SendSuccessData extends SendSuccess
{
    private ?array $data = null;
    
    public function __construct(array $data, ?string $mensage = null)
    {
        $this->data = $data;
        
        parent::__construct($mensage);
    }
    
    public function getStatus(): Status
    {
        return Status::SUCCESS;
    }
    
    public function getData(): null|array
    {
        return $this->data;
    }
}