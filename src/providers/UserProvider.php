<?php

namespace Api\providers;

use Api\models\User\User;

class UserProvider
{
    /**
     * Retorna o usuário pelo Email
     * @param string $email
     * @return User|null
     */
    public static function findByEmail(string $email): ?User
    {
        return User::where('email', $email)
                ->first();
    }
    
}