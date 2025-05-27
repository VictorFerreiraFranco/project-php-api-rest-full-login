<?php

use Api\exceptions\ReponseException;
use Api\libraries\apiResponse\messages\errors\UndefinedeEnvError;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(PROJECT_ROOT);
$dotenv->load();

if (empty($_ENV))
    throw new ReponseException(new UndefinedeEnvError());

define('DB_HOST', $_ENV['DB_HOST']);
define('DB_PORT', $_ENV['DB_PORT']);
define('DB_DATABASE', $_ENV['DB_DATABASE']);
define('DB_USERNAME', $_ENV['DB_USERNAME']);
define('DB_PASSWORD', $_ENV['DB_PASSWORD']);

define('DEBUG_MODE', $_ENV['DEBUG_MODE']);
define('SHUTDOWN_MODE', $_ENV['SHUTDOWN_MODE']);

define('JWT_SECRET', $_ENV['JWT_SECRET']);
