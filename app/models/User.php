<?php
namespace App\Models;

use App\Core\Model;

class User extends Model
{
    public $sql;
    public $table_name = USERS_TABLE;

    public function UserCheck(array $data)
    {
        $this->sql = ("SELECT * FROM {$this->table_name} WHERE `username` = :username OR `email` = :email");
        $this->dbHandler->query($this->sql);
    
        $this->dbHandler->bind(':username', $data['username']);
        $this->dbHandler->bind(':email', $data['email']);
    
        $this->dbHandler->execute();
        $this->dbHandler->FetchResult('fetch');
    }

    public function CreateUser(array $data)
    {
        $this->sql = ("INSERT INTO {$this->table_name} (`id`, `public_id`, `username`, `email`, `password`) VALUES (NULL, :id, :username, :email, :password)");
        $this->dbHandler->query($this->sql);

        $this->dbHandler->bind(':username', $data['username']);
        $this->dbHandler->bind(':password', $data['password']);
        $this->dbHandler->bind(':email', $data['email']);
        $this->dbHandler->bind(':id', $data['generated_id']);


        $this->dbHandler->execute();
    }
    public function GetUser(array $data)
    {
        $this->sql = ("SELECT * FROM {$this->table_name} WHERE `public_id` = :id");
        $this->dbHandler->query($this->sql);

        $this->dbHandler->bind(':id', $data[0]);

        $this->dbHandler->execute();
        $this->dbHandler->FetchResult('fetch');
    }
}
