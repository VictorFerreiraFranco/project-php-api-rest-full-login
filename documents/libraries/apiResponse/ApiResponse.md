> [< Voltar](../../../README.md)

# ApiResponse

A classe `ApiResponse` é responsável por padronizar e enviar respostas da API em formato JSON, incluindo status, mensagem e código HTTP.

## 📌 **Uso da Classe**
A classe `ApiResponse` é utilizada para estruturar e retornar respostas de forma consistente dentro da API.

## 🚀 **Como Utilizar**
A resposta da API é enviada utilizando o método estático `send()`, que recebe um objeto que implementa a interface `IMessages`.

### **Exemplo de Uso**

```php
use Api\libraries\apiResponse\ApiResponse;
use Api\libraries\apiResponse\messages\IMessages;

class CustomMessage implements IMessages
{
    public function __construct() { /** --- */ }

    public function getStatus(): Status { /** --- */ }

    public function getMessages(): ?string { /** --- */ }

    public function getData(): ?array { /** --- */ }

    public function log(): { /** --- */ }
}

ApiResponse::send(new CustomMessage());
```