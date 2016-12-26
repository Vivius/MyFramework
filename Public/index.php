<?php

/**
 * Point d'entrée de l'application.
 */

include_once "../App/Core/Autoloader.php";

// AUTOLOADER
use App\Core\Autoloader as Autoloader;
Autoloader::register();

// ROUTES
include_once "../App/Http/routes.php";

// ERROR 404
include_once "../Ressources/Views/Errors/404.php";