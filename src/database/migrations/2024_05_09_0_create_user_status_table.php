<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

Capsule::schema()->dropDatabaseIfExists('user_status');

Capsule::schema()->create('user_status', function (Blueprint $table) {
    $table->id();
    $table->string('description')->nullable(false);
});