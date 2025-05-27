<?php

use Api\config\Database;
use Api\exceptions\ReponseException;
use Api\libraries\apiResponse\ApiResponse;
use Api\libraries\apiResponse\messages\errors\UnmappedError;
use Api\libraries\apiResponse\messages\SendSuccess;
use Api\libraries\request\Request;
use Api\libraries\router\middlewares\AuthorizationJwt;
use Api\libraries\router\middlewares\ShutDownSystem;
use Api\libraries\router\Router;
use Api\libraries\sysLogger\SysLogger;

session_start();

try {
    define('PROJECT_ROOT', __DIR__);
    define('BASE_URI', rtrim(dirname($_SERVER['SCRIPT_NAME']), '/'));
    
    require_once PROJECT_ROOT . '/vendor/autoload.php';
    
    SysLogger::initialize();
    
    require_once PROJECT_ROOT . '/src/config/constants.php';
    
    SysLogger::debug()?->debug('Initializing execution');
    
    Database::initialize();
    
    Request::initialize();
    
    Router::setMiddleware([
        ShutDownSystem::class,
        AuthorizationJwt::class
    ]);
    
    require_once PROJECT_ROOT . '/src/routes/routers.php';
    
    Router::dispatch();
    
    throw new ReponseException(new SendSuccess());

} catch (ReponseException $e) {
    SysLogger::debug()?->debug('End execution');
    ApiResponse::send($e->getMenssageResponse());
} catch (Throwable $e) {
    ApiResponse::send(new UnmappedError($e));
}

