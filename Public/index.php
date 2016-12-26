<?php

/**
 * Point d'entrée de l'application.
 */

include_once "../App/Core/Autoloader.php";

use App\Core\Autoloader as Autoloader;
Autoloader::register();

include_once "../App/Http/routes.php";