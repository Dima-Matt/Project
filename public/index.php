<?php

require_once '../system/core/functions.php';
require_once '../system/core/Router.php';
require_once '../app/controllers/MainController.php';


$qStr = $_SERVER['QUERY_STRING'];

//Router::add(['news/view' => ['controller' => 'news', 'action' => 'view']]);
//Router::add(['news' => ['controller' => 'news', 'action' => 'index']]);
//Router::add(['page/about' => ['controller' => 'page', 'action' => 'index']]);

Router::add(['^$' => ['controller' => 'Main', 'action' => 'index']]);
Router::add(['^(?P<controller>[a-z0-9-]+)/?(?P<action>[a-z0-9-]+)?$' => []]);

echo 'for you git!';

pr(Router::$routers);

Router::dispatch($qStr);







