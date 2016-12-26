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
    private static $request;
    const ROUTE_PROPERTY = "route";

    public function __construct(Request $request)
    {
        self::$request = $request;
    }

    public static function get($url, $controller, $method = "index") {
        if(self::$request->getMethod() == "GET") {
            if($url == self::$request->get(self::ROUTE_PROPERTY)){
                App::invoke($controller, $method);
            }
        }
    }

    public static function post($url, $controller, $method = "index") {
        if(self::$request->getMethod() == "POST") {
            if($url == self::$request->get(self::ROUTE_PROPERTY)){
                App::invoke($controller, $method);
            }
        }
    }
}