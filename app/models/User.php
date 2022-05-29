<?php
namespace App\Models;

use App\Models\Database;
use App\Core\Model;
use App\Controllers\UserController;

class User extends Model
{
    public $sql;
    public $table_name = USERS_TABLE;

    public function UserCheck(array $data)
    {
        $this->sql = ("SELECT `username`, `email` FROM {$this->table_name} WHERE `username` = :username OR `email` = :email");
        $this->dbHandler->query($this->sql);
    
        $this->dbHandler->bind(':username', $data['username']);
        $this->dbHandler->bind(':email', $data['email']);
    
        $this->dbHandler->execute();
        $this->dbHandler->MakeFetch('fetch');
    }

    public function CreateUser(array $data)
    {
        $this->sql = ("INSERT INTO {$this->table_name} (`id`, `username`, `email`, `password`) VALUES (NULL, :username, :email, :password)");
        $this->dbHandler->query($this->sql);

        $this->dbHandler->bind(':username', $data['username']);
        $this->dbHandler->bind(':password', $data['password']);
        $this->dbHandler->bind(':email', $data['email']);

        $this->dbHandler->execute();
    }
}
