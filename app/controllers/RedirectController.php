<?php
namespace App\Controllers;

class RedirectController
{
    public $redirect_page;

    public function __construct($path)
    {
        $this->redirect_page = $path;
        header("Location: {$this->redirect_page}");
    }
}