<?php

namespace App\Core;

class Router
{
    protected $array;
    protected $routes = [];
    protected $params = [];

    function __construct($array)
    {
        $this->array = $array;
        foreach ($array as $key => $value) 
        {
            $this->addRoute($key, $value);
        }
    }

    public function addRoute($route, $params)
    {
        $route = '#^'.$route.'$#';
        $this->routes[$route] = $params;
    }

    public function checkRoute()
    {
        $url = trim($_SERVER['REQUEST_URI'], '/');
        foreach ($this->routes as $route => $params)
        {
            if(preg_match($route, $url, $matches))
            {
                $this->params = $params;
                return true;
            }
        }
        return false;
    }
    public function runRoute()
    {
        if($this->checkRoute())
        {
            $controller = 'App\Controllers\\'.$this->params['controller'];
            if(class_exists($controller))
            {
                $method = $this->params['method'];
                if(method_exists($controller, $method))
                {
                    $object = new $controller($this->params);
                    $object->$method();
                }
            }
            else
            {
                require "404.php";
                die();
            }
        }
        else
        {
            require "404.php";
            die();
        }
    }
}
