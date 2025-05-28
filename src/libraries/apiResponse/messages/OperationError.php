<?php

namespace Api\libraries\apiResponse\messages;

use Api\libraries\apiResponse\Status;
use Api\libraries\sysLogger\SysLogger;
use Api\libraries\translator\Translator;
use Exception;
use Throwable;

class OperationError implements IMessages
{
    private string $operation;
    
    private ?Throwable $throwable;
    
    public function __construct(string $operation, ?Throwable $throwable = null)
    {
        $this->operation = $operation;
        $this->throwable = $throwable;
    }
    
    public function getStatus(): Status
    {
        return Status::VALIDATION_ERROR;
    }
    
    /**
     * @return string
     * @throws Exception
     */
    public function getMessages(): string
    {
        return Translator::get('system.error.performing.operatio', ['operation' => $this->operation]);
    }
    
    public function getData(): null|array
    {
        return null;
    }
    
    public function log(): void
    {
        SysLogger::debug()?->debug($this->getMessages(), [
            'menssage' => $this->throwable->getMessage(),
            'code' => $this->throwable->getCode(),
            'file' => $this->throwable->getFile(),
            'line' => $this->throwable->getLine(),
            'previous' => $this->throwable->getPrevious(),
            'trace' => $this->throwable->getTrace(),
            'traceAsString' => $this->throwable->getTraceAsString(),
        ]);
    }
}