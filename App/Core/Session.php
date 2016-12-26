<?php
/**
 * Gestion des sessions de l'application.
 */

namespace App\Core;

use App\Models\Model;

class Session
{
    protected $data;

    public function __construct()
    {
        session_start();
        $this->data = $_SESSION;
    }

    public function set($key, $value){
        $this->data[$key] = $value;
        $this->commit();
    }

    public function get($key) {
        return $this->data[$key];
    }

    private function commit(){
        $_SESSION = $this->data;
    }

    public function remove($key)
    {
        if(key_exists($key, $this->data)) {
            unset($this->data[$key]);
            $this->commit();
        }
    }
}