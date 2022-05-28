<?php
namespace App\Core;

class Router
{
    private $pages = array();

    function AddRoute($url, $path)
    {
        $this->pages[$url] = $path;
    }

    function route($url)
    {
        $path = $this->pages[$url];

        $file_dir = "pages/". $path;

        if($path == "")
        {
            require "404.php";
            die();
        }

        if(file_exists($file_dir))
        {
            require $file_dir;
        }
        else
        {
            require "404.php";
            die();
        }
    }
}