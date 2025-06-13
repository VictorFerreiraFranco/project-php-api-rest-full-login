<?php

use Api\controllers\AuthController;
use Api\controllers\UserController;
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

// Autenticação
Router::map(Method::POST, '/[a:lang]/auth/login', AuthController::class, ignoreMiddleware: [AuthorizationJwt::class]);
Router::map(Method::GET,  '/[a:lang]/auth/me',    AuthController::class);

// Usuário (perfil)
Router::map(Method::POST, '/[a:lang]/users', UserController::class);
Router::map(Method::PUT, '/[a:lang]/users/profile',  UserController::class);
Router::map(Method::PATCH, '/[a:lang]/users/password', UserController::class);
Router::map(Method::DELETE, '/[a:lang]/users/[i:id]', UserController::class);
Router::map(Method::PATCH, '/[a:lang]/users/[i:id]/block', UserController::class, 'block');
Router::map(Method::PATCH, '/[a:lang]/users/[i:id]/activate', UserController::class, 'activate');
