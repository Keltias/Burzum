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
        $this->uri = $_SERVER['REQUEST_URI'];
        $this->redirect_page = '/';
        $this->uri_pattern = '~(^delete$)*[0-9]*$~';
        preg_match($this->uri_pattern, $this->uri, $matches);
        $this->data = $matches[0];

        $this->action = new News();
        $this->action->ArticleDelete($this->data);

        $this->action = new RedirectController($this->redirect_page);
    }
    public function ShowArticle()
    {
        $this->uri = $_SERVER['REQUEST_URI'];

        $this->uri_pattern = '~(^article-$)*[a-zA-Z]*$~';
        preg_match($this->uri_pattern, $this->uri, $matches);

        $this->data = $matches[0];
        $this->action = new News();

        $this->action->GetArticle($this->data);
        $this->data = $this->action->dbHandler->array;

        $this->view->RenderHTML('Страница статьи', $this->data);
    }
}