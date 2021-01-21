<?php

require_once '../system/core/functions.php';

use system\core\Router;
$qStr = $_SERVER['QUERY_STRING'];

define("ROOT", '../');
spl_autoload_register(function($class){
    $class = ROOT . str_replace('\\', '/', $class) . '.php';
    if(file_exists($class)){

        include $class;
    }

});

//Router::add(['news/view' => ['controller' => 'news', 'action' => 'view']]);
//Router::add(['news' => ['controller' => 'news', 'action' => 'index']]);
//Router::add(['page/about' => ['controller' => 'page', 'action' => 'index']]);

Router::add(['^$' => ['controller' => 'Main', 'action' => 'index']]);
Router::add(['^(?P<controller>[a-z0-9-]+)/?(?P<action>[a-z0-9-]+)?$' => []]);
Router::add(['^(?P<controller>[a-z0-9-]+)/(?P<action>[a-z0-9-]+)/(?P<aliace>[a-z0-9-]+)$' => []]);



//pr(Router::$routers);

Router::dispatch($qStr);







