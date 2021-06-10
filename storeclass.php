<?php

class MyStore
{
 private $server = "mysql:host=localhost;dbname=mystore";
 private $user =  "root";
 private $pass = "";
 private $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);
 protected $con;


 // open conn method
 public function openConnection()
 {
  try {
   $this->conn = new PDO($this->server, $this->user, $this->pass, $this->options);
   return $this->conn;
  } catch (PDOException $e) {

   echo "There is some problem in the connection : " . $e->getMessage();
  }
 }


 // close conn method
 public function closeConnection()
 {
  $this->con = null;
 }


 // display users method
 public function getUsers()
 {
  $connection = $this->openConnection();
  $stmt = $connection->prepare("SELECT * FROM members");
  $stmt->execute();
  $users = $stmt->fetchAll();
  $userCount = $stmt->rowCount();

  if ($userCount > 0) {
   return $users;
  } else {
   return 0;
  }
 }


 // login method
 public function login()
 {
 }
}

// instantiate(instantiation) a class to create an object
$store = new MyStore();
