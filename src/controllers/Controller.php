<?php

namespace Api\controllers;

use Api\exceptions\ReponseException;
use Api\libraries\apiResponse\messages\errors\RouteMethodNotDefinedError;

abstract class Controller
{
    /**
     * Recuperar dados de uma rota
     * @throws ReponseException
     */
    public static function get()
    {
        throw new ReponseException(new RouteMethodNotDefinedError());
    }
    
    /**
     * Enviar dados para uma rota
     * @throws ReponseException
     */
    public static function post()
    {
        throw new ReponseException(new RouteMethodNotDefinedError());
    }
    
    /**
     * Atualizar dados de uma rota
     * @throws ReponseException
     */
    public static function put()
    {
        throw new ReponseException(new RouteMethodNotDefinedError());
    }
    
    /**
     * Atualizar parcialmente dados de uma rota
     * @throws ReponseException
     */
    public static function patch()
    {
        throw new ReponseException(new RouteMethodNotDefinedError());
    }
    
    /**
     * Excluir dados de uma rota
     * @throws ReponseException
     */
    public static function delete()
    {
        throw new ReponseException(new RouteMethodNotDefinedError());
    }
    
    /**
     * Método para lidar com requisições OPTIONS
     * @throws ReponseException
     */
    public static function options()
    {
        throw new ReponseException(new RouteMethodNotDefinedError());
    }
    
    /**
     * Método para lidar com requisições HEAD
     * @throws ReponseException
     */
    public static function head()
    {
        throw new ReponseException(new RouteMethodNotDefinedError());
    }
}