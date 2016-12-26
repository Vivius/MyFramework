<?php
/**
 * Routes de l'application.
 */

use App\Core\Route as Route;

Route::get("test", \App\Http\Controllers\TestController::class, "index");
Route::get("bonjour", \App\Http\Controllers\TestController::class, "bonjour");