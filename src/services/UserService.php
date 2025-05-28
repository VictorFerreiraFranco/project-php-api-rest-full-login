<?php

namespace Api\services;

use Api\helpers\PasswordHelper;
use Api\libraries\sysLogger\SysLogger;
use Api\libraries\translator\Translator;
use Api\models\User\Status;
use Api\models\User\User;
use Exception;

class UserService
{
    /**
     * Cria um novo usuário
     * @param string $name
     * @param string $email
     * @param string $password
     * @param int $user_status_id
     * @return void
     * @throws Exception
     */
    public static function include(
        string $name,
        string $email,
        string $password,
        int $user_status_id = Status::ACTIVE,
    ): void
    {
        SysLogger::debug()?->debug('AuthController::include');
        
        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->password = PasswordHelper::hash($password);
        $user->user_status_id = $user_status_id;
        
        if (!$user->save())
            throw new Exception(Translator::get('auth.error.creating.user'));
    }
    
    /**
     * Atualiza o usuário
     * @param int $id
     * @param string $name
     * @param string $email
     * @param int|null $user_status_id
     * @return void
     * @throws Exception
     */
    public static function update(
        int $id,
        string $name,
        string $email,
        ?int $user_status_id = null,
    ): void
    {
        SysLogger::debug()?->debug('AuthController::update');
        
        $user = User::find($id);
        
        if (empty($user))
            throw new Exception('Usuário não encontrado');
        
        $user->name = $name;
        $user->email = $email;
        
        if ($user_status_id)
            $user->user_status_id = $user_status_id;
        
        if (!$user->save())
            throw new Exception(Translator::get('auth.error.updating.user'));
    }
    
    /**
     * Atualiza a senha do usuário
     * @param int $id
     * @param string $oldPassword
     * @param string $newPassword
     * @return void
     * @throws Exception
     */
    public static function updatePassword(
        int $id,
        string $oldPassword,
        string $newPassword,
    ): void
    {
        SysLogger::debug()?->debug('AuthController::updatePassword');
        
        $user = User::find($id);
        
        if (empty($user))
            throw new Exception(Translator::get('auth.error.user.not.found'));
            
        if (!password_verify($oldPassword, $user->password))
            throw new Exception(Translator::get('validation.parameter.invalid', ['parameter' => Translator::get('parameter.password')]));
        
        $user->password = PasswordHelper::hash($newPassword);
        
        if (!$user->save())
            throw new Exception(Translator::get('auth.password.updated.successfully'));
    }
    
    /**
     * Bloqueia o usuário
     * @param int $id
     * @return void
     * @throws Exception
     */
    public static function block(int $id): void
    {
        SysLogger::debug()?->debug('AuthController::block');
        
        $user = User::find($id);
        
        if (empty($user))
            throw new Exception(Translator::get('auth.error.user.not.found'));
        
        $user->user_status_id = Status::BLOCKED;
        
        if (!$user->save())
            throw new Exception(Translator::get('auth.error.blocking.user'));
    }
    
    /**
     * Deleta o usuário
     * @param int $id
     * @return void
     * @throws Exception
     */
    public static function delete(int $id): void
    {
        SysLogger::debug()?->debug('AuthController::delete');
        
        $user = User::find($id);
        
        if (empty($user))
            throw new Exception(Translator::get('auth.error.user.not.found'));
        
        $user->user_status_id = Status::DELETED;
        
        if (!$user->save())
            throw new Exception(Translator::get('auth.error.deleting.user'));
    }
}