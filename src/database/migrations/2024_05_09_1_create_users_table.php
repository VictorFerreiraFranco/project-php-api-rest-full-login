<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

Capsule::schema()->dropDatabaseIfExists('users');

Capsule::schema()->create('users', function (Blueprint $table) {
    $table->id();
    
    $table->string('name')
        ->nullable(false);
    
    $table->string('email')
        ->nullable(false)
        ->unique();
    
    $table->text('password')
        ->nullable(false);
    
    $table->unsignedBigInteger('user_status_id')
        ->nullable(false);
    
    $table->tinyInteger('debug')
        ->default(0);
    
    $table->timestamps();
    
    $table->foreign('user_status_id')->references('id')->on('user_status');
});