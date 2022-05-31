<?php

namespace App\Core;

class View 
{
    public $path;
    public $layout;
    public $route;

    public function __construct($route)
    {
        $this->route = $route;
        $this->path = $route['path'];
    }

    public function RenderHTML($title)
    {
        include './tpl/header.php';
        include $this->path;
        include './tpl/footer.php';
    }
}