<?php

const PROJECT_ROOT = __DIR__;
require 'vendor/autoload.php';
require 'src/config/constants.php';
require 'src/config/database.php';

foreach (glob(__DIR__ . '/src/database/migrations/*.php') as $file) {
    require $file;
}

echo "✅ Migrations executadas com sucesso.\n";