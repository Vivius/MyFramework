<?php

/**
 * Created by PhpStorm.
 * User: Vincent
 * Date: 25/12/2016
 * Time: 14:26
 */

namespace App\Models;

class Voiture
{
    private $moteur;

    public function __construct(Moteur $moteur)
    {
        $this->moteur = $moteur;
    }

    public function __toString()
    {
        return "Je suis une voiture";
    }
}