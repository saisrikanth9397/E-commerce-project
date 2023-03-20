<?php
include('../includes/conn.php');

//add new products page used to add new product name, image, price and quantity available

if(isset($_POST['newprod'])){

  $prodname = $_POST['prodname'];
  $catname = $_POST['category'];

  $filename = $_FILES['prodimage']['name'];
  $tempname = $_FILES['prodimage']['tmp_name'];
  $prodprice = $_POST['prodprice'];
  $quantity = $_POST['quantity'];
  
  //storing image in the directory
  move_uploaded_file($tempname, "../images/$filename");


    $sql = "INSERT INTO `Product` ( `Product_name`, `Category_id`, `Product_image`, `Price`,`product_quantity`) VALUES ('$prodname', '$catname', '$filename', '$prodprice','$quantity')";

  if(mysqli_query($con, $sql)){
    echo "$prodname product inserted successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " .mysqli_error($con);

}
  


  
}

?>


<h3 style = "text-align: center;" > Add new products</h3>

<form action="" method = "post" enctype="multipart/form-data">
<label >New Product Name</label>
<input type="text" name="prodname" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
<br>
<label >Select Category </label>
<select class="form-select" name="category" aria-label="Default select example">
<option selected>Select Category</option>
<?php
//getting categories to add category
$sql2 = "Select * from `Category`";

$records = mysqli_query($con, $sql2);

while($row = mysqli_fetch_assoc($records)){
     $catname =  $row['Category_Name'];
     $catid =  $row['Category_id'];
     echo "<option value='$catid'>$catname</option>";

     
}

?>
  
</select>

<br>
<label >Product Imge</label>
<input type="file" name="prodimage" class="form-control" id="prodimage"/>
<br>

<label >Product Price</label>
<input type="text" name="prodprice" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
<br>
<label >Add Quantity</label>
<input type="text" name="quantity" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
<br>
<button type="submit" name ="newprod" class="btn btn-primary">Add</button>
</form>