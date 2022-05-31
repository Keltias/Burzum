<?php
namespace App\Controllers;
use App\Core\Controller;

class IndexController extends Controller
{
    public function IndexAction()
    {
        $this->view->RenderHTML('Главная страница');
    }
}