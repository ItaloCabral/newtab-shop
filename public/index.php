<?php

require __DIR__ .'/../vendor/autoload.php';

use App\Core\Application;

$app = new Application();

$app->router->get('/', function() {
    return 'Hello World!';
});

$app->router->get('/users', 'users');

$app->run();
