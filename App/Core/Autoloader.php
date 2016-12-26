<?php
/**
 * Autoloader principal de l'application.
 */

namespace App\Core;

class Autoloader
{
    /**
     * Enregistrement de l'autoloader.
     */
    static function register(){
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }

    /**
     * Procédure d'autoloading des classes.
     * @param $class
     */
    static function autoload($class){
        $filename =  str_replace("\\", "/", $class);
        require "../".$filename.".php";
    }

}