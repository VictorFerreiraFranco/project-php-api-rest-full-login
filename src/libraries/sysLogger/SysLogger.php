<?php

namespace Api\libraries\sysLogger;

use Api\libraries\auth\AuthUser;
use DateTime;
use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Monolog\Logger;

class SysLogger
{
    private static Logger $error;

    private static Logger $debug;
    
    private static Logger $userDebug;
    
    private static Logger $queryLogger;
    
    private static string $path = PROJECT_ROOT . '/logs/';

    private static DateTime $date;
    
    /**
     * Inicializa as props de logs
     * @return void
     */
    public static function initialize(): void
    {
        self::$date = new DateTime();
    }

    /**
     * Retorna o prop para logs de erros do sitema
     * @return Logger
     */
    public static function error(): Logger
    {
        if (!isset(self::$error)) {
            self::$error = new Logger('error');
            self::$error->pushHandler(new StreamHandler(
                self::$path . "error_".self::$date->format('Y-m-d').".log",
                Level::Error
            ));
        }
        
        return self::$error;
    }
    
    /**
     * Retorna o prop para logs de debug
     * @return Logger|null
     */
    public static function debug(): ?Logger
    {
        if (DEBUG_MODE == 1 && !isset(self::$debug)) {
            self::$debug = new Logger('debug');
            self::$debug->pushHandler(new StreamHandler(
                self::$path . "debug_".self::$date->format('Y-m-d').".log",
                Level::Debug
            ));
        }
        
        return DEBUG_MODE == 1 ? self::$debug : null;
    }
    
    /**
     * Retorna o prop para logs de debug do usuário
     * @return Logger|null
     */
    public static function userDebug(): ?Logger
    {
        if (AuthUser::isDebug() && !isset(self::$userDebug)) {
            self::$userDebug = new Logger('user_debug');
            self::$userDebug->pushHandler(new StreamHandler(
                self::$path . "user_debug_".self::$date->format('Y-m-d').".log",
                Level::Debug
            ));
        }
        
        return AuthUser::isDebug() ? self::$userDebug : null;
    }
    
    /**
     * Retorna o prop para logs do sistema
     * @return Logger
     */
    public static function queryLogger(): Logger
    {
        if (!isset(self::$queryLogger)) {
            self::$queryLogger = new Logger('query_logger');
            self::$queryLogger->pushHandler(new StreamHandler(
                self::$path . "query_logger_".self::$date->format('Y-m-d').".log",
                Level::Debug
            ));
        }
        
        return self::$queryLogger;
    }
}