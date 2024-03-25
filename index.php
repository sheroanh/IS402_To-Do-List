<?php
error_reporting(E_ERROR | E_PARSE);
require 'vendor/autoload.php';

$uri = $_SERVER['REQUEST_URI'];

require 'config/routes.php';
$router->dispatch($uri);