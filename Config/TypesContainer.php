<?php

/**
 * Fichier de configuration de l'IOC container.
 */

return [
    "singletons" => [
        \App\Core\Request::class => \App\Core\Request::class,
        \App\Core\Session::class => \App\Core\Session::class,
        \App\Core\Route::class => \App\Core\Route::class
    ],
    "types" => [

    ],
    "closures" => [

    ]
];
