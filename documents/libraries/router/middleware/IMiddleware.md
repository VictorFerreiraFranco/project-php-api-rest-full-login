> [< Voltar](../../../../README.md)

# IMiddleware

Interface que define o contrato para middlewares da aplicação. Todo middleware deve implementar essa interface para garantir a execução do método `run`.

## Definição

```php
interface IMiddleware
{
   public static function run();
}
```