<?php
/**
 * Classe façade de l'application.
 */

namespace App\Core;


class App
{
    /**
     * @var Container
     */
    private static $container;

    public function __construct(Container $container)
    {
        self::$container = $container;
    }

    /**
     * Permet de créer un objet avec l'IOC container.
     * @param $dataType
     * @return null|object
     */
    public static function make($dataType) {
        return self::$container->make($dataType);
    }

    /**
     * Invoque une méthode d'une classe donnée en remplissant ses paramètres avec les types contenus dans le container.
     * @param $class
     * @param $method
     */
    public static function invoke($class, $method) {
        self::$container->invoke($class, $method);
    }
}