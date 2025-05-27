<?php

namespace Api\libraries\router\middlewares;

use Api\exceptions\ReponseException;
use Api\libraries\apiResponse\messages\errors\jwt\ExpiredTokenError;
use Api\libraries\apiResponse\messages\errors\jwt\InvalidTokenError;
use Api\libraries\apiResponse\messages\errors\jwt\TokenNotFoundError;
use Api\libraries\auth\AuthUser;
use Api\libraries\auth\JwtHandler;
use Api\libraries\request\Request;
use Api\libraries\sysLogger\SysLogger;
use Exception;
use Firebase\JWT\ExpiredException;

class AuthorizationJwt implements IMiddleware
{
    /**
     * Verifica se o token JWT está presente no cabeçalho da requisição
     * @throws ReponseException
     */
    public static function run(): void
    {
        SysLogger::debug()?->debug('Checking authorization JWT');
        
        $token = self::getToken();
        
        if (empty($token))
            throw new ReponseException(new TokenNotFoundError());
        
        try {
            $decode = JwtHandler::decodeToken($token);
            
            if (empty($decode->userId))
                throw new ReponseException(new TokenNotFoundError());
            
            AuthUser::start((int) $decode->userId);
            
        } catch (ExpiredException $e) {
            throw new ReponseException(new ExpiredTokenError());
        } catch (Exception $e) {
            throw new ReponseException(new InvalidTokenError());
        }
    }
    
    /**
     * Retorna o token JWT da requisição
     * @return array|string
     */
    private static function getToken(): array|string
    {
       return str_replace('Bearer ', '', Request::getHeaders()['Authorization'] ?? '');
    }
}