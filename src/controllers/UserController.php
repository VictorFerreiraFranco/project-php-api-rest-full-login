<?php

namespace Api\controllers;

use Api\exceptions\ReponseException;
use Api\libraries\apiResponse\messages\NotExistParameters;
use Api\libraries\apiResponse\messages\OperationError;
use Api\libraries\apiResponse\messages\SendSuccess;
use Api\libraries\auth\AuthUser;
use Api\libraries\request\Request;
use Api\libraries\sysLogger\SysLogger;
use Api\libraries\translator\Translator;
use Api\services\UserService;
use Exception;

class UserController extends Controller
{
    /**
     * Cria um novo usuário.
     *
     * Esperados os seguintes parâmetros no corpo da requisição:
     * - name (string, obrigatório): Nome do usuário.
     * - email (string, obrigatório): E-mail do usuário.
     * - password (string, obrigatório): Senha do usuário.
     *
     * @return void
     * @throws ReponseException
     */
    public static function post(): void
    {
        SysLogger::debug()?->debug('UserController::post');
        
        if (Request::empty('name'))
            throw new ReponseException(new NotExistParameters(Translator::get('parameter.name')));
        
        if (Request::empty('email'))
            throw new ReponseException(new NotExistParameters(Translator::get('parameter.email')));
        
        if (Request::empty('password'))
            throw new ReponseException(new NotExistParameters(Translator::get('parameter.password')));
        
        try {
            UserService::include(
                (string) Request::get('name'),
                (string) Request::get('email'),
                (string) Request::get('password')
            );
        } catch (Exception $e) {
            throw new ReponseException(new OperationError($e->getMessage(), $e));
        } catch (\Throwable $t) {
            throw new ReponseException(new OperationError(Translator::get('user.error.creating.user'), $t));
        }
        
        throw new ReponseException(new SendSuccess(Translator::get('user.created.successfully')));
    }
    
    /**
     * Altera os dados do usuário autenticado.
     *
     * Esperados os seguintes parâmetros no corpo da requisição:
     * - name (string, obrigatório): Nome do usuário.
     * - email (string, obrigatório): E-mail do usuário.
     * @return void
     * @throws ReponseException
     * @throws Exception
     */
    public static function put(): void
    {
        SysLogger::debug()?->debug('UserController::put');
        
        if (Request::empty('name'))
            throw new ReponseException(new NotExistParameters(Translator::get('parameter.name')));
        
        if (Request::empty('email'))
            throw new ReponseException(new NotExistParameters(Translator::get('parameter.email')));
        
        try {
            UserService::update(
                AuthUser::getUserId(),
                (string) Request::get('name'),
                (string) Request::get('email'),
            );
        } catch (Exception $e) {
            throw new ReponseException(new OperationError($e->getMessage(), $e));
        } catch (\Throwable $t) {
            throw new ReponseException(new OperationError(Translator::get('user.error.updating.user'), $t));
        }
        
        throw new ReponseException(new SendSuccess(Translator::get('user.updated.successfully')));
    }
    
    /**
     * Altera a senha do usuário
     *
     * Espera os seguintes parâmetros no corpo da requisição:
     * - old_password (string, obrigatório): Senha atual do usuário.
     * - new_password (string, obrigatório): Nova senha do usuário.
     * @return void
     * @throws ReponseException
     * @throws Exception
     */
    public static function patch(): void
    {
        SysLogger::debug()?->debug('UserController::patch');
        
        if (Request::empty('old_password'))
            throw new ReponseException(new NotExistParameters(Translator::get('parameter.old_password')));
        
        if (Request::empty('new_password'))
            throw new ReponseException(new NotExistParameters(Translator::get('parameter.new_password')));
        
        try {
            UserService::updatePassword(
                AuthUser::getUserId(),
                (string) Request::get('old_password'),
                (string) Request::get('new_password')
            );
        } catch (Exception $e) {
            throw new ReponseException(new OperationError($e->getMessage(), $e));
        } catch (\Throwable $t) {
            throw new ReponseException(new OperationError(Translator::get('user.error.updating.password'), $t));
        }
        
        throw new ReponseException(new SendSuccess(Translator::get('user.password.updated.successfully')));
    }
    
    /**
     * Deleta o usuário autenticado.
     * @return void
     * @throws ReponseException
     * @throws Exception
     */
    public static function delete(): void
    {
        SysLogger::debug()?->debug('UserController::delete');
        
        try {
            UserService::delete((int) Request::get('id'));
        } catch (Exception $e) {
            throw new ReponseException(new OperationError($e->getMessage(), $e));
        } catch (\Throwable $t) {
            throw new ReponseException(new OperationError(Translator::get('user.error.deleting.user'), $t));
        }
        
        throw new ReponseException(new SendSuccess(Translator::get('user.deleted.successfully')));
    }
    
    /**
     * Bloqueia o usuário autenticado.
     * @return void
     * @throws ReponseException
     * @throws Exception
     */
    public static function block(): void
    {
        SysLogger::debug()?->debug('UserController::block');
        
        try {
            UserService::block((int) Request::get('id'));
        } catch (Exception $e) {
            throw new ReponseException(new OperationError($e->getMessage(), $e));
        } catch (\Throwable $t) {
            throw new ReponseException(new OperationError(Translator::get('user.error.blocking.user'), $t));
        }
        
        throw new ReponseException(new SendSuccess(Translator::get('user.blocked.successfully')));
    }
    
    /**
     * Ativa o usuário autenticado.
     * @return void
     * @throws ReponseException
     * @throws Exception
     */
    public static function activate(): void
    {
        SysLogger::debug()?->debug('UserController::activate');
        
        try {
            UserService::activate((int) Request::get('id'));
        } catch (Exception $e) {
            throw new ReponseException(new OperationError($e->getMessage(), $e));
        } catch (\Throwable $t) {
            throw new ReponseException(new OperationError(Translator::get('user.error.activating.user'), $t));
        }
        
        throw new ReponseException(new SendSuccess(Translator::get('user.activated.successfully')));
    }
}