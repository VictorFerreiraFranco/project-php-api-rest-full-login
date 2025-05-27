> [< Voltar](../../../README.md)

# Router

Responsável por gerenciar/mapeando todas as rotas da aplicação.

## 📌 **Uso da Classe**

A classe `Router` é responsável por gerenciar as rotas da aplicação, mapeando requisições HTTP para controladores ou funções específicas, com suporte a middlewares globais e específicos por rota.

### Métodos

## 🚀 Métodos

#### `public static function setMiddleware(): void`

Define um array de middlewares que serão aplicados a todas as rotas, exceto aquelas que explicitamente os ignorarem.

---

#### `public static function map(Method $method, string $path, IController|callable $controller, ?string $action = null, array $ignoreMiddleware = []): void`

Adiciona uma nova rota ao sistema de roteamento.

**Parâmetros:**

* `Method $method`: Método HTTP da rota.
* `string $path`: Caminho da URI (com suporte a parâmetros como `[i:id]`, `[a:slug]`, etc).
* `string|callable $controller`: Controlador ou função a ser executada.
* `?string $action`: Método do controlador (caso seja uma instância de `IController`).
* `array<IMiddleware> $ignoreMiddleware`: Lista de middlewares que devem ser ignorados nessa rota.

---

#### `public static function dispatch(): void`
       
 Executa o roteamento com base na URI e método da requisição atual, aplicando os middlewares e chamando o controlador correspondente.

---

### **Exemplo de Uso**

```php
Router::setMiddleware([
    AuthorizationJwt::class
]);

Router::map(Method::GET, '/me', AuthController::class, 'me');

Router::dispatch();
```

O Router suporta o uso de parâmetros na URI, permitindo capturar valores dinâmicos. Os parâmetros podem ser definidos com os seguintes formatos:

* `[i:id]` para números inteiros
* `[a:slug]` para strings alfanuméricas com hífens
* `[h:hash]` para hashes hexadecimais
* `[*:var]` para qualquer valor até a próxima barra
* `[**:var]` para capturar o restante da URI
