<?php

use Api\controllers\AuthController;
use Api\exceptions\ReponseException;
use Api\libraries\apiResponse\messages\SendSuccess;
use Api\libraries\router\Method;
use Api\libraries\router\Router;
use Api\libraries\router\middlewares\AuthorizationJwt;

Router::map(
    Method::GET,
    '/',
    fn () => throw new ReponseException(new SendSuccess('Bem Vindo!')),
    ignoreMiddleware: [AuthorizationJwt::class]
);

// Auth Routes
Router::map(Method::POST, '/login', AuthController::class, 'login', ignoreMiddleware: [AuthorizationJwt::class]);
Router::map(Method::GET, '/me', AuthController::class, 'me');
Router::map(Method::PATCH, '/updatePassword', AuthController::class, 'updatePassword');

