<?php
/**
 * Created by PhpStorm.
 * User: Vincent
 * Date: 26/12/2016
 * Time: 01:22
 */

namespace App\Http\Controllers;

use App\Core\Request;

class TestController
{
    public function index(Request $request) {
        echo "Ceci est le controlleur de test pour la route ".$request->get("route");
    }

    public function bonjour() {
        echo "Bonjour tout le monde !";
    }
}