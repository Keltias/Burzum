<?php

namespace App\Models;
use PDO;

class Post 
{
    private $connection;

    private $email;
    private $username;
    private $password;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }
    public function createUser(array $array) 
    {
        $this->email = $array['email']; 
        $this->username = $array['password'];
        $this->password = $array['password'];

        $stmt = $this->connection->prepare("INSERT INTO `users` (`email`, `username`, `password`) VALUES (:email, :username, :password)");

        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":username", $this->username);
        $stmt->bindParam(":password", $this->email);
        
        $stmt->execute();
    }
    public function getUser($username, $email)
    {
        $stmt = $this->connection->prepare("SELECT * FROM `users` WHERE username = '$username' OR email = '$email'");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
