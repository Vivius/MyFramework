<?php

/**
 * Fichier de configuration de l'IOC container.
 */

return new \App\Core\Container(
    // Singletons
    [
        \App\Core\Request::class => \App\Core\Request::class
    ],
    // Types
    [
        \App\Core\Session::class => \App\Core\Session::class,
        \App\Core\Route::class => \App\Core\Route::class
    ],
    // Closures.
    []
);
