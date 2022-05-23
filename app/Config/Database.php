<?php
namespace App\Config;
require_once "../../vendor/autoload.php";

class Database extends Settings
{
   private $dbInteraction;

   public function dbConnect()
   {
      $this->dbInteraction = null;
   
      try
      {
         $this->dbInteraction = new \PDO('mysql:host='.Settings::DB_HOST . ';'.'dbname='.Settings::DB_NAME, Settings::DB_USER, Settings::DB_PASS);
      }
      catch (\PDOException $e)
      {
         echo "Connection failed:" . $e->getMessage();
      }
   
      return $this->dbInteraction;
   }
   public function makeQuery($sql)
   {
      $stmt = $this->dbInteraction->prepare($sql);
      $stmt->execute();
   }
}