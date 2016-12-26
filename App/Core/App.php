<?php
/**
 * Classe façade de l'application.
 */

namespace App\Core;


class App
{
    /**
     * Permet de créer un objet avec l'IOC Container.
     * @param $dataType
     * @return null|object
     */
    public static function make($dataType) {
        return Container::getInstance()->make($dataType);
    }

    /**
     * Invoque une méthode d'une classe donnée en remplissant ses paramètres avec les types contenus dans l'IOC Container si possible.
     * @param $class
     * @param $method
     */
    public static function invoke($class, $method) {
        Container::getInstance()->invoke($class, $method);
    }
}