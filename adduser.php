<?php
require_once('storeclass.php');
// access methods addUser inside store class
$store->addUser();
?>
<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>MyStore - New user</title>
 <link rel="stylesheet" href="node_modules/bulma/css/bulma.min.css">
 <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
</head>

<body>
 <div class="container">
  <h1>Add New Customer</h1>
  <div class="add-user-form">
   <form action="" method="post">
    <div class="field">
     <label class="label">Email</label>
     <div class="control has-icons-left">
      <input class="input" type="email" name="email" id="email">
      <span class="icon is-small is-left">
       <i class="fas fa-envelope"></i>
      </span>
     </div>
    </div>
    <!--first field end-->
    <div class="field">
     <label class="label">Password</label>
     <div class="control has-icons-left">
      <input class="input" type="password" name="password" id="password">
      <span class="icon is-small is-left">
       <i class="fas fa-lock"></i>
      </span>
     </div>
    </div>
    <!--second field end-->
    <div class="field">
     <label class="label">Firstname</label>
     <div class="control has-icons-left">
      <input class="input" type="text" name="firstname" id="firstname">
     </div>
    </div>
    <!--third field end-->
    <div class="field">
     <label class="label">Lastname</label>
     <div class="control has-icons-left">
      <input class="input" type="text" name="lastname" id="lastname">
     </div>
    </div>
    <!--fourth field end-->
    <div class="field">
     <div class="control">
      <button class="button is-link" type="submit" name="add">Add</button>
     </div>
    </div>
   </form>
  </div>
 </div>
 <!--container end-->
</body>

</html>