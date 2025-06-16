<?php

use Api\config\Config;
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
use Api\libraries\translator\Lang;
use Api\libraries\translator\Translator;

session_start();

set_exception_handler(function (Throwable $e) {
    ApiResponse::send(new UnmappedError($e));
});

try {
    require_once __DIR__ . '/vendor/autoload.php';
    
    Config::initialize( __DIR__);
    
    SysLogger::initialize();
    
    Translator::initialize(Lang::fromString(substr($_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? Config::get('DEFAULT_LANGUAGE'), 0, 2)));
    
    SysLogger::debug()?->debug('Initializing execution');
    
    Database::initialize();
    
    Request::initialize();
    
    Router::setMiddleware([
        ShutDownSystem::class,
        AuthorizationJwt::class
    ]);
    
    require_once Config::get('PROJECT_ROOT') . '/src/routes/routers.php';
    
    Router::dispatch();
    
    throw new ReponseException(new SendSuccess());

} catch (ReponseException $e) {
    ApiResponse::send($e->getMenssageResponse());
} catch (Throwable $e) {
    ApiResponse::send(new UnmappedError($e));
} finally {
    SysLogger::debug()?->debug('End execution');
}

