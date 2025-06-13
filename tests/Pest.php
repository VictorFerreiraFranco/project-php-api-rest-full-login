<?php

function overrideConfig(string $key, mixed $value): void
{
    $refClass = new ReflectionClass(\Api\config\Config::class);
    $prop = $refClass->getProperty('config');
    $prop->setAccessible(true);
    
    $config = $prop->getValue();
    $config[$key] = $value;
    $prop->setValue(null, $config);
}

overrideConfig('PROJECT_ROOT', __DIR__ . '/Fixtures/');
overrideConfig('BASE_URI', rtrim(dirname($_SERVER['SCRIPT_NAME']), '/'));
overrideConfig('DB_HOST', '');
overrideConfig('DB_PORT', '');
overrideConfig('DB_DATABASE', '');
overrideConfig('DB_USERNAME', '');
overrideConfig('DB_PASSWORD', '');
overrideConfig('DEBUG_MODE', 1);
overrideConfig('SHUTDOWN_MODE', 0);
overrideConfig('DEFAULT_LANGUAGE', \Api\libraries\translator\Lang::EN_US->get());
overrideConfig('JWT_SECRET', '');
