> [< Voltar](../../../README.md)


# SysLogger

Centraliza todos os loggers em um lugar só.

## 📌 **Uso da Classe**

A classe `SysLogger` é responsável por centralizar e gerenciar os logs do sistema utilizando a biblioteca **Monolog**. Ela organiza os logs em arquivos separados e diários com diferentes propósitos, facilitando a manutenção e a análise de eventos.

---

## 🚀 Métodos

#### `public static function initialize(): void`

Inicializa todos os loggers e configura os arquivos de saída com base na data atual. Os arquivos de log são salvos no diretório `/logs`.

---

#### `public static function error(): Logger`
Retorna o logger responsável por registrar mensagens de erro e exceções críticas do sistema. Essas mensagens são úteis para identificar falhas que precisam de atenção imediata, como falhas de conexão com o banco de dados, erros de lógica ou falhas inesperadas.

---

#### `public static function debug(): ?Logger`
Retorna o logger utilizado para registrar informações de depuração durante o desenvolvimento e testes. Esse logger é ideal para rastrear o fluxo da aplicação e diagnosticar comportamentos inesperados. Pode retornar null caso o modo de depuração não esteja habilitado.

---

#### `public static function userDebug(): ?Logger`
Retorna um logger dedicado a registrar ações ou eventos relacionados a usuários específicos, como tentativas de login, alterações em dados de perfil, entre outros. É útil para rastrear a interação do usuário com o sistema de forma isolada. Também pode retornar null se estiver desabilitado por configuração.

---

#### `public static function queryLogger(): Logger`
Retorna o logger utilizado especificamente para registrar queries SQL executadas pela aplicação. Serve para monitorar o desempenho de consultas ao banco de dados e facilitar a análise de problemas relacionados a acesso ou lentidão em operações com dados.

---

### **Exemplo de Uso**

```php
SysLogger::initialize();

SysLogger::debug()->debug('...')
```