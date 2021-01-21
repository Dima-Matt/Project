<?php


namespace app\controllers;


use system\core\Controller;

class PageController extends Controller
{
    public function indexAction()
    {
        pr($this->route);
        echo 'Page::index';
    }

    public function testAction()
    {
        pr($this->route);
        echo 'Page::test';
    }
}