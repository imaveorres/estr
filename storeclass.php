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
   $username = $_POST['email'];
   $password = md5($_POST['password']);

   $connection = $this->openConnection();
   $stmt = $connection->prepare("SELECT * FROM members WHERE email = ? AND password = ?");
   $stmt->execute([$username, $password]);
   $total = $stmt->rowCount();

   if ($total > 0) {
    echo "Login Success.";
   } else {
    echo "Login Failed!";
   }
  }
 }


 // check user exist method
 public function checkUserExist($email)
 {
  $connection = $this->openConnection();
  $stmt = $connection->prepare("SELECT * FROM members WHERE email = ?");
  $stmt->execute([$email]);
  $total = $stmt->rowCount();

  return $total;
 }


 // add user method
 public function addUser()
 {
  // check if there is post request 'add'
  if (isset($_POST['add'])) {
   $email = $_POST['email'];
   $password = md5($_POST['password']);
   $firstname = $_POST['firstname'];
   $lastname = $_POST['lastname'];

   if ($this->checkUserExist($email) == 0) {
    $connection = $this->openConnection();
    $stmt = $connection->prepare("INSERT INTO members (`email`, `password`, `first_name`, `last_name`) VALUES (?, ?, ?, ?)");
    $stmt->execute([$email, $password, $firstname, $lastname]);
   } else {
    echo "User is already exist!";
   }
  }
 }
}

// instantiate(instantiation) a class to create an object
$store = new MyStore();
