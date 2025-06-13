<?php

namespace Api\libraries\translator;

use Api\config\Config;
use Api\libraries\sysLogger\SysLogger;
use Exception;

class Translator
{
    protected static Lang $lang = Lang::EN_US;
    
    protected static array $loadedDomains = [];
    
    protected static array $messages = [];
    
    /**
     * @param Lang $lang
     */
    public static function initialize(Lang $lang = Lang::EN_US): void
    {
        self::$lang = $lang;
    }
    
    /**
     * Loads the specified language domain messages.
     * @param string $domain
     * @return void
     */
    private static function loadDomain(string $domain): void
    {
        if (isset(self::$loadedDomains[$domain]))
            return;
        
        $path = Config::get('PROJECT_ROOT') . "/src/langs/". self::$lang->get() ."/{$domain}.php";
        
        if (file_exists($path)) {
            self::$messages[$domain] = include $path;
        } else {
            self::$messages[$domain] = [];
        }
        
        self::$loadedDomains[$domain] = true;
    }
    
    /**
     * @param string $key
     * @param array $replacements
     * @return string
     * @throws Exception
     * @example get('auth.login.success', ['username' => 'JohnDoe'])
     */
    public static function get(string $key, array $replacements = []): string
    {
        $domain = explode('.', $key)[0];
        
        if (empty($domain))
            throw new Exception('Domain not specified in the key.');
        
        self::loadDomain($domain);
        
        $message = self::$messages[$domain][$key] ?? $key;
        
        foreach ($replacements as $k => $v)
            $message = str_replace(":$k", $v, $message);
        
        return $message;
    }
}