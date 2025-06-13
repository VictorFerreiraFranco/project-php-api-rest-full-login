<?php

use Api\libraries\translator\Translator;

describe('Translator', function () {
    
    beforeEach(function () {
        Translator::initialize();
    });
    
    it('returns translated message with replacement', function () {
        $result = Translator::get('test.welcome');
        
        expect($result)
            ->toBe('Welcome!');
    });
    
    
    it('returns raw key if message does not exist', function () {
        $result = Translator::get('auth.unknown.key');
        
        expect($result)
            ->toBe('auth.unknown.key');
    });
    
    it('throws exception when key has no domain', function () {
        Translator::get('');
    })->throws(Exception::class);
});