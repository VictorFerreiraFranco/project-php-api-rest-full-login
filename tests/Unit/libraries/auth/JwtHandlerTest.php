<?php

use Api\libraries\auth\JwtHandler;

describe('JwtHandler', function () {
    
    beforeEach(function () {
       overrideConfig('JWT_SECRET', 'secret123');
    });
    
    it('should generate and decode a valid JWT token', function () {
        $userId = 42;
        $token = JwtHandler::generateToken($userId);
        
        expect($token)->toBeString();
        
        $decoded = JwtHandler::decodeToken($token);
        
        expect($decoded)->toBeInstanceOf(stdClass::class)
            ->and($decoded->userId)->toBe($userId)
            ->and($decoded->iat)->toBeInt()
            ->and($decoded->exp)->toBeGreaterThan($decoded->iat);
    });
    
    it('should throw an exception for invalid JWT token', function () {
        
        JwtHandler::decodeToken('eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VySWQiOjQyfQ.invalidsignature');
        
    })->throws(Exception::class);
    
    
    it('should return the correct secret key using private method', function () {
        $reflection = new ReflectionClass(JwtHandler::class);
        $method = $reflection->getMethod('getSecretKey');
        $method->setAccessible(true);
        
        $result = $method->invoke(null);
        
        expect($result)->toBe(\Api\config\Config::get('JWT_SECRET'));
    });
});