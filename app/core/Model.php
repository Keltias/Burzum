<?php
namespace App\Core;
use App\Models\Database;

abstract class Model 
{
    public $dbHandler;

    public function __construct()
    {
        $this->dbHandler = new Database();
    }
}