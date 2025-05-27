<?php

namespace Api\libraries\apiResponse\messages;

use Api\libraries\apiResponse\Status;

interface IMessages
{
    /**
     * Retorna o status da resposta
     * @return Status
     */
    public function getStatus(): Status;
    
    /**
     * Retorna a mensagem da resposta
     * @return string|null
     */
    public function getMessages(): null|string;

    /**
     * Retorna os dados da resposta
     * @return array|null
     */
    public function getData(): null|array;

    /**
     * Execução de logs
     * @return void
     */
    public function log(): void;
}