<?php
namespace App;
use App\Controllers\LoginController;
use App\Controllers\RegisterController;
use App\Controllers\TaskController;

$router = new Router();

$router->get('/', TaskController::class, 'index');
$router->get('/signin', LoginController::class, 'index');
$router->post('/signin', LoginController::class, 'show');
$router->get('/logout', LoginController::class, 'logout');
$router->get('/signup', RegisterController::class, 'index');
$router->post('/signup', RegisterController::class, 'store');
$router->post('/', TaskController::class, 'index');

