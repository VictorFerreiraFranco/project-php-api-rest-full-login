<?php

namespace Api\libraries\auth;

use Api\libraries\sysLogger\SysLogger;
use Api\models\User\User;

class AuthUser
{
    private static bool $logged = false;
    
    private static ?int $userId = null;
    
    private static ?User $user = null;
    
    /**
     * Inicia a sessão do usuário
     * @param int $userId
     * @return void
     */
    public static function start(int $userId): void
    {
        SysLogger::debug()?->debug('starting user session', [
            'userId' => $userId,
        ]);

        self::$userId = $userId;
        self::$user = User::find($userId);
        self::$logged = true;
    }
    
    /**
     * Retorna se o usuário está logado
     * @return bool
     */
    public static function isLogged(): bool
    {
        return self::$logged;
    }
    
    /**
     * Retorna o ID do usuário logado
     * @return int|null
     */
    public static function getUserId(): ?int
    {
        return self::$userId;
    }
    
    /**
     * Retorna o usuário logado
     * @return User|null
     */
    public static function getUser(): ?User
    {
        return self::$user;
    }
    
    /**
     * Retorna se o debug está ativo
     * @return bool
     */
    public static function isDebug(): bool
    {
        if (empty(self::$user))
            return false;
        
        return self::$user->isDebug();
    }
}