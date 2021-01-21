<?php
namespace system\core;

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
        $url = self::removeQueryString($url);
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
                $obj = new $controller(self::$route);
                $action = self::lStr(self::$route['action']) . 'Action';

                if(method_exists($obj, $action)){
                    $obj->$action();
                }else{
                    echo 'Метод ' . $action . ' не найден';
                }
            }else{
                echo 'Контроллер ' . $controller . ' не найден.';
            }
        }else{
            http_response_code(404);
            include '404.html';
        }
    }

    private static function uStr($str)
    {
        $str = str_replace('-', ' ', $str);
        $str = ucwords($str);
        $str = str_replace(' ', '', $str);
        return $str;
    }

    private static function lStr($str)
    {
        return lcfirst(self::uStr($str));
    }

    private static function removeQueryString($url) // удаляет явные гет-параметры(после?)
    {
        if($url != ''){
            $params = explode('&', $url);
            if(strpos($params[0], '=') === false){
                return $params[0];
            }else{
                return '';
            }
        }
        return $url;
    }
}