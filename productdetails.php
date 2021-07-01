<?php
require_once("storeclass.php");
$id = $_GET['id'];
$product = $store->getSingleProduct($id);
$stocks = $store->viewAllStocks($id);
?>
<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <link rel="stylesheet" href="node_modules/bulma/css/bulma.min.css">
 <title>E-Store | Product Details</title>
</head>

<body>
 <h4><?= $product['product_name']; ?></h4>
 <h4><?= $product['product_type']; ?></h4>
 <h4><?= $product['minimum_stock']; ?></h4>
 <br>
 <h4>Total: <?= $product['total']; ?></h4>

 <hr>
 <?php foreach ($stocks as $stock) { ?>
  <p><?= $stock['vendor_name']; ?> <?= $stock['qty']; ?> </p>
 <?php } ?>

 <a href="products.php">Products</a>
 <a href="addnewstocks.php?id=<?= $product['ID']; ?>">Add new stocks</a>
</body>

</html>