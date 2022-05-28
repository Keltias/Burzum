<?php
namespace App\Controllers;

class RedirectController
{
    public $redirect_page;

    function userRedirect($path)
    {
        $this->redirect_page = $path;
        header("Location: {$this->redirect_page}");
    }
}