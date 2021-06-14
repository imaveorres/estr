<?php
require_once('storeclass.php');
// accessing method inside class using arrow operator
$users = $store->getUsers();
$user_details = $store->getUserData();
print_r($user_details);
?>
<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Cathy's Store | MyStore</title>
</head>

<body>

</body>

</html>