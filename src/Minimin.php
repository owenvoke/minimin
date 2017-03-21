<?php

namespace pxgamer\Minimin;

use System\App;
use System\Request;
use System\Route;

class Minimin
{
    public $controller;
    public $request;
    public $route;

    public function __construct()
    {
        $this->controller = App::instance();
        $this->request = Request::instance();
        $this->route = Route::instance($this->request);

        $this->route->any('/', [ROUTES . 'Main', 'index']);

        $this->route->end();
    }
}