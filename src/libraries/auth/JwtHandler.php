<?php

namespace Api\libraries\auth;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use stdClass;

class JwtHandler
{
    private static string $algorithm = 'HS256';
    
    private static int $expirationTime = 3600; // 1 hour
    
    /**
     * Gera um token JWT
     * @param int $userId
     * @return string
     */
    public static function generateToken(int $userId): string
    {
        $issuedAt = time();
        
        $payload = [
            'userId' => $userId,
            'iat' => $issuedAt,
            'exp' => $issuedAt + self::$expirationTime,
        ];
        
        return JWT::encode($payload, self::getSecretKey(), self::$algorithm);
    }
    
    /**
     * Decodifica um token JWT
     * @param string $token
     * @return stdClass
     */
    public static function decodeToken(string $token): stdClass
    {
        return JWT::decode($token, new Key(self::getSecretKey(), self::$algorithm));
    }
    
    /**
     * Retorna o segredo para codificação e decodificação do token
     * @return string
     */
    private static function getSecretKey(): string
    {
        return JWT_SECRET;
    }
}