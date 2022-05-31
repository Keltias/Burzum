<?php
namespace App\Controllers;
use App\Core\Controller;
use App\Models\News;

class NewsController extends Controller 
{
    public function ArticleCreate()
    {
        $create_article = new News();
        $create_article->ArticleCreate($this->data);
    }
}