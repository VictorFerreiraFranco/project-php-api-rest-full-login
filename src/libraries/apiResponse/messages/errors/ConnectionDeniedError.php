<?php

namespace Api\libraries\apiResponse\messages\errors;

use Api\libraries\apiResponse\messages\IMessages;
use Api\libraries\apiResponse\Status;
use Api\libraries\sysLogger\SysLogger;

class ConnectionDeniedError implements IMessages
{

    public function getStatus(): Status
    {
        return Status::INTERNAL_ERROR;
    }

    public function getMessages(): string
    {
        return 'Erro interno ao conetar ao servidor!';
    }

    public function getData(): null|array
    {
        return null;
    }

    public function log(): void
    {
        SysLogger::error()->critical($this->getMessages(), ['detail' => 'Erro ao conectar aos bancos de dados']);
    }
}