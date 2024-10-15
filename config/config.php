<?php
class db{
  //connect database by mysqli
  //localhost
 /*
  private $hostname = "localhost";
  private $username = "root";
  private $password = "";
  private $dbname = "dbapi";
  */
  //000webhost
  
  private $hostname = "localhost";
  private $username = "id20759328_dacdtkpmnc";
  private $password = "K@h4haha";
  private $dbname = "id20759328_dbdemo";
  
  
  private $conn;

  public function connection(){
   
    // Create connection
    $this->conn = mysqli_connect($this->hostname, $this->username, $this->password, $this->dbname);
    
      return $this->conn;
    }
  }
  
?>