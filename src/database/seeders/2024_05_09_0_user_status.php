<?php

use Api\models\User\Status;

require_once __DIR__ . '/../migrations/2024_05_09_0_create_user_status_table.php';

Status::create(['description' => 'Ativo']);
Status::create(['description' => 'Bloqueado']);
Status::create(['description' => 'Excluído']);
