<?php

namespace Api\libraries\router;

use Api\exceptions\ReponseException;
use Api\libraries\apiResponse\messages\errors\NotFoundError;
use Api\libraries\auth\AuthUser;
use Api\libraries\request\Request;
use Api\libraries\router\middlewares\IMiddleware;
use Api\libraries\sysLogger\SysLogger;
use Api\libraries\translator\Lang;
use Api\libraries\translator\Translator;

class Router
{
    /**
     * @var array
     */
    private static array $routes = [];
    
    /**
     * @var array<IMiddleware>
     */
    private static array $middlewares = [];
    
    /**
     * Define o middleware padrão para todas as rotas
     * @param array $middlewares
     * @return void
     */
    public static function setMiddleware(array $middlewares): void {
        self::$middlewares = $middlewares;
    }
    
    /**
     * Adiciona uma rota ao roteador
     * @param Method $method
     * @param string $path
     * @param string|callable $controller
     * @param string|null $action
     * @param array $ignoreMiddleware
     * @return void
     */
    public static function map(
        Method $method,
        string $path,
        string|callable $controller,
        ?string $action = null,
        array $ignoreMiddleware = []
    ): void {
        
        self::$routes[] = [
            'method' => $method->get(),
            'regex' => self::getRegex($path),
            'controller' => $controller,
            'action' => $action,
            'ignoreMiddleware' => $ignoreMiddleware
        ];
    }
    
    /**
     * Roteamento para o controlador
     * @return void
     * @throws ReponseException
     */
    public static function dispatch(): void {
        
        $uri = '/' . ltrim(str_replace(BASE_URI, '', Request::getUri()), '/');
        
        foreach (self::$routes as $route) {
            
            if ($route['method'] === Request::getMethod() && preg_match($route['regex'], $uri, $matches))
            {
                $middlewares = array_filter(self::$middlewares, fn($mw) => !in_array($mw, $route['ignoreMiddleware'] ?? []));
                
                foreach ($middlewares as $middleware)
                    $middleware::run();
                
                SysLogger::userDebug()?->debug('Starting', [
                    'id' => AuthUser::getUser()?->id,
                    'name' => AuthUser::getUser()?->name,
                    'email' => AuthUser::getUser()?->email,
                    'path' => $uri,
                ]);
                
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                
                foreach ($params as $key => $value)
                    Request::set($key, $value);
                
                if (!Request::empty('lang'))
                    Translator::initialize(Lang::fromString(Request::get('lang')));
                
                if (is_callable($route['controller']))
                    call_user_func($route['controller']);
                else
                {
                    $action = !empty($route['action']) ? $route['action'] : strtolower(Request::getMethod());
                    call_user_func([new $route['controller'], $action]);
                }
                
                return;
            }
        }
        
        throw new ReponseException(new NotFoundError());
    }
    
    /**
     * Retorna o regex da rota
     * @param string $path
     * @return string
     */
    private static function getRegex(string $path): string
    {
        $pattern = preg_replace_callback('/\[([a-z\*]{0,2}):(\w+)\]/', function ($matches) {
            $type = $matches[1];
            $name = $matches[2];
            return match($type) {
                'i' => '(?P<' . $name . '>\d+)',
                'a' => '(?P<' . $name . '>[a-zA-Z0-9_-]+)',
                'h' => '(?P<' . $name . '>[a-fA-F0-9]+)',
                '**' => '(?P<' . $name . '>.+)',
                default => '(?P<' . $name . '>[^/]+)'
            };
        }, $path);
        
        return '#^' . $pattern . '$#';
    }
}