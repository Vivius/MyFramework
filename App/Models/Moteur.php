<?php
/**
 * Created by PhpStorm.
 * User: Vincent
 * Date: 25/12/2016
 * Time: 14:26
 */

namespace App\Models;


class Moteur
{
    private $puissance;

    public function __construct()
    {

    }

    public function __toString()
    {
        return "Je suis un moteur";
    }
}