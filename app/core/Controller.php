<?php
namespace App\Core;
use App\Core\View;

abstract class Controller
{
    public $route;
    public $view;
    public $action;

    public $uri;
    public $uri_pattern;

    public $data;
    
    public function __construct($route)
    {
        $this->route = $route;
        $this->view = new View($this->route);
    }
}