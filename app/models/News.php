<?php
namespace App\Models;

use App\Core\Model;

class News extends Model
{
    public $sql;
    public $table_name = NEWS_TABLE;

    public function ArticleCreate($data)
    {
        $this->sql = ("INSERT INTO {$this->table_name} (`id`, `title`, `content`, `author`) VALUES (NULL, :title, :content, :author)");
        $this->dbHandler->query($this->sql);

        $this->dbHandler->bind(':title', $data['title']);
        $this->dbHandler->bind(':content', $data['content']);
        $this->dbHandler->bind(':author', $data['author']);

        $this->dbHandler->execute();
    }
    public function GetNews()
    {
        $this->sql = ("SELECT * FROM {$this->table_name}");
        $this->dbHandler->query($this->sql);

        $this->dbHandler->execute();
        $this->dbHandler->FetchResult('fetchAll');

        var_dump($this->dbHandler);
    }
}