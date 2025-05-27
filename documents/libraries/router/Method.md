> [< Voltar](../../../README.md)

## Enum `Method`

O enum `Method` representa os métodos HTTP suportados pelo roteador.

### Valores

* `GET`
* `POST`
* `PUT`
* `PATCH`
* `DELETE`
* `OPTIONS`
* `HEAD`

### Método

#### `get(): string`

Retorna o nome do método HTTP como string (ex: `"GET"`).

---

# Métodos HTTP

Abaixo estão descrições dos principais métodos HTTP usados em APIs RESTful.

## GET

- **Objetivo**: Recuperar dados do servidor.
- **Comportamento**: Não altera o estado do recurso.
- **Exemplo de uso**: Buscar uma lista de usuários ou os detalhes de um usuário específico.
- **Idempotente**: Sim (chamadas repetidas retornam o mesmo resultado).

## POST

- **Objetivo**: Criar um novo recurso no servidor.
- **Comportamento**: Altera o estado do servidor, geralmente criando dados.
- **Exemplo de uso**: Criar um novo usuário.
- **Idempotente**: Não (chamadas repetidas criam múltiplos recursos).

## PUT

- **Objetivo**: Atualizar completamente um recurso existente.
- **Comportamento**: Substitui o recurso atual pelos dados enviados.
- **Exemplo de uso**: Atualizar todos os dados de um usuário.
- **Idempotente**: Sim (o mesmo corpo enviado repetidamente terá o mesmo efeito).

## PATCH

- **Objetivo**: Atualizar parcialmente um recurso existente.
- **Comportamento**: Apenas os campos enviados são atualizados.
- **Exemplo de uso**: Atualizar somente o e-mail de um usuário.
- **Idempotente**: Sim (em geral, mas depende da implementação).

## DELETE

- **Objetivo**: Remover um recurso do servidor.
- **Comportamento**: Apaga o recurso identificado pela URL.
- **Exemplo de uso**: Deletar um usuário.
- **Idempotente**: Sim (repetir a exclusão não terá efeito adicional).

## OPTIONS

- **Objetivo**: Descobrir quais métodos HTTP são suportados por um endpoint.
- **Comportamento**: Retorna os métodos permitidos em um cabeçalho `Allow`.
- **Exemplo de uso**: Usado em requisições CORS para verificar permissões.
- **Idempotente**: Sim.

## HEAD

- **Objetivo**: Igual ao `GET`, mas sem retornar o corpo da resposta.
- **Comportamento**: Utilizado para obter metadados ou verificar existência.
- **Exemplo de uso**: Verificar se um recurso existe antes de baixar.
- **Idempotente**: Sim.
