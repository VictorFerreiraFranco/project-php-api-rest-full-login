> [< Voltar](../../../README.md)

# AuthUser

Responsável por gerenciar a autenticação e sessão do usuário dentro do sistema.

## 📌 **Uso da Classe**

A classe `AuthUser` encapsula o estado de autenticação do usuário logado, permitindo acesso ao ID do usuário, objeto `User` associado, e status de debug. Utiliza propriedades estáticas para manter o estado global durante o ciclo de vida da requisição.

## 🚀 Métodos

#### `public static function start(int $userId): void`

Inicia a sessão do usuário, atribuindo o ID, instanciando o `User` correspondente e marcando como logado.

---

#### `public static function isLogged(): bool`

Verifica se há um usuário autenticado na sessão atual.

---

#### `public static function getUserId(): ?int`

Retorna o ID do usuário autenticado, se houver.

---

#### `public static function getUser(): ?User`

Retorna a instância do modelo `User` associado ao usuário autenticado.

---

#### `public static function isDebug(): bool`

Verifica se o modo debug está ativado para o usuário atual.

---

### **Exemplo de Uso**

```php
use Api\libraries\auth\AuthUser;

AuthUser::start(12);

if (AuthUser::isLogged()) {
    $id = AuthUser::getUserId();
    $user = AuthUser::getUser();
    
    if (AuthUser::isDebug()) {
        // Executar lógica de debug...
    }
}
```