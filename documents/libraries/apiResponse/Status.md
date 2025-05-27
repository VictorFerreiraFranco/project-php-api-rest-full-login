> [< Voltar](../../../README.md)

# API Response Statuses

Este documento descreve os possíveis status padronizados utilizados na resposta da API para garantir consistência e clareza na comunicação.

---

## 1xx – Informativo

| Status       | Código | Descrição                                                                 |
|--------------|--------|---------------------------------------------------------------------------|
| `info`       | 100    | Mensagem informativa sem impacto direto na execução da requisição.        |
| `processing` | 102    | A requisição foi aceita e está sendo processada, mas ainda sem conclusão. |

---

## 2xx – Sucesso

| Status       | Código | Descrição                                                         |
|--------------|--------|-------------------------------------------------------------------|
| `success`    | 200    | Requisição realizada com sucesso.                                 |
| `created`    | 201    | Um novo recurso foi criado com sucesso.                           |
| `accepted`   | 202    | A requisição foi aceita, mas ainda não processada completamente.  |
| `no_content` | 204    | A requisição foi bem-sucedida, mas não há conteúdo para retornar. |

---

## 3xx – Redirecionamento

| Status              | Código | Descrição                                                       |
|---------------------|--------|-----------------------------------------------------------------|
| `moved_permanently` | 301    | O recurso solicitado foi movido permanentemente para outra URL. |
| `found`             | 302    | O recurso foi encontrado em outra URL temporariamente.          |
| `not_modified`      | 304    | O recurso não foi modificado desde a última requisição.         |

---

## 4xx – Erro do Cliente

| Status               | Código | Descrição                                                                 |
|----------------------|--------|---------------------------------------------------------------------------|
| `bad_request`        | 400    | A requisição está malformada ou contém parâmetros inválidos.              |
| `unauthorized`       | 401    | A autenticação é necessária ou falhou.                                    |
| `forbidden`          | 403    | O cliente está autenticado, mas não tem permissão para acessar o recurso. |
| `not_found`          | 404    | O recurso requisitado não foi encontrado.                                 |
| `method_not_allowed` | 405    | O método HTTP usado não é permitido para este endpoint.                   |
| `validation_error`   | 422    | Os dados enviados não passaram nas regras de validação.                   |
| `too_many_requests`  | 429    | O cliente excedeu o número de requisições permitidas.                     |

---

## 5xx – Erro do Servidor

| Status                | Código | Descrição                                                             |
|-----------------------|--------|-----------------------------------------------------------------------|
| `internal_error`      | 500    | Erro interno inesperado no servidor.                                  |
| `not_implemented`     | 501    | A funcionalidade requisitada ainda não foi implementada.              |
| `bad_gateway`         | 502    | O servidor recebeu uma resposta inválida de um servidor upstream.     |
| `service_unavailable` | 503    | O servidor está temporariamente indisponível (sobrecarga/manutenção). |

---
## Exemplo de Respostas

### Sucesso
```json
{
    "status": "success",
    "message": "Recurso criado com sucesso.",
    "data": {
        "id": 1
    }
}
```

### Erro de Validação
```json
{
    "status": "validation_error",
    "message": "Os campos obrigatórios não foram preenchidos.",
    "data": {
        "field": "email"
    }
}
```

### Aviso
```json
{
    "status": "warning",
    "message": "Senha expira em 10 dias."
}
```

## Conclusão
Este padrão de status ajuda a manter as respostas da API consistentes, facilitando a integração com outros sistemas e a manutenção do código.

