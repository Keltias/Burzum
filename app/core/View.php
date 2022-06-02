<?php

namespace App\Core;

class View 
{
    public $path;
    public $route;

    public function __construct($route)
    {
        $this->route = $route;
        $this->path = $route['path'];
    }

    public function RenderHTML($title, $data)
    {
        include './tpl/header.php';
        include $this->path;
        include './tpl/footer.php';
    }
}