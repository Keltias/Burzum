<?php
namespace App\Models;

use App\Models\Database;
use App\Core\Model;

class User extends Model
{

    public $dbHandler;
    public $sql;
    public $table_name = USERS_TABLE;

    public function __construct()
    {
        $this->dbHandler = new Database();
    }


    public function userRegister(array $data)
    {
        $this->sql = ("INSERT INTO {$this->table_name} (`id`,`username` , `email`, `password`) VALUES (NULL, :username, :email, :password)");
        $this->dbHandler->query($this->sql);

        $this->dbHandler->bind(':username', $data['username']);
        $this->dbHandler->bind(':password', $data['password']);
        $this->dbHandler->bind(':email', $data['email']);

        $this->dbHandler->execute();
    }
}
