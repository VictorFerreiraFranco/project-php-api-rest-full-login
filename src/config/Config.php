<?php

namespace Api\config;

use Api\exceptions\ReponseException;
use Api\libraries\apiResponse\messages\errors\UndefinedeEnvError;
use Dotenv\Dotenv;

class Config
{
    private static array $config = [];
    
    /**
     * Inicializa as constantes do sistema a partir do arquivo .env
     *
     * @param string $dirRoot
     * @return void
     * @throws ReponseException
     */
    public static function initialize(string $dirRoot): void
    {
        $dotenv = Dotenv::createImmutable($dirRoot);
        $dotenv->load();
        
        if (empty($_ENV))
            throw new ReponseException(new UndefinedeEnvError());
        
        self::$config = [
            'PROJECT_ROOT'     => $dirRoot,
            'BASE_URI'         => rtrim(dirname($_SERVER['SCRIPT_NAME']), '/'),
            'DB_HOST'          => $_ENV['DB_HOST'] ?? '',
            'DB_PORT'          => $_ENV['DB_PORT'] ?? '',
            'DB_DATABASE'      => $_ENV['DB_DATABASE'] ?? '',
            'DB_USERNAME'      => $_ENV['DB_USERNAME'] ?? '',
            'DB_PASSWORD'      => $_ENV['DB_PASSWORD'] ?? '',
            'DEBUG_MODE'       => $_ENV['DEBUG_MODE'] ?? '',
            'SHUTDOWN_MODE'    => $_ENV['SHUTDOWN_MODE'] ?? '',
            'DEFAULT_LANGUAGE' => $_ENV['DEFAULT_LANGUAGE'] ?? '',
            'JWT_SECRET'       => $_ENV['JWT_SECRET'] ?? '',
        ];
    }
    
    /**
     * Retorna uma configuração carregada da aplicação.
     *
     * Chaves disponíveis:
     * - 'PROJECT_ROOT' (string)
     * - 'BASE_URI' (string)
     * - 'DB_HOST' (string)
     * - 'DB_PORT' (string|int)
     * - 'DB_DATABASE' (string)
     * - 'DB_USERNAME' (string)
     * - 'DB_PASSWORD' (string)
     * - 'DEBUG_MODE' (bool|string|'0'|'1')
     * - 'SHUTDOWN_MODE' (bool|string|'0'|'1')
     * - 'DEFAULT_LANGUAGE' (string)
     * - 'JWT_SECRET' (string)
     *
     * @param string $key A chave da configuração.
     * @return mixed|null O valor da configuração ou null se não existir.
     */
    public static function get(string $key): mixed
    {
        return self::$config[$key] ?? null;
    }
    
}