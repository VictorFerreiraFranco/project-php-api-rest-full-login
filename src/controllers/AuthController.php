<?php

namespace Api\controllers;

use Api\exceptions\ReponseException;
use Api\libraries\apiResponse\messages\auth\AcceptedCredentials;
use Api\libraries\apiResponse\messages\auth\BlockedAccess;
use Api\libraries\apiResponse\messages\auth\CredentialsDenied;
use Api\libraries\apiResponse\messages\auth\InactiveUser;
use Api\libraries\apiResponse\messages\NotExistParameters;
use Api\libraries\apiResponse\messages\OperationError;
use Api\libraries\apiResponse\messages\SendSuccess;
use Api\libraries\apiResponse\messages\SendSuccessData;
use Api\libraries\auth\AuthUser;
use Api\libraries\auth\JwtHandler;
use Api\libraries\request\Request;
use Api\libraries\sysLogger\SysLogger;
use Api\models\User\Status;
use Api\providers\UserProvider;
use Api\services\UserService;

class AuthController
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
     */
    public static function login(): void
    {
        SysLogger::debug()?->debug('AuthController::login');
        
        if (Request::empty('email'))
            throw new ReponseException(new NotExistParameters('email'));
        
        if (Request::empty('password'))
            throw new ReponseException(new NotExistParameters('password'));
        
        $user = UserProvider::findByEmail((string) Request::get('email'));
        
        if ($user == null)
            throw new ReponseException(new CredentialsDenied());

        if (!password_verify((string) Request::get('password'), $user->password))
            throw new ReponseException(new CredentialsDenied);

        if (($user->status()->id ?? 0) == Status::BLOCKED)
            throw new ReponseException(new BlockedAccess());

        if (($user->status()->id ?? 0) == Status::DELETED)
            throw new ReponseException(new InactiveUser());

        $token = JwtHandler::generateToken($user->id);

        AuthUser::start($user->id);
        
        SysLogger::userDebug()?->debug('Login realizado com sucesso!', [
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
    public static function me(): void
    {
        SysLogger::debug()?->debug('AuthController::me');
        
        throw new ReponseException(new SendSuccessData([
            'name' => AuthUser::getUser()?->name,
            'email' => AuthUser::getUser()?->email,
        ]));
    }
    
    /**
     * Altera a senha do usuário
     *
     * Espera os seguintes parâmetros no corpo da requisição:
     * - old_password (string, obrigatório): Senha atual do usuário.
     * - new_password (string, obrigatório): Nova senha do usuário.
     *
     * @return void
     * @throws ReponseException
     */
    public static function updatePassword(): void
    {
        SysLogger::debug()?->debug('AuthController::updatePassword');
        
        if (Request::empty('old_password'))
            throw new ReponseException(new NotExistParameters('old_password'));
        
        if (Request::empty('new_password'))
            throw new ReponseException(new NotExistParameters('new_password'));
        
        try {
            UserService::updatePassword(
                AuthUser::getUserId(),
                (string) Request::get('old_password'),
                (string) Request::get('new_password')
            );
        } catch (\Exception $e) {
            throw new ReponseException(new OperationError('Atualizar Senha', $e));
        }
        
        throw new ReponseException(new SendSuccess('Senha atualizada com sucesso!'));
    }
}