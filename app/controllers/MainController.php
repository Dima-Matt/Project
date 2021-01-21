<?php


namespace app\controllers;


use system\core\Controller;

class MainController extends Controller
{


    public function indexAction()     //action - там где вызывается класс
    {
        pr($this->route);
        echo 'Main::index';
    }

    public function testAction()
    {
        pr($this->route);
        echo 'Main::test';
    }

    public function check()
    {

    }
}