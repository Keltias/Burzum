<?php
namespace App\Controllers;
use App\Core\Controller;
use App\Controllers\RedirectController;
use App\Models\News;

class NewsController extends Controller 
{
    public $redirect_page;

    public function CreateArticle()
    {
        $this->view->RenderHTML('Создание статьи','');

        if(isset($_POST['button']))
        {
            $this->data = [
                'title' => $_POST['title'],
                'content' => $_POST['content'],
                'author' => $_POST['author']
            ];
            $this->action = new News();
            $this->action->ArticleCreate($this->data);
        }
    }
    public function NewsShow()
    {
        $this->action = new News();
        $this->action->GetNews($this->data);
        $this->data = $this->action->dbHandler->array;

        $this->view->RenderHTML('Главная страница',$this->data);
    }
    public function DeleteArticle()
    {
        $this->redirect_page = '/';

        $uri = $_SERVER['REQUEST_URI'];
        $uri_pattern = '~(^delete$)*[0-9]{0,}$~';
        
        preg_match($uri_pattern, $uri, $matches);
        $this->data = $matches[0];

        $this->action = new News();
        $this->action->ArticleDelete($this->data);

        $this->action = new RedirectController($this->redirect_page);
    }
    public function ShowArticle()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $uri_pattern = '~(^article$)*[a-zA-Z]{0,}$~';
        preg_match($uri_pattern, $uri, $matches);

        $this->data = $matches[0];

        $this->action = new News();
        $this->action->GetArticle($this->data);

        $this->data = $this->action->dbHandler->array;

        $this->view->RenderHTML('Страница статьи', $this->data);
    }
    public function EditArticle()
    {

    }
}