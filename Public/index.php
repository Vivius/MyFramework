<?php

/**
 * Point d'entrée de l'application.
 */

include_once "../App/Core/Autoloader.php";

use App\Core\Autoloader as Autoloader;
use App\Core\App as App;

Autoloader::register();
$app = new App(include_once "../Config/Container.php");
$session = App::make(\App\Core\Session::class);
$route = App::make(\App\Core\Route::class);

include_once "../App/Http/routes.php";


