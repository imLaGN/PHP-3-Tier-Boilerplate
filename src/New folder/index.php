<?php

// Setup namespaces
require_once __DIR__ . '/../Core/autoload.php';

use App\Config;
use App\Router;
use App\HttpMethod;
use App\Controllers\HomeController;
use App\Controllers\UserController;

// Configure application
if (Config::isDev()) {
    require_once __DIR__ .'/../Config/bootstrap.dev.php';
} else {
    require_once __DIR__ .'/../Config/bootstrap.prod.php';
}

// Setup Routing
$router = new Router();

// Define routes - sets the route for each controller
// Home controller //
$router->addRoute(HttpMethod::Get, '/', [HomeController::class, 'index']);
// User Controller //
$router->addRoute(HttpMethod::Get, '/Users', [UserController::class, 'index']);


// Handle the current request
echo $router->resolve();