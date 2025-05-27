<?php

namespace Api\libraries\router\middlewares;

use Api\exceptions\ReponseException;
use Api\libraries\apiResponse\messages\errors\ShutDownSystemError;
use Api\libraries\sysLogger\SysLogger;

class ShutDownSystem implements IMiddleware
{
    /**
     * Verifica se o sistema está desligado
     * @return void
     * @throws ReponseException
     */
    public static function run(): void
    {
        SysLogger::debug()?->debug('Checking shutdown system');
        
        if (SHUTDOWN_MODE == 1)
            throw new ReponseException(new ShutDownSystemError());
    }
    
}