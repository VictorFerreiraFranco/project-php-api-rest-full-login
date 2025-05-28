<?php

use Api\controllers\AuthController;
use Api\exceptions\ReponseException;
use Api\libraries\apiResponse\messages\SendSuccess;
use Api\libraries\router\Method;
use Api\libraries\router\Router;
use Api\libraries\router\middlewares\AuthorizationJwt;
use Api\libraries\translator\Translator;

// Exemplo de rota por função
Router::map(
    Method::GET,
    '/',
    fn () => throw new ReponseException(new SendSuccess(Translator::get('system.welcome'))),
    ignoreMiddleware: [AuthorizationJwt::class]
);

// Auth Routes
Router::map(Method::POST, '/login', AuthController::class, ignoreMiddleware: [AuthorizationJwt::class]);
Router::map(Method::GET, '/me', AuthController::class);
Router::map(Method::PATCH, '/updatePassword', AuthController::class, 'updatePassword');

// Exemplo de rota com parâmetro dinâmico e com definição de idioma
Router::map(Method::POST, '/[a:lang]/login', AuthController::class, ignoreMiddleware: [AuthorizationJwt::class]);
