<?php

namespace Api\config;

use Api\exceptions\ReponseException;
use Api\libraries\apiResponse\messages\errors\ConnectionDeniedError;
use Api\libraries\sysLogger\SysLogger;
use Illuminate\Container\Container;
use Illuminate\Events\Dispatcher;
use Illuminate\Database\Capsule\Manager;

class Database
{
    private static Manager $manager;
    
    /**
     * Start the database connection.
     * @return void
     * @throws ReponseException
     */
    public static function initialize(): void
    {
        SysLogger::debug()?->debug('Initializing database connection');
        
        self::$manager = new Manager;
        
        self::$manager->addConnection([
            'driver' => 'mysql',
            'host' => Config::get('DB_HOST'),
            'database' => Config::get('DB_DATABASE'),
            'username' => Config::get('DB_USERNAME'),
            'password' => Config::get('DB_PASSWORD'),
            'port'      => Config::get('DB_PORT'),
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
        ]);
        
        self::$manager->setEventDispatcher(new Dispatcher(new Container));
        
        self::$manager->setAsGlobal();
        self::$manager->bootEloquent();
        
        if (Config::get('DEBUG_MODE') == 1)
            self::$manager->getConnection()->listen(function ($query) {
                SysLogger::queryLogger()->debug(
                    '[SQL] ' . $query->sql . ' [Bindings] ' . implode(', ', $query->bindings)
                );
            });
        
        self::validateConnection();
    }
    
    /**
     * Validate the database connection.
     * @return void
     * @throws ReponseException
     */
    private static function validateConnection(): void
    {
        SysLogger::debug()?->debug('Validating database connection');
        
        try {
            self::$manager->getConnection()->getPdo();

        } catch (\Throwable $t) {
           throw new ReponseException(new ConnectionDeniedError());
        }
    }
}