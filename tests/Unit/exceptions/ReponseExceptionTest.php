<?php

use Api\exceptions\ReponseException;
use Api\libraries\apiResponse\messages\IMessages;
use Api\libraries\apiResponse\Status;

describe('ReponseExceptionTest', function () {

    it('throws ReponseException with correct message and code', function () {
    
        $messageMock = Mockery::mock(IMessages::class);
        $messageMock->shouldReceive('getMessages')->andReturn('Error occurred');
        $messageMock->shouldReceive('getStatus')->andReturn(Status::INTERNAL_ERROR);
        
        throw new ReponseException($messageMock);
    })
        ->throws(ReponseException::class, 'Error occurred', Status::INTERNAL_ERROR->getCode());
        
    
    it('returns the original IMessages object', function () {
        
        $messageMock = Mockery::mock(IMessages::class);
        $messageMock->shouldReceive('getMessages')->andReturn('Erro interno');
        $messageMock->shouldReceive('getStatus')->andReturn(Status::INTERNAL_ERROR);
        
        try {
            throw new ReponseException($messageMock);
        } catch (ReponseException $exception) {
            expect($exception->getMenssageResponse())->toBe($messageMock);
        }
    });
});