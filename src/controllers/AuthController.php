<?php

namespace Api\controllers;

use Api\exceptions\ReponseException;
use Api\libraries\apiResponse\messages\auth\AcceptedCredentials;
use Api\libraries\apiResponse\messages\auth\BlockedAccess;
use Api\libraries\apiResponse\messages\auth\CredentialsDenied;
use Api\libraries\apiResponse\messages\auth\InactiveUser;
use Api\libraries\apiResponse\messages\NotExistParameters;
use Api\libraries\apiResponse\messages\SendSuccessData;
use Api\libraries\auth\AuthUser;
use Api\libraries\auth\JwtHandler;
use Api\libraries\request\Request;
use Api\libraries\sysLogger\SysLogger;
use Api\libraries\translator\Translator;
use Api\models\User\Status;
use Api\providers\UserProvider;

class AuthController extends Controller
{
    /**
     * Realiza o login do usuário
     *
     * Espera os seguintes parâmetros no corpo da requisição:
     *  - email (string, obrigatório): E-mail do usuário.
     *  - password (string, obrigatório): Senha do usuário.
     *
     * @return void
     * @throws ReponseException
     * @throws \Exception
     */
    public static function post(): void
    {
        SysLogger::debug()?->debug('AuthController::post');
        
        if (Request::empty('email'))
            throw new ReponseException(new NotExistParameters(Translator::get('parameter.email')));
        
        if (Request::empty('password'))
            throw new ReponseException(new NotExistParameters(Translator::get('parameter.password')));
        
        $user = UserProvider::findByEmail((string) Request::get('email'));
        
        if ($user == null)
            throw new ReponseException(new CredentialsDenied());

        if (!password_verify((string) Request::get('password'), $user->password))
            throw new ReponseException(new CredentialsDenied);

        if (($user->status->id ?? 0) == Status::BLOCKED)
            throw new ReponseException(new BlockedAccess());

        if (($user->status->id ?? 0) == Status::DELETED)
            throw new ReponseException(new InactiveUser());

        $token = JwtHandler::generateToken($user->id);

        AuthUser::start($user->id);
        
        SysLogger::userDebug()?->debug('Login successfully', [
            'id' => $user->id,
            'email' => $user->email,
            'token' => $token,
        ]);
        
        throw new ReponseException(new AcceptedCredentials($token));
    }
    
    /**
     * Retorna os dados do usuário logado
     * @return void
     * @throws ReponseException
     */
    public static function get(): void
    {
        SysLogger::debug()?->debug('AuthController::get');
        
        throw new ReponseException(new SendSuccessData([
            'name' => AuthUser::getUser()?->name,
            'email' => AuthUser::getUser()?->email,
        ]));
    }
}