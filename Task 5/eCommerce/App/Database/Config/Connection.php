<?php
namespace App\Database\Config;
class Connection{
  private string $serverName = "localhost";
  private string $userName = "root";
  private string $password = "";
  private string $DB_name = "nti_ecommerce";
  protected \mysqli $conn;
  public function __construct()
  {
    $this->conn = new \mysqli($this->serverName,$this->userName,$this->password,$this->DB_name);
  }
  
  public function __destruct()
  {
    $this->conn->close();
  }

  public function getConn()
  {
    return $this->conn;
  }
}
