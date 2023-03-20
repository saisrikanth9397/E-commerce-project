<?php 
include('../includes/conn.php');
//to view products in the database and admin or distributor can edit or delete them
if(isset($_GET['edit'])){

    $prodid = $_GET['productid'];
    $cat = $_GET['cat'];
    include("edit_product.php");

}

if(isset($_GET['delete'])){


    $prodid = $_GET['productid'];
    //delete products is done by calling the procedure in mysql database, whcih parameters as product id to delete
    $delprod = "CALL Product_delete($prodid)";

   // echo "<script> confirm('are you sure you want to delete'); </script>";

   
    if(mysqli_query($con, $delprod)){

        echo "Product deleted successfully";
    }else {
        echo "Error deleting record: " . mysqli_error($con);
      }
    
    

}


 ?>
 <!DOCTYPE html>
<html>
<head>
<title>Admin</title>

<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

<!-- font awesome link-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" 
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</head>
<body>




<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Product_name</th>
      <th scope="col">Category</th>
      <th scope="col">Price in $</th>
      <th scope="col">Quantity available</th>
      <th scope="col">Edit</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>
  <?php 
  $results = mysqli_query($con, "SELECT * FROM product");
  $count =0;
  while ($row = mysqli_fetch_array($results)) { 
    $prodid = $row['Product_id'];
    if($row['Category_id']){
    
    $sql = "Select * from `Category` where Category_id = {$row['Category_id']} LIMIT 1";
    $records1 = mysqli_query($con, $sql);

    
    $cat = "";
    $count = $count+1;

    while($row1 = mysqli_fetch_assoc($records1)){

        $cat = $row1['Category_Name'];
    }
  }else{
    $cat ="";
  }


    ?>
    <tr>
      <th scope="row"><?php echo $count; ?></th>
      <td><?php echo $row['Product_name']; ?></td>
      <td><?php echo $cat; ?></td>
      <td><?php echo $row['Price']; ?></td>
      <td><?php echo $row['product_quantity']; ?></td>
      <td><a class="btn btn-primary" href="admin.php?view_products&edit&productid=<?php echo $prodid; ?>&cat=<?php echo $cat; ?>&quan=<?php echo $row['product_quantity']; ?>" role="button">Edit</a></td>
      <td><a class="btn btn-warning" href="admin.php?view_products&delete&productid=<?php echo $prodid; ?>" onclick="return confirm('are you sure to delete!');"  role="button">Delete</a></td>
    </tr>
    <?php } ?>
  </tbody>
</table>



</body>
</html>
