<?php

namespace Api\libraries\request;

use Api\libraries\sysLogger\SysLogger;

class Request
{
    private static string $method;
    
    private static array $headers;
    
    private static array $body;
    
    private static string $uri;
    
    /**
     * Inicia a requisição
     * @return void
     */
    public static function initialize(): void
    {
        SysLogger::debug()?->debug('Initializing request');
        
        self::$method = $_SERVER['REQUEST_METHOD'];
        
        if (function_exists('getallheaders'))
            self::$headers = getallheaders() ?: [];
        else
            self::$headers = [];
        
        self::$body = $_REQUEST;
        
        $content = json_decode(file_get_contents('php://input'), true);
        
        if (!empty($content))
            self::$body = array_merge(self::$body, $content);
        
        self::$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        
        SysLogger::debug()?->debug('Request', self::toArray());
        
    }
    
    /**
     * Retorna o método da requisição
     * @return string
     */
    public static function getMethod(): string
    {
        return self::$method;
    }
    
    /**
     * Retorna os headers da requisição
     * @return array
     */
    public static function getHeaders(): array
    {
        return self::$headers;
    }
    
    /**
     * Retorna o corpo da requisição
     * @return array
     */
    public static function getBody(): array
    {
        return self::$body;
    }
    
    /**
     * Retorna a URI da requisição
     * @return string
     */
    public static function getUri(): string
    {
        return self::$uri;
    }
    
    /**
     * Retorna o valor de uma chave do corpo da requisição
     * @param string $key
     * @return mixed
     */
    public static function get(string $key): mixed
    {
        return self::$body[$key] ?? null;
    }
    
    /**
     * Define o valor de uma chave do corpo da requisição
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public static function set(string $key, mixed $value): void
    {
        self::$body[$key] = $value;
    }
    
    /**
     * Verifica se uma chave existe no corpo da requisição
     * @param string $key
     * @return bool
     */
    public static function has(string $key): bool
    {
        return array_key_exists($key, self::$body);
    }
    
    /**
     * Verifica se uma chave está vazia no corpo da requisição
     * @param string $key
     * @return bool
     */
    public static function empty(string $key): bool
    {
        return empty(self::$body[$key]);
    }
    
    /**
     * Retorna o valor do header Authorization
     * @return string|null
     */
    public static function getAuthorization(): ?string
    {
        return self::$headers['Authorization'] ?? null;
    }
    
    /**
     * Retorna a classe em um array
     * @return array
     */
    private static function toArray(): array
    {
        return [
            'method' => self::$method,
            'headers' => self::$headers,
            'body' => self::$body,
            'uri' => self::$uri
        ];
    }
}