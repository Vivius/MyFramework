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
    const ROUTE_PROPERTY = "page";
    private $request;
    private $session;

    public function __construct(Request $request, Session $session)
    {
        $this->request = $request;
        $this->session = $session;
    }

    public function get($url, $controller, $method = "index") {
        if($this->request->getMethod() == "GET") {
            if($url == $this->request->get(self::ROUTE_PROPERTY)){
                App::invoke($controller, $method);
            }
        }
    }

    public function post($url, $controller, $method = "index") {
        if($this->request->getMethod() == "POST") {
            if($url == $this->request->get(self::ROUTE_PROPERTY)){
                App::invoke($controller, $method);
            }
        }
    }
}