<?php

use Api\libraries\auth\AuthUser;
use Api\libraries\sysLogger\SysLogger;
use Monolog\Logger;

describe('SysLogger', function () {
    
    beforeEach(function () {
        SysLogger::initialize();
        
        Mockery::mock('alias:' . AuthUser::class)
            ->shouldReceive('isDebug')
            ->andReturn(true);
    });
    
    it('should return an error Logger instance', function () {
        $logger = SysLogger::error();
        
        expect($logger)
            ->toBeInstanceOf(Logger::class)
            ->and($logger->getName())
            ->toBe('error');
    });
    
    it('should return a debug Logger instance if DEBUG_MODE is enabled', function () {
        $logger = SysLogger::debug();
        
        expect($logger)
            ->not->toBeNull()
            ->and($logger)
            ->toBeInstanceOf(Logger::class)
            ->and($logger->getName())
            ->toBe('debug');
    });
    
    it('should return null for debug Logger instance if DEBUG_MODE is disabled', function () {
        overrideConfig('DEBUG_MODE', 0);
        
        $logger = SysLogger::debug();
        
        expect($logger)->toBeNull();
    });
    
    it('should return a user debug Logger instance if AuthUser allows debug', function () {
        $logger = SysLogger::userDebug();
        
        expect($logger)
            ->not->toBeNull()
            ->and($logger)
            ->toBeInstanceOf(Logger::class)
            ->and($logger->getName())
            ->toBe('user_debug');
    });
    
    it('should return a query Logger instance', function () {
        $logger = SysLogger::queryLogger();
        
        expect($logger)
            ->toBeInstanceOf(Logger::class)
            ->and($logger->getName())
            ->toBe('query_logger');
    });
});
