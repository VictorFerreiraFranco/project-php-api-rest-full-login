<?php

namespace Api\libraries\router;

enum Method
{
    case GET;
    
    case POST;
    
    case PUT;
    
    case PATCH;
    
    case DELETE;
    
    case OPTIONS;
    
    case HEAD;
    
    /**
     * Retorna o método em string
     * @return string
     */
    public function get(): string
    {
        return match ($this) {
            Method::GET => 'GET',
            Method::POST => 'POST',
            Method::PUT => 'PUT',
            Method::PATCH => 'PATCH',
            Method::DELETE => 'DELETE',
            Method::OPTIONS => 'OPTIONS',
            Method::HEAD => 'HEAD'
        };
    }
}
