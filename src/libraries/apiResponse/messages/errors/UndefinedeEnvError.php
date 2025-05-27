<?php

namespace Api\libraries\apiResponse\messages\errors;

use Api\libraries\apiResponse\messages\IMessages;
use Api\libraries\apiResponse\Status;
use Api\libraries\sysLogger\SysLogger;

class UndefinedeEnvError implements IMessages
{
    public function getStatus(): Status
    {
        return Status::INTERNAL_ERROR;
    }

    public function getMessages(): string
    {
        return 'Parâmetros internos do sistema não encontrados!';
    }

    public function getData(): null|array
    {
        return null;
    }

    public function log(): void
    {
        SysLogger::error()->critical($this->getMessages(), ['detail' => 'Undefined env']);
    }
}