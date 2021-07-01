<?php
require_once("storeclass.php");
$id = $_GET['id'];
//$id = 1;
$product = $store->getSingleProduct($id);
$store->addStock();
$user_details = $store->getUserData();

if (isset($user_details)) {
 if ($user_details['access_type'] != "administrator") {
  header("Location: login.php");
 }
} else {
 header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <link rel="stylesheet" href="node_modules/bulma/css/bulma.min.css">
 <title>E-Store | Add new stocks</title>
</head>

<body>
 <div class="container">
  <h1>Add New Stocks</h1>
  <div class="add-new-stocks">
   <form action="" method="post">
    <div class="field">
     <label class="label">Brand Name</label>
     <input class="input" type="text" name="brand_name" id="brand_name" required>
    </div>
    <!--1st field end-->
    <!-- <div class="field">
     <label class="label">Product Type</label>
     <div class="select">
      <select name="product_type" id="product_type">
       <option value="">---</option>
       <option value="Food">Food</option>
       <option value="Clothing">Clothing</option>
       <option value="Tools">Tools</option>
      </select>
     </div>
    </div> -->
    <!--2nd field end-->
    <div class="field">
     <label class="label">Qty</label>
     <div class="control">
      <input class="input" type="number" name="qty" id="qty" max="1000" min="1" required>
     </div>
    </div>
    <!--3rd field end-->
    <div class="field">
     <label class="label">Batch Number</label>
     <div class="control">
      <input class="input" type="text" name="batch_number" id="batch_number" required>

      <input class="input" type="hidden" name="product_id" id="product_id" value="<?= $product['ID']; ?>">

      <input class="input" type="hidden" name="added_by" id="added_by" value="<?= $user_details['fullname']; ?>">
     </div>
    </div>
    <!--4th field end-->
    <div class="field">
     <div class="control">
      <button class="button is-link" type="submit" name="add_new_stock">Add</button>
     </div>
    </div>
    <!--5th field end-->
   </form>
  </div>
</body>

</html>