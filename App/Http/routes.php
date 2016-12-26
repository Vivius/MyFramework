<?php
/**
 * Routes de l'application.
 */

use App\Core\Route as Route;
use App\Core\App as App;

$route = App::make(Route::class);

$route->get("test", \App\Http\Controllers\TestController::class, "index");
$route->get("bonjour", \App\Http\Controllers\TestController::class, "bonjour");