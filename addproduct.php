<?php
require_once('storeclass.php');
$store->addProduct();
?>
<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <link rel="stylesheet" href="node_modules/bulma/css/bulma.min.css">
 <title>E-Store | Add products</title>
</head>

<body>
 <div class="container">
  <h1>Add New Product</h1>
  <div class="add-product-form">
   <form action="" method="post">
    <div class="field">
     <label class="label">Product Name</label>
     <input class="input" type="text" name="product_name" id="product_name" required>
    </div>
    <!--1st field end-->
    <div class="field">
     <label class="label">Product Type</label>
     <div class="select">
      <select name="product_type" id="product_type">
       <option value="">---</option>
       <option value="Food">Food</option>
       <option value="Clothing">Clothing</option>
       <option value="Tools">Tools</option>
      </select>
     </div>
    </div>
    <!--2nd field end-->
    <div class="field">
     <label class="label">Minimum Stock</label>
     <div class="control">
      <input class="input" type="number" name="min_stock" id="min_stock" max="1000" value="1" required>
     </div>
    </div>
    <!--3rd field end-->
    <div class="field">
     <div class="control">
      <button class="button is-link" type="submit" name="add_product">Add</button>
     </div>
    </div>
    <!--4th field end-->
   </form>
  </div>
 </div>
 <!--container end-->
</body>

</html>