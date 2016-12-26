<?php
/**
 * Classe model mère comportant essentiellement des méthodes magiques.
 */

namespace App\Models;


class Model
{
    public function __set($name, $value)
    {
        $prop = "_".$name;
        if(property_exists(get_called_class(), $prop))
            $this->$prop = $value;
        else
            throw new \Exception("Propriété ".$prop." non existente dans".get_called_class());
    }

    public function __get($name)
    {
        $prop = "_".$name;
        if(property_exists(get_called_class(), $prop))
            return $this->$prop;
        else
            throw new \Exception("Propriété ".$prop." non existente dans ".get_called_class());
    }
}