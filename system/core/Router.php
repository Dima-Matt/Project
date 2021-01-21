<?php


class Router
{
    public static $routers = [];
    public static $route = [];

    public static function add($route)
    {
        foreach ($route as $k => $value){
            self::$routers[$k] = $value;
        }

    }

    public static function checkRoute($url)
    {
        foreach (self::$routers as $k => $val){
            if(preg_match("#$k#", $url, $matches)){
                $route = $val;
                foreach ($matches as $key => $match){
                    if(is_string($key)){
                        $route[$key] = $match;
                    }
                }
                $route['controller'] = self::uStr($route['controller']);
                if(!isset($route['action'])){
                    $route['action'] = 'index';
                }
                self::$route = $route;
                return true;
            }
        }
        return false;
    }

    public static function dispatch($url)
    {
        if(self::checkRoute($url)){
            $controller = '\app\controllers\\' . self::$route['controller'] . 'Controller';
            if(class_exists($controller)){
                $obj = new $controller;
            }else{
                echo 'Контроллер ' . $controller . ' не найден.';
            }
        }else{
            echo '404';
        }
    }

    private static function uStr($str)
    {
        $str = str_replace('-', ' ', $str);
        $str = ucwords($str);
        $str = str_replace(' ', '', $str);
        return $str;
    }
}