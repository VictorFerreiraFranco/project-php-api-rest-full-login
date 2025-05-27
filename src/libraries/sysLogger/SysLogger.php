<?php

namespace Api\libraries\sysLogger;

use Api\libraries\auth\AuthUser;
use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Monolog\Logger;

class SysLogger
{
    private static Logger $error;

    private static Logger $debug;
    
    private static Logger $userDebug;
    
    private static Logger $queryLogger;

    /**
     * Inicializa as props de logs
     * @return void
     */
    public static function initialize(): void
    {
        $date = new \DateTime();
        $today = $date->format('Y_m_d');

        self::$error = new Logger('error');
        self::$error->pushHandler(new StreamHandler(
            PROJECT_ROOT . "/logs/error_{$today}.log",
            Level::Error
        ));

        self::$debug = new Logger('debug');
        self::$debug->pushHandler(new StreamHandler(
            PROJECT_ROOT . "/logs/debug_{$today}.log",
            Level::Debug
        ));
        
        self::$userDebug = new Logger('user_debug');
        self::$userDebug->pushHandler(new StreamHandler(
            PROJECT_ROOT . "/logs/user_debug_{$today}.log",
            Level::Debug
        ));
        
        self::$queryLogger = new Logger('debug');
        self::$queryLogger->pushHandler(new StreamHandler(
            PROJECT_ROOT . "/logs/query_logger_{$today}.log",
            Level::Debug
        ));
    }

    /**
     * Retorna o prop para logs de erros do sitema
     * @return Logger
     */
    public static function error(): Logger
    {
        return self::$error;
    }
    
    /**
     * Retorna o prop para logs de debug
     * @return Logger|null
     */
    public static function debug(): ?Logger
    {
        return DEBUG_MODE == 1 ? self::$debug : null;
    }
    
    /**
     * Retorna o prop para logs de debug do usuário
     * @return Logger|null
     */
    public static function userDebug(): ?Logger
    {
        return AuthUser::isDebug() ? self::$userDebug : null;
    }
    
    /**
     * Retorna o prop para logs do sistema
     * @return Logger
     */
    public static function queryLogger(): Logger
    {
        return self::$queryLogger;
    }
}