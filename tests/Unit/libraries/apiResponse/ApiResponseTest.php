<?php

use Api\libraries\apiResponse\ApiResponse;
use Api\libraries\apiResponse\Status;

describe('ApiResponse', function () {
   
    class CustomMessage implements \Api\libraries\apiResponse\messages\IMessages
    {
        
        public function getStatus(): Status
        {
            return Status::ACCEPTED;
        }
        
        public function getMessages(): null|string
        {
            return 'Custom message';
        }
        
        public function getData(): null|array
        {
            return [
                'key' => 'value',
                'another_key' => 'another_value'
            ];
        }
        
        public function log(): void
        {
        
        }
    }
    
    it('should send an ApiResponse with a custom message', function () {
        
        ob_start();
        ApiResponse::send(new CustomMessage());
        $response = ob_get_clean();
        
        expect(json_decode($response, true))
            ->toMatchArray([
                'status' => Status::ACCEPTED->get(),
                'code' => Status::ACCEPTED->getCode(),
                'message' => 'Custom message',
                'data' => [
                    'key' => 'value',
                    'another_key' => 'another_value'
                ]
            ]);
    });
    
    class CustomMessageEmpty implements \Api\libraries\apiResponse\messages\IMessages
    {
        
        public function getStatus(): Status
        {
            return Status::BAD_REQUEST;
        }
        
        public function getMessages(): null|string
        {
            return null;
        }
        
        public function getData(): null|array
        {
            return null;
        }
        
        public function log(): void
        {
        
        }
    }
    
    it('should send an ApiResponse without message and without data', function () {
        
        
        ob_start();
        ApiResponse::send(new CustomMessageEmpty());
        $response = json_decode( ob_get_clean(), true);
        
        expect($response)
            ->toMatchArray([
                'status' => Status::BAD_REQUEST->get(),
                'code' => Status::BAD_REQUEST->getCode(),
            ])
            ->and(isset($response['message']))
            ->toBeFalse()
            ->and(isset($response['data']))
            ->toBeFalse();
    });
    
});