> [< Voltar](../../../README.md)

# Classe Request

Responsável por encapsular e fornecer acesso aos dados da requisição HTTP atual.

## 📌 **Uso da Classe**

A classe `Request` centraliza o tratamento da requisição HTTP, permitindo acesso ao método, URI, headers e corpo da requisição. Deve ser inicializada manualmente com o método `initialize()`.

## 🚀 Métodos

#### `public static function initialize(): void`

Inicializa a requisição capturando os método HTTP, Headers, Corpo `$_REQUEST` e URI

---

#### `public static function getMethod(): string`

Retorna o método HTTP da requisição (`GET`, `POST`, etc).

---

#### `public static function getHeaders(): array`

Retorna os headers HTTP da requisição.

---

#### `public static function getBody(): array`

Retorna o corpo da requisição (dados enviados por GET, POST etc.).

---

#### `public static function getUri(): string`

Retorna apenas a URI da requisição (sem domínio ou query string).

---

#### `public static function get(string $key): mixed`

Retorna o valor de uma chave específica do corpo da requisição. Retorna `null` se a chave não existir.

---

#### `public static function set(string $key, mixed $value): void`

Define ou sobrescreve o valor de uma chave no corpo da requisição.

---

#### `public static function has(string $key): bool`

Verifica se uma chave existe no corpo da requisição.

---

#### `public static function empty(string $key): bool`

Verifica se uma chave está vazia (não setada ou valor falsy).

---

#### `public static function getAuthorization(): ?string`

Retorna o valor do header `Authorization`, se presente. Caso contrário, retorna `null`.

---

#### `private static function toArray(): array`

Retorna todos os dados da requisição como array associativo:
```php
[
'method' => ...,
'headers' => ...,
'body' => ...,
'uri' => ...
]
```

---

### **Exemplo de Uso**

```php
Request::initialize();

$headers = Request::getHeaders();

$userId = Request::get('user_id');

if (Request::has('email'))
    $email = Request::get('email');
    
Request::set('name', 'Usuário')    
```