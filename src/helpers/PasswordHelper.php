<?php

namespace Api\helpers;

class PasswordHelper
{
    /**
     * Retorna a hash da senha
     * @param string $password
     * @return string
     */
    public static function hash(string $password): string
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }
}