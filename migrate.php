<?php

use Api\config\Config;
use Api\config\Database;

require __DIR__. '/vendor/autoload.php';

Config::initialize(__DIR__);

Database::initialize();

foreach (glob(Config::get('PROJECT_ROOT') . '/src/database/migrations/*.php') as $file) {
    require $file;
}

echo "✅ Migrations executadas com sucesso.\n";