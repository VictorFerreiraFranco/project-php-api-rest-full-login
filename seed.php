<?php

use Api\config\Config;
use Api\config\Database;

require __DIR__. '/vendor/autoload.php';

Config::initialize(__DIR__);

Database::initialize();

foreach (glob(Config::get('PROJECT_ROOT') . '/src/database/seeders/*.php') as $file) {
    require $file;
}

echo "✅ Seeders executados com sucesso.\n";