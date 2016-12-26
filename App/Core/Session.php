<?php
/**
 * Gestion des sessions de l'application.
 */

namespace App\Core;

use App\Models\Model;

class Session
{
    /**
     * Données de la session.
     * @var array
     */
    protected $data;

    public function __construct()
    {
        session_start();
        $this->data = $_SESSION;
    }

    /**
     * Modifie/Ajoute une entrée dans la session.
     * @param $key
     * @param $value
     */
    public function set($key, $value){
        $this->data[$key] = $value;
        $this->commit();
    }

    /**
     * Obtient une entrée dans la session.
     * @param $key
     * @return mixed
     */
    public function get($key) {
        return $this->data[$key];
    }

    /**
     * Supprime une entrée dans la session.
     * @param $key
     */
    public function remove($key)
    {
        if(key_exists($key, $this->data)) {
            unset($this->data[$key]);
            $this->commit();
        }
    }

    /**
     * Sauveagarde les données de l'objet dans la vraie variable de session.
     */
    private function commit(){
        $_SESSION = $this->data;
    }
}