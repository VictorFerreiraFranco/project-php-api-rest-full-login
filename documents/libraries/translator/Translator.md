> [< Voltar](../../../README.md)


# Translator

Todo o texto centralizado, permitindo a tradução de mensagens, e ampliação facil para varios idiomas.

## 📌 **Uso da Classe**

A classe `Translator` é responsável por gerenciar a tradução de mensagens dentro do sistema. Ela permite que as mensagens sejam facilmente traduzidas para diferentes idiomas, facilitando a internacionalização da aplicação.

---

## 🚀 Métodos

#### `public static function initialize(Lang $lang = Lang::EN_US): void`

Inicializa o tradutor com o idioma padrão. Este método deve ser chamado antes de qualquer outra operação de tradução para garantir que as mensagens sejam carregadas corretamente.

---

#### `public static function get(string $key, array $replacements = []): string`

Retorna a mensagem traduzida correspondente à chave fornecida. Se a chave não for encontrada, retorna a própria chave. Permite substituições de variáveis na mensagem através do array `$replacements`.

---

### **Exemplo de Uso**

Na pasta `src/lang`, você pode criar varia pastas repesentado os idiomas, como `en`, `pt` etc. Dentro de cada pasta, você pode criar arquivos PHP que retornam um array associativo com as chaves e suas respectivas traduções. O nome do arquivo vai ser considerado o dominio dele.

Exemplo de um arquivo `src/lang/en/messages.php`:

```php
<?php

return [
    'messages.welcome' => 'Welcome to our application!',
    'messages.goodbye' => 'Goodbye, see you soon!',
];
```

O `messages` é o nome do arquivo e o dominio.

Exemplo de uso da classe `Translator`:

```php
use App\Libraries\Translator\Translator;

Translator::initialize(Lang::EN_US);

echo Translator::get('messages.welcome'); // Saída: Welcome to our application!

echo Translator::get('messages.goodbye'); // Saída: Goodbye, see you soon!

echo Translator::get('messages.non_existent_key'); // Saída: messages.non_existent_key
```