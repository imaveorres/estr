<?php
require_once('storeclass.php');
$prod = $store->getAllProducts();
?>
<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <link rel="stylesheet" href="node_modules/bulma/css/bulma.min.css">
 <title>E-Store | List product/title> </title>
</head>

<body>
 <ul>
  <?php foreach ($prod as $products) { ?>
   <li>
    <a href="productdetails.php?id=<?= $products['ID']; ?>">
     <?= $products['product_name']; ?> | <?= $products['product_type']; ?> | <?= $products['minimum_stock']; ?>
    </a>
   </li>
  <?php } ?>
 </ul>
</body>

</html>