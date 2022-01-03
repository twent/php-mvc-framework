<?php

use twent\mvccore\App;

require_once __DIR__.'/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

$config = [
    'userClass' => \app\models\User::class,
    'db' => [
         'host' => $_ENV['DB_HOST'],
         'user' => $_ENV['DB_USER'],
         'password' => $_ENV['DB_PASSWORD']
    ]
];

$app = new App(__DIR__, $config);

$app->db->applyMigrations();
