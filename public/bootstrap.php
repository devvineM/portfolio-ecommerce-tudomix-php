<?php 

require_once '../vendor/autoload.php';

use app\routers\App;

$router = new App();

$router->get('/', 'home', [
    'css' => ['home']
]);

$router->get('/register', 'register', [
    'css' => ['login-register']
]);

$router->get('/login', 'login', [
    'css' => ['login-register']
]);

$router->get('/user-profile', 'user', [
    'css' => ['user']
]);

$router->init();

if(isset($router->route->options->controller)){;
    $controllerName = $router->route->options->controller; 
    $app = new ("app\\controllers\\" . $controllerName);
}

require_once '../app/views/layouts/html.phtml';
