<?php
namespace App\Core;

class Controller
{
    public $data;
    
    public function __construct($data)
    {
        $this->data = $data;
    }
}