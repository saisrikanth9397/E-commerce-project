<?php
include('../includes/conn.php');

//this page is to edit particular product information like product name, price, and quantity
if(isset($_POST['newprod'])){

  $prodname = $_POST['prodname'];
  $catname = $_POST['category'];
/*
  $filename = $_FILES['prodimage']['name'];
  $tempname = $_FILES['prodimage']['tmp_name']; */
  $prodprice = $_POST['prodprice'];
  $prodquantity = $_POST['prodquantity'] +$_GET['quan'];
  
 // move_uploaded_file($tempname, "../images/$filename");


  if($catname){
    //updating product information if catname is set
    $sql = "UPDATE `product` SET `Product_name`='$prodname',`Category_id`='$catname',`Price`='$prodprice',`product_quantity`='$prodquantity' WHERE Product_id=$prodid LIMIT 1";
  }else{
    //updating product information if catname is not set
    $sql = "UPDATE `product` SET `Product_name`='$prodname',`Price`='$prodprice',`product_quantity`='$prodquantity' WHERE Product_id=$prodid LIMIT 1";
  }
  if(mysqli_query($con, $sql)){
    echo "$prodname product updated successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " .mysqli_error($con);

}
  


  
}

?>


<h3 style = "text-align: center;" > Edit product</h3>

<?php 

    $prodid = $_GET['productid'];
    $cat = $_GET['cat'];

  $results = mysqli_query($con, "SELECT * FROM product where Product_id=$prodid LIMIT 1");

  
  while ($row = mysqli_fetch_array($results)) { 
        $productname = $row['Product_name'];
        $productcat = $row['Category_id'];
        $productimage = $row['Product_image'];
        $productprice = $row['Price'];
        $productquantity = $row['product_quantity'];

  }

  ?>


<form action="" method = "post" enctype="multipart/form-data">
<label >New Product Name</label>
<input type="text" name="prodname" value="<?php echo $productname; ?>" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
<br>
<label >Select Category </label>
<select class="form-select" name="category" aria-label="Default select example">
<option selected value='<?php echo $productcat; ?>'><?php echo $cat; ?></option>
<?php
if($productcat){
$sql2 = "Select * from `Category` where Category_id!= $productcat ";
}else{
  
  $sql2 = "Select * from `Category` ";
}

$records = mysqli_query($con, $sql2);

while($row = mysqli_fetch_assoc($records)){
     $catname =  $row['Category_Name'];
     $catid =  $row['Category_id'];
     echo "<option value='$catid'>$catname</option>";

     
}

?>
  
</select>

<br>
<!--
<label >Product Imge</label>
<input type="file" value="<?php echo $productimage; ?>" name="prodimage" class="form-control" id="prodimage"/>
<br>
-->

<label >Product Price</label>
<input type="text" value="<?php echo $productprice; ?>" name="prodprice" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
<br>
<label >add quantity : <?php echo $productquantity; ?> available now</label>
<input type="text"  name="prodquantity" value=0 class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
<br>
<button type="submit" name ="newprod" class="btn btn-primary">Update</button>
</form>