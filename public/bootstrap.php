<?php 

require_once '../vendor/autoload.php';

use app\core\App;

$app = new App;

$app->addApp('/register','Register', 'register', [
	'css' => ['login-register']
]);

$app->render();