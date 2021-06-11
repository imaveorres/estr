<?php
require_once('storeclass.php');
$store->login();
?>
<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Login</title>
 <link rel="stylesheet" href="node_modules/bulma/css/bulma.min.css">
</head>

<body>
 <div class="container">
  <div class="login-form">
   <div class="field">
    <label class="label">Username</label>
    <div class="control has-icons-left">
     <input class="input" type="text" name="username" id="username">
     <span class="icon is-small is-left"><i class="fas fa-user"></i></span>
    </div>
   </div>

   <div class="field">
    <label class="label">Password</label>
    <div class="control has-icons-left">
     <input class="input" type="password" name="password" id="password">
     <span class="icon is-small is-left"><i class="fas fa-lock"></i></span>
    </div>
   </div>

   <div class="field">
    <div class="control">
     <button class="button is-link" type="submit" name="submit">Login</button>
    </div>
   </div>
  </div>
 </div>
 <!--end of container-->

</body>

</html>