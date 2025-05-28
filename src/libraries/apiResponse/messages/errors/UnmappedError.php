<?php

namespace Api\libraries\apiResponse\messages\errors;

use Api\libraries\apiResponse\messages\IMessages;
use Api\libraries\apiResponse\Status;
use Api\libraries\sysLogger\SysLogger;
use Api\libraries\translator\Translator;
use Exception;
use Throwable;

class UnmappedError implements IMessages
{
    private Throwable $throwable;
    
    /**
     * @param Throwable $throwable
     */
    public function __construct(Throwable $throwable)
    {
        $this->throwable = $throwable;
    }
    
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
        return Translator::get('error.internal.unmapped');
    }

    public function getData(): null|array
    {
        return null;
    }

    public function log(): void
    {
        SysLogger::error()->critical(
            $this->throwable->getMessage(),
            [
                'code' => $this->throwable->getCode(),
                'file' => $this->throwable->getFile(),
                'line' => $this->throwable->getLine(),
                'previous' => $this->throwable->getPrevious(),
                'trace' => $this->throwable->getTrace(),
                'traceAsString' => $this->throwable->getTraceAsString(),
            ]
        );
    }
}