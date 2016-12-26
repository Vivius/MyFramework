<?php
/**
 * Created by PhpStorm.
 * User: Vincent
 * Date: 25/12/2016
 * Time: 15:35
 */

namespace App\Core;


class Route
{
    /**
     * Nom de la propriété GET utilisée pour déterminer la route (URL).
     */
    const ROUTE_PROPERTY = "page";

    /**
     * Requête HTTP à traiter.
     * @var Request
     */
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Fonction permettant de catcher les requête GET.
     * @param $url
     * @param $controller
     * @param string $method
     */
    public function get($url, $controller, $method = "index") {
        if($this->request->getMethod() == "GET") {
            if($url == $this->request->get(self::ROUTE_PROPERTY)){
                App::invoke($controller, $method);
                exit;
            }
        }
    }

    /**
     * Fonction permettant de catcher les requêtes POST.
     * @param $url
     * @param $controller
     * @param string $method
     */
    public function post($url, $controller, $method = "index") {
        if($this->request->getMethod() == "POST") {
            if($url == $this->request->get(self::ROUTE_PROPERTY)){
                App::invoke($controller, $method);
                exit;
            }
        }
    }
}