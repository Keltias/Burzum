<?php
namespace Core\Config;

class Database extends Settings
{
   private $dbconn;

   public function dbConnect()
   {
      $this->dbconn = null;
   
      try
      {
         $this->dbconn = new \PDO('mysql:host='.Settings::DB_HOST . ';'.'dbname='.Settings::DB_NAME, Settings::DB_USER, Settings::DB_PASS);
      }
      catch (\PDOException $e)
      {
         echo "Connection failed:" . $e->getMessage();
      }
   
      return $this->dbconn;
   }
   public function makeQuery($sql)
   {
      $stmt = $this->dbconn->prepare($sql);
      $stmt->execute();
   }
}