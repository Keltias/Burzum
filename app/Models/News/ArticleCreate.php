<?php
    namespace App\Models\News;
    
    class ArticleCreate 
    {
        private $dbInteraction;

        public $title;
        public $content;
        public $author;

        public function __construct($dbconn)
        {
            $this->dbInteraction = $dbconn;
        }
        public function articleCreate()
        {  
            $this->title = $_POST['title'];
            $this->content = $_POST['content'];
            $this->author = $_POST['author'];

            $this->title = trim(htmlspecialchars($this->title));
            $this->content = trim(htmlspecialchars($this->content));
            $this->author = trim(htmlspecialchars($this->author));

            $sql = "INSERT INTO `news` (`id`, `title`, `content`, `author`) VALUES(NULL, :title, :content, :author)";
            $stmt = $this->dbInteraction->prepare($sql);

            $stmt->bindParam(":title", $this->title);
            $stmt->bindParam(":content", $this->content);
            $stmt->bindParam(":author", $this->author);

            $stmt->execute();        
        }
    }