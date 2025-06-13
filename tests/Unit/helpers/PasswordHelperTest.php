<?php

describe('PasswordHelper', function () {
    
    it('should hash a password', function () {
        $password = 'my_secure_password';
        
        $hashedPassword = \Api\helpers\PasswordHelper::hash($password);
        
        expect($hashedPassword)
            ->toBeString()
            ->and($hashedPassword)
            ->not->toBe($password);
    });
    
});