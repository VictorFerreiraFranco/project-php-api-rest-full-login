<?php

use Api\libraries\request\Request;
use Api\libraries\sysLogger\SysLogger;

describe('Request', function () {
    
    beforeEach(function () {
        $_SERVER = [];
        $_REQUEST = [];
        
        SysLogger::initialize();
    });
    
    it('correctly initializes the request data', function () {
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_SERVER['REQUEST_URI'] = '/api/test';
        $_REQUEST = ['foo' => 'bar'];
        
        Request::initialize();
        
        expect(Request::getMethod())->toBe('POST')
            ->and(Request::getUri())->toBe('/api/test')
            ->and(Request::getBody())->toBe(['foo' => 'bar']);
    });
    
    it('manipulate body data with get, set, has, empty', function () {
        Request::set('x', 123);
        
        expect(Request::get('x'))->toBe(123)
            ->and(Request::has('x'))->toBeTrue()
            ->and(Request::empty('x'))->toBeFalse();
        
        Request::set('emptyField', '');
        
        expect(Request::empty('emptyField'))->toBeTrue();
    });
    
});