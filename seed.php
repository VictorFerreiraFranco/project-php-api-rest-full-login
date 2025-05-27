<?php

const PROJECT_ROOT = __DIR__;
require 'vendor/autoload.php';
require 'src/config/constants.php';
require 'src/config/database.php';

foreach (glob(__DIR__ . '/src/database/seeders/*.php') as $file) {
    require $file;
}

echo "✅ Seeders executados com sucesso.\n";