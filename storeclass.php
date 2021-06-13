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
  // check if there is post request 'submit'
  if (isset($_POST['submit'])) {
   $stored_password = "cc03e747a6afbbcbf8be7668acfebee5";
   $password = $_POST['password'];
   if ($stored_password == md5($password)) {
    echo "Login succes!";
   } else {
    echo "Login failed!";
   }
  }
 }

 // add user method
 public function addUser()
 {
  $email = $_POST['email'];
  $password = md5($_POST['password']);
  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];

  // check if there is post request 'add'
  if (isset($_POST['add'])) {
   $connection = $this->openConnection();
   $stmt = $connection->prepare("INSERT INTO members (`email`, `password`, `first_name`, `last_name`) VALUES (?, ?, ?, ?)");
   $stmt->execute([$email, $password, $firstname, $lastname]);
  }
 }
}

// instantiate(instantiation) a class to create an object
$store = new MyStore();
