<?php


namespace system\core;


class Controller
{
    protected $route;
    private $view;

    public function __construct($route)
    {
        $this->route = $route;
    }
}