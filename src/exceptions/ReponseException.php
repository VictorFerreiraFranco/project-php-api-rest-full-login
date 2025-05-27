<?php

namespace Api\exceptions;

use Api\libraries\apiResponse\messages\IMessages;
use Exception;

class ReponseException extends Exception
{
    private IMessages $menssageResponse;

    public function __construct(IMessages $message) {
        $this->menssageResponse = $message;

        parent::__construct($message->getMessages(), $message->getStatus()->getCode());
    }

    public function getMenssageResponse(): IMessages
    {
        return $this->menssageResponse;
    }
}