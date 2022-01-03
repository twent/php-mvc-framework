<?php

use twent\mvccore\App;
use app\controllers\{SiteController, AuthController};
use app\models\User;

require_once __DIR__.'/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->safeLoad();

$config = [
    'userClass' => User::class,
    'db' => [
         'host' => $_ENV['DB_HOST'],
         'user' => $_ENV['DB_USER'],
         'password' => $_ENV['DB_PASSWORD']
    ]
];

$app = new App(dirname(__DIR__), $config);

$app->on(App::EVENT_BEFORE_REQUEST, function(){
    echo "Before request from second installation";
});

$app->router->get('/', [SiteController::class, 'index']);

$app->router->get('/contact', [SiteController::class, 'contact']);
$app->router->post('/contact', [SiteController::class, 'contact']);

$app->router->get('/login', [AuthController::class, 'login']);
$app->router->post('/login', [AuthController::class, 'login']);
$app->router->get('/register', [AuthController::class, 'register']);
$app->router->post('/register', [AuthController::class, 'register']);
$app->router->get('/logout', [AuthController::class, 'logout']);
$app->router->get('/profile', [AuthController::class, 'profile']);

$app->run();
