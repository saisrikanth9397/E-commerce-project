<?php
include('includes/conn.php');
// this page is for user to edit quantity


$cartid = $_GET['cartitemid'];
$quantity = $_GET['quantity'];
$prodname = $_GET['prodname'];
$prodTotalquantity = $_GET['prodTotalquantity'];


if (isset($_POST['updatecart'])) {

  $prodQuantity = $_POST['prodQuantity'];

  //if selected 0 or less then message displaying
  if ($prodQuantity < 1) {
    echo "Cannot set quantity to 0 or negative, please delete item if not required";
 
  } else{

    //if updating the quantity
  if ($prodQuantity < $quantity) {

    $sql = "UPDATE `cart_item` SET `quantity`=$prodQuantity where `cart_item_id` = $cartid ";

    if (mysqli_query($con, $sql)) {
      echo " quantity updated successfully.";
      header("location:cart.php");
    } else {
      echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
    }

  } else {

    if ($prodQuantity > $prodTotalquantity + $quantity) {

      echo "Insufficient quantity avaibale in inventory. Only additional $prodTotalquantity $prodname are available in total";

    } elseif ($prodQuantity < 1) {
      echo "Cannot set quantity to 0 or negative, please delete item if not required";
    } else {

      $sql = "UPDATE `cart_item` SET `quantity`=$prodQuantity where `cart_item_id` = $cartid ";

      if (mysqli_query($con, $sql)) {
        echo " quantity updated successfully.";
        header("location:cart.php");
      } else {
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
      }

    }

  }

}

}

?>


<h3 style="text-align: center;"> Update product</h3>



<!-- update form for edit_cart -->
<form action="" method="post" enctype="multipart/form-data">
  <label><strong>Product Name</strong></label>
  <br>
  <label>
    <?php echo $prodname; ?>
  </label>

  <br>

  <label><strong>Quantity</strong></label>
  <input type="text" value="<?php echo $quantity; ?>" name="prodQuantity" class="form-control"
    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
  <br>
  <button type="submit" name="updatecart" class="btn btn-primary">update cart</button>
</form>