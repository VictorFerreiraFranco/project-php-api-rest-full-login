<h1 align="center">🚀 API RESTful em PHP Puro</h1>

<p align="center">
  Uma API completa, segura e leve, construída com PHP puro seguindo boas práticas de arquitetura, autenticação com JWT e estrutura modular.
</p>

<p align="center">
  <img src="https://img.shields.io/badge/PHP-8.1+-blue" alt="PHP Version" />
  <img src="https://img.shields.io/badge/Status-Em%20produção-green" alt="Status" />
  <img src="https://img.shields.io/badge/Licença-MIT-yellow" alt="Licença" />
  <img src="https://img.shields.io/badge/versão-1.0.1-brown" alt="Licença" />
</p>

---

## 📁 Sumário

* [📖 Sobre o Projeto](#-sobre-o-projeto)
* [🧰 Tecnologias Utilizadas](#-tecnologias-utilizadas)
* [📦 Instalação](#-instalação)
* [📊 Configuração de Banco de Dados](#-configuração-de-banco-de-dados)
* ▶️ [Execução](#-execução)
* [📂 Estrutura de Pastas](#-estrutura-de-pastas)
* [⚖️ Como Usar](#-como-usar)
* [🧑‍💻 Autor](#-autor)

---

## 📖 Sobre o Projeto

Este projeto é uma API RESTful desenvolvida com foco em simplicidade, organização e escalabilidade. Utiliza apenas PHP nativo com bibliotecas instaladas via Composer, sem frameworks.

> ✨ Ideal para estudos, provas de conceito ou aplicações reais de pequeno e médio porte.

---

## 🧰 Tecnologias Utilizadas

* PHP 8.1+
* Composer
* Eloquent ORM
* JWT para autenticação
* MySQL
* PSR-4 Autoloading

---

## 📦 Instalação

###### Clone o repositório
```bash
git clone https://github.com/VictorFerreiraFranco/project-php-api-rest-full-login.git
```

###### Acesse o diretório
```bash
cd 'project-php-api-rest-full-login'
```

###### Instale as dependências
```bash
composer install
```


---

## 📊 Configuração de Banco de Dados

Configure o arquivo `.env` com base no `.env.exemplo`:

```dotenv
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=meu_banco
DB_USERNAME=root
DB_PASSWORD=minha_senha

DEBUG_MODE=0
SHUTDOWN_MODE=0
JWT_SECRET=meu_segredo
```

Na pasta do projeto, execute o comando para criar as migrates
```bash
php seed.php
```

---

## ▶️ Execução

```bash
php -S localhost:8000 -t .\
```

---

## 📂 Estrutura de Pastas

```text
- documents/
- logs/
- src/
  - config/
  - controllers/
  - database/
  - exceptions/
  - helpers/
  - libraries/
  - models/
  - providers/
  - routes/
  - services/
- index.php
```

---

## ⚖ Como Usar

### 1. Rotas

Local: `src/routes/routes.php`

```php
Router::map(Method::GET, '/home', function () {
    // ...
});

Router::map(Method::POST, '/login', AuthController::class, 'login', [AuthorizationJwt::class]);
```

> Veja [Router.md](documents/libraries/router/Router.md) e [Method.md](documents/libraries/router/Method.md)

---

### 2. Middlewares

Local: `src/libraries/router/middlewares`

Crie um middleware implementando a interface `IMiddleware`:

```php
namespace Api\libraries\router\middlewares;

class AuthorizationJwt implements IMiddleware
{
    public static function run(): void
    {
        // ...
    }
}
```

Registre-o na `index.php` como middleware global:

```php
Router::setMiddleware([
    AuthorizationJwt::class
]);
```

> Veja [IMiddleware.md](documents/libraries/router/middleware/IMiddleware.md)

---

### 3. Request

Utilize a classe `Request` para acessar facilmente dados da requisição.

> Veja [Request.md](documents/libraries/request/Request.md)

---

### 4. Auth

Utilize a classe `AuthUser` para obter dados do usuário autenticado.

> Veja [AuthUser.md](documents/libraries/auth/AuthUser.md)

---

### 5. Resposta da API

Para retornar respostas padronizadas, utilize a exceção `ResponseException` com uma mensagem:

```php
throw new ResponseException(new SendSuccess('Login realizado com sucesso!'));
```

Exemplo de mensagem personalizada:

```php
class SendSuccess implements IMessages
{    
    public function __construct() {}

    public function getStatus(): Status { /* ... */ }
    public function getMessages(): null|string { /* ... */ }
    public function getData(): null|array { /* ... */ }
    public function log(): void { /* ... */ }
}
```

> Veja [ApiResponse.md](documents/libraries/apiResponse/ApiResponse.md) e [Status.md](documents/libraries/apiResponse/Status.md)

---

### 6. Models

Armazene modelos Eloquent na pasta `src/models`

---

### 7. Controllers

Local onde são tratadas as requisições. Delegam para os serviços correspondentes.
<br><br>Pasta: `src/controllers`

---

### 8. Services

Organiza as classes que contêm as regras de negócio e lógicas específicas. Separadas por modelo.
<br><br>Pasta: `src/services`

---

### 9. Providers

Armazena classes auxiliares que provêm dados filtrados ou lógicas de apoio recorrentes.
<br><br>Pasta: `src/providers`

---

### 10. Logger

Centralize e gerenciar os logs do sistema utilizando a biblioteca **Monolog**. Através da classe `SysLogger`
> Veja [SysLogger.md](documents/libraries/sysLogger/sysLogger.md)

---

## 🧑‍💻 Autor

**Victor Ferreira Franco**
Desenvolvedor PHP
2025

`Copyright (c) 2025 Victor Ferreira Franco
`
