<?php

class MyStore
{
 private $server = "mysql:host=localhost;dbname=mystore";
 private $user =  "root";
 private $pass = "";
 private $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);
 protected $con;

 public function openConnection()
 {
  try {
   $this->conn = new PDO($this->server, $this->user, $this->pass, $this->options);
   return $this->conn;
  } catch (PDOException $e) {

   echo "There is some problem in the connection : " . $e->getMessage();
  }
 }

 public function closeConnection()
 {
  $this->con = null;
 }
}
