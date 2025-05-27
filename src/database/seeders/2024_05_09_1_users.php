<?php

use Api\helpers\PasswordHelper;
use Api\models\User\User;

require_once __DIR__ . '/../migrations/2024_05_09_1_create_users_table.php';

User::create([
    'name' => 'Admin',
    'email' => 'admin@gmail.com',
    'password' => PasswordHelper::hash('123'),
    'user_status_id' => 1,
    'debug' => 0
]);
