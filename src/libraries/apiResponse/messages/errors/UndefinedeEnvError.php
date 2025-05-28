<?php

namespace Api\libraries\apiResponse\messages\errors;

use Api\libraries\apiResponse\messages\IMessages;
use Api\libraries\apiResponse\Status;
use Api\libraries\sysLogger\SysLogger;
use Api\libraries\translator\Translator;
use Exception;

class UndefinedeEnvError implements IMessages
{
    public function getStatus(): Status
    {
        return Status::INTERNAL_ERROR;
    }
    
    /**
     * @return string
     * @throws Exception
     */
    public function getMessages(): string
    {
        return Translator::get('error.internal.system.parameters.not.found');
    }

    public function getData(): null|array
    {
        return null;
    }
    
    /**
     * @throws Exception
     */
    public function log(): void
    {
        SysLogger::error()->critical($this->getMessages(), ['detail' => 'Undefined env']);
    }
}