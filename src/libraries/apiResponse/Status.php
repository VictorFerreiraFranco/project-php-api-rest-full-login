<?php

namespace Api\libraries\apiResponse;

enum Status
{
    ## 1xx – Informativo
    case INFO;
    case PROCESSING;
    
    ## 2xx – Sucesso
    case SUCCESS;
    case CREATED;
    case ACCEPTED;
    case NO_CONTENT;
    
    ## 3xx – Redirecionamento
    case MOVED_PERMANENTLY;
    case FOUND;
    case NOT_MODIFIED;
    

    ## 4xx – Erro do cliente
    case BAD_REQUEST;
    case UNAUTHORIZED;
    case FORBIDDEN;
    case NOT_FOUND;
    case METHOD_NOT_ALLOWED;
    case VALIDATION_ERROR;
    case TOO_MANY_REQUESTS;
    
    ## 5xx – Erro do servidor
    case INTERNAL_ERROR;
    case NOT_IMPLEMENTED;
    case BAD_GATEWAY;
    case SERVICE_UNAVAILABLE;
    
    public function get(): string
    {
        return match ($this) {
            Status::INFO => 'info',
            Status::PROCESSING => 'processing',
            
            Status::SUCCESS => 'success',
            Status::CREATED => 'created',
            Status::ACCEPTED => 'accepted',
            Status::NO_CONTENT => 'no_content',
            
            Status::MOVED_PERMANENTLY => 'moved_permanently',
            Status::FOUND => 'found',
            Status::NOT_MODIFIED => 'not_modified',
            
            Status::BAD_REQUEST => 'bad_request',
            Status::VALIDATION_ERROR => 'validation_error',
            Status::UNAUTHORIZED => 'unauthorized',
            Status::FORBIDDEN => 'forbidden',
            Status::NOT_FOUND => 'not_found',
            Status::METHOD_NOT_ALLOWED => 'method_not_allowed',
            Status::TOO_MANY_REQUESTS => 'too_many_requests',
            
            Status::INTERNAL_ERROR => 'internal_error',
            Status::NOT_IMPLEMENTED => 'not_implemented',
            Status::BAD_GATEWAY => 'bad_gateway',
            Status::SERVICE_UNAVAILABLE => 'service_unavailable',
        };
    }
    
    public function getCode(): int
    {
        return match ($this) {
            Status::INFO => 100,
            Status::PROCESSING => 102,
            
            Status::SUCCESS => 200,
            Status::CREATED => 201,
            Status::ACCEPTED => 202,
            Status::NO_CONTENT => 204,
            
            Status::MOVED_PERMANENTLY => 301,
            Status::FOUND => 302,
            Status::NOT_MODIFIED => 304,
            
            Status::BAD_REQUEST => 400,
            Status::VALIDATION_ERROR => 422,
            Status::UNAUTHORIZED => 401,
            Status::FORBIDDEN => 403,
            Status::NOT_FOUND => 404,
            Status::METHOD_NOT_ALLOWED => 405,
            Status::TOO_MANY_REQUESTS => 429,
            
            Status::INTERNAL_ERROR => 500,
            Status::NOT_IMPLEMENTED => 501,
            Status::BAD_GATEWAY => 502,
            Status::SERVICE_UNAVAILABLE => 503,
        };
    }
}
