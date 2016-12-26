<?php
/**
 * Classe gérant les requêtes HTTP.
 */

namespace App\Core;

class Request
{
    /**
     * Paramètres GET et POST de la requête HTTP.
     * @var
     */
    private $parameters;

    /**
     * Variable de SESSION de la requête HTTP.
     * @var Session
     */
    private $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
        $this->collecteParameters();
    }

    /**
     * Collecte l'ensemble des paramètres reçus par la requête HTTP.
     */
    private function collecteParameters() {
        $this->parameters = [];
        $this->parameters = array_merge($this->parameters, $_POST);
        $this->parameters = array_merge($this->parameters, $_GET);
    }

    /**
     * Retourne tous les paramètres de la requête HTTP.
     * @return array
     */
    public function all() {
        return $this->parameters;
    }

    /**
     * Obtient un paramètre spécifique de la requête.
     * @param $key
     * @return mixed|null
     */
    public function get($key) {
        if(key_exists($key, $this->parameters))
            return $this->parameters[$key];
        else
            return null;
    }

    /**
     * Retourne la méthode d'envoi de la requête.
     * @return mixed
     */
    public function getMethod() {
        return $_SERVER["REQUEST_METHOD"];
    }
}