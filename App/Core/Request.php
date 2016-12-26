<?php
/**
 * Classe gérant les requêtes HTTP.
 */

namespace App\Core;

class Request
{
    private $parameters;
    private static $instance;

    private function __construct()
    {
        $this->parameters = array();
        $this->collecteParameters();
    }

    public static function getInstance() {
        if(is_null(self::$instance))
            return new Request();
        else
            return self::$instance;
    }

    /**
     * Collecte l'ensemble des paramètres reçus par la requête HTTP.
     */
    private function collecteParameters() {
        $this->parameters = array_merge($this->parameters, $_POST);
        $this->parameters = array_merge($this->parameters, $_GET);
    }

    public function all() {
        return $this->parameters;
    }

    public function get($key) {
        if(key_exists($key, $this->parameters))
            return $this->parameters[$key];
        else
            return null;
    }

    public function getMethod() {
        return $_SERVER["REQUEST_METHOD"];
    }
}