<?php

class Store
{
 private $server = "mysql:host=localhost;dbname=e_store";
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
   $user = $stmt->fetch();
   $total = $stmt->rowCount();

   if ($total > 0) {
    echo "Welcome " . $user['first_name'] . " " . $user['last_name'];
    $this->setUserData($user);
   } else {
    echo "Login Failed!";
   }
  }
 }



 // set user data or session method
 public function setUserData($array)
 {
  // if not session is set then set session
  if (!isset($_SESSION)) {
   session_start();
  }

  $_SESSION['userdata'] = array(
   "fullname" => $array['first_name'] . " " . $array['last_name'],
   "access_type" => $array['access_type']
  );

  return $_SESSION['userdata'];
 }



 // get user data method
 public function getUserData()
 {
  // check if session is not set otherwise start session
  if (!isset($_SESSION)) {
   session_start();
  }

  // check if session userdata is set otherwise return null
  if (isset($_SESSION['userdata'])) {
   return $_SESSION['userdata'];
  } else {
   return NULL;
  }
 }



 // logout method
 public function logout()
 {
  if (!isset($_SESSION)) {
   session_start();
  }

  $_SESSION['userdata'] = NULL;
  unset($_SESSION['userdata']);
 }



 // show_404 error method
 public function show_404()
 {
  http_response_code(404);
  echo "Page not found!";
  die;
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
   $firstname = $_POST['firstname'];
   $lastname = $_POST['lastname'];
   $address = $_POST['address'];
   $mobile = $_POST['mobile'];
   $email = $_POST['email'];
   $password = md5($_POST['password']);

   if ($this->checkUserExist($email) == 0) {
    $connection = $this->openConnection();
    $stmt = $connection->prepare("INSERT INTO members (`first_name`, `last_name`, `address`, `mobile`, `email`, `password`) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$firstname, $lastname, $address, $mobile, $email, $password]);
   } else {
    echo "User is already exist!";
   }
  }
 }



 // check product exist method
 public function productExist($name)
 {
  $connection = $this->openConnection();
  $stmt = $connection->prepare("SELECT LOWER(`product_name`) FROM products WHERE product_name = ?");
  $stmt->execute([strtolower($name)]);
  $total = $stmt->rowCount();

  return $total;
 }



 // add product method
 public function addProduct()
 {
  if (isset($_POST['add_product'])) {
   $product_name = $_POST['product_name'];
   $product_type = $_POST['product_type'];
   $min_stock = $_POST['min_stock'];
   if ($this->productExist($product_name) == 0) {
    $connection = $this->openConnection();
    $stmt = $connection->prepare("INSERT INTO products (`product_name`,`product_type`, `minimum_stock`) VALUES (?, ?, ?)");

    $stmt->execute([$product_name, $product_type, $min_stock]);
   } else {
    echo "Product already exist!";
   }
  }
 }



 // list of products method
 public function getAllProducts()
 {
  $connection = $this->openConnection();
  $stmt = $connection->prepare("SELECT * FROM products");
  $stmt->execute();
  $products = $stmt->fetchAll();
  $total = $stmt->rowCount();

  if ($total > 0) {
   return $products;
  } else {
   return FALSE;
  }
 }



 // get single product method
 public function getSingleProduct($id)
 {
  $connection = $this->openConnection();
  $stmt = $connection->prepare("SELECT product_name, product_type, minimum_stock, SUM(qty) AS total FROM (SELECT * FROM products WHERE products.ID = ?) t1 INNER JOIN product_items t2 ON t1.ID = t2.product_id");
  $stmt->execute([$id]);
  $product = $stmt->fetch();
  $total = $stmt->rowCount();

  if ($total > 0) {
   return $product;
  } else {
   return $this->show_404();
  }
 }


 // get total produc qty method
 public function getTotalQty($product_id)
 {
  $connection = $this->openConnection();
  $stmt = $connection->prepare("SELECT *, SUM(qty) AS total FROM product_items WHERE product_id=?");
  $stmt->execute([$product_id]);
  $product_qty = $stmt->fetch();

  return $product_qty['total'];
 }



 // add stocks method 
 public function addStock()
 {
  if (isset($_POST['add_new_stock'])) {
   $brand_name = $_POST['brand_name'];
   $qty = $_POST['qty'];
   $batch_number = $_POST['batch_number'];
   $product_id = $_POST['product_id'];
   $added_by = $_POST['added_by'];

   $connection = $this->openConnection();
   $stmt = $connection->prepare("INSERT INTO product_items (`product_id`, `qty`, `vendor_name`, `added_by`, `batch_number`) VALUE (?, ?, ?, ?, ?)");
   $stmt->execute([$product_id, $qty, $brand_name, $added_by, $batch_number]);

   header("Location: productdetails.php?id=" . $product_id);
  }
 }


 // view all stocks method
 public function viewAllStocks($product_id)
 {
  $connection = $this->openConnection();
  $stmt = $connection->prepare("SELECT * FROM product_items WHERE product_id=?");
  $stmt->execute([$product_id]);
  $stocks = $stmt->fetchAll();
  $total = $stmt->rowCount();

  if ($total > 0) {
   return $stocks;
  } else {
   return FALSE;
  }
 }
} /* closing bracket store class */


// instantiate(instantiation) a class to create an object
$store = new Store();
