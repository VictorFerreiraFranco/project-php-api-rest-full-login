<?php

namespace Api\providers;

use Api\models\User\User;

class UserProvider
{
    /**
     * Retorna o usuário pelo Email
     * @param string $email
     * @param int|null $ignoreId
     * @return User|null
     */
    public static function findByEmail(string $email, ?int $ignoreId = null): ?User
    {
        $user = User::where('email', $email);
        
        if (!empty($ignoreId))
            $user->where('id', '!=', $ignoreId);
        
        return $user->first();
    }
    
}