<?php

namespace Api\services;

use Api\helpers\PasswordHelper;
use Api\libraries\sysLogger\SysLogger;
use Api\libraries\translator\Translator;
use Api\models\User\Status;
use Api\models\User\User;
use Api\providers\UserProvider;
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
        SysLogger::debug()?->debug('UserService::include');
        
        $user = UserProvider::findByEmail($email);
        
        if (!empty($user))
            throw new Exception(Translator::get('user.error.email.already.registered', ['email' => $email]));
        
        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->password = PasswordHelper::hash($password);
        $user->user_status_id = $user_status_id;
        
        if (!$user->save())
            throw new Exception(Translator::get('user.error.creating.user'));
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
        SysLogger::debug()?->debug('UserService::update');
        
        $user = User::find($id);
        
        if (empty($user))
            throw new Exception(Translator::get('user.error.user.not.found'));
        
        if (UserProvider::findByEmail($email, $id))
            throw new Exception(Translator::get('user.error.email.already.registered', ['email' => $email]));
        
        $user->name = $name;
        $user->email = $email;
        
        if ($user_status_id)
            $user->user_status_id = $user_status_id;
        
        if (!$user->save())
            throw new Exception(Translator::get('user.error.updating.user'));
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
        SysLogger::debug()?->debug('UserService::updatePassword');
        
        $user = User::find($id);
        
        if (empty($user))
            throw new Exception(Translator::get('user.error.user.not.found'));
            
        if (!password_verify($oldPassword, $user->password))
            throw new Exception(Translator::get('auth.incorrect.password'));
        
        $user->password = PasswordHelper::hash($newPassword);
        
        if (!$user->save())
            throw new Exception(Translator::get('user.error.updating.password'));
    }
    
    /**
     * Deleta o usuário
     * @param int $id
     * @return void
     * @throws Exception
     */
    public static function delete(int $id): void
    {
        SysLogger::debug()?->debug('UserService::delete');
        
        $user = User::find($id);
        
        if (empty($user))
            throw new Exception(Translator::get('user.error.user.not.found'));
        
        if ($user->status->id == Status::DELETED)
            throw new Exception(Translator::get('user.error.user.already.deleted'));
        
        $user->user_status_id = Status::DELETED;
        
        if (!$user->save())
            throw new Exception(Translator::get('user.error.deleting.user'));
    }
    
    /**
     * Bloqueia o usuário
     * @param int $id
     * @return void
     * @throws Exception
     */
    public static function block(int $id): void
    {
        SysLogger::debug()?->debug('UserService::block');
        
        $user = User::find($id);
        
        if (empty($user))
            throw new Exception(Translator::get('user.error.user.not.found'));
        
        if ($user->status->id == Status::BLOCKED)
            throw new Exception(Translator::get('user.error.user.already.blocked'));
        
        if ($user->status->id == Status::DELETED)
            throw new Exception(Translator::get('user.error.user.already.deleted'));
        
        $user->user_status_id = Status::BLOCKED;
        
        if (!$user->save())
            throw new Exception(Translator::get('user.error.blocking.user'));
    }
    
    /**
     * Ativa o usuário
     * @param int $id
     * @return void
     * @throws Exception
     */
    public static function activate(int $id): void
    {
        SysLogger::debug()?->debug('UserService::activate');
        
        $user = User::find($id);
        
        if (empty($user))
            throw new Exception(Translator::get('user.error.user.not.found'));
        
        if ($user->status->id == Status::ACTIVE)
            throw new Exception(Translator::get('user.error.user.already.activated'));
        
        $user->user_status_id = Status::ACTIVE;
        
        if (!$user->save())
            throw new Exception(Translator::get('user.error.activating.user'));
    }
}