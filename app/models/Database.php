<?php

namespace App\Models;
use App\Core\Controller;
use PDO;

class Database
{
    private $dbconn;

    private $db_host = DB_HOST;
    private $db_name = DB_NAME;
    private $db_user = DB_USER;
    private $db_pass = DB_PASS;

    public $stmt;
    public $array;

    public function __construct()
    {
        $this->dbconn = null;

        $pdo = 'mysql:host='.$this->db_host.';'.'dbname='.$this->db_name;
        $options = array(
            PDO::ATTR_PERSISTENT => true
        );

        try {
            $this->dbconn = new PDO($pdo, $this->db_user, $this->db_pass, $options);
        } catch (\PDOException $e) {
            echo "Connection failed:" . $e->getMessage();
        }

        return $this->dbconn;
    }
    public function bind($params, $value, $type = null)
    {
        switch (is_null($type)) {
            case is_int($value):
                $type = PDO::PARAM_INT;
                break;
            case is_bool($value):
                $type = PDO::PARAM_BOOLEAN;
                break;
            case is_null($value):
                $type = PDO::PARAM_NULL;
                break;
            default:
                $type = PDO::PARAM_STR;
        }
        $this->stmt->bindValue($params, $value, $type);
    }

    public function query($sql)
    {
        $this->stmt = $this->dbconn->prepare($sql);
    }

    public function execute()
    {
        $this->stmt->execute();
    }
    public function FetchResult($fetch_type)
    {
        $this->array = $this->stmt->$fetch_type(PDO::FETCH_ASSOC); 
    }
}
