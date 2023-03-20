<?php
include
('includes/conn.php');

//This is cart page, user can view cart items here, user can increase or decrease quantity of the items, or delete item.
?>


<!DOCTYPE html>
<html>
<head>
<title>shopme</title>

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


<nav class="navbar navbar-expand-lg bg-info">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">ShopMe</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
       
        
        
       
        
      </ul>
      <form class="d-flex" role="search" action="index.php" method="GET">
        <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-dark" name="submit" type="submit">Search</button>
      </form>
      <ul class="navbar-nav ">
        <li class="nav-item">
          <a class="nav-link" href="cart.php">Cart</a>
        </li>

        <?php
        session_start();
          if(isset($_SESSION['username'])){

            



            echo "
            <li class='nav-item'>
            <a class='nav-link' href='index.php?logout'>Logout</a>
          </li>";

        
          }else{

            echo " <li class='nav-item'>
            <a class='nav-link' href='index.php?signin'>Signin</a>
          </li>";
          echo "<li class='nav-item'>
          <a class='nav-link' href='index.php?signup'>Signup</a>
        </li>";
          }
        ?>

       
        
     </ul>
    </div>
  </div>
</nav>

<br>



<?php



if(isset($_GET['signin'])){

  include('signin.php');
}
if(isset($_GET['signup'])){

  include('signup.php');
}
if(isset($_GET['logout'])){

  include('logout.php');
}
?>

<div>

<br><br>

<?php 

//if user wishes to change quantity
if(isset($_GET['edit'])){

    $cartid = $_GET['cartitemid'];
    $quantity = $_GET['quantity'];
    $prodname = $_GET['prodname'];
    include("edit_cart.php");

}

// if user wishes to delete cart item
if(isset($_GET['delete'])){


    $prodid = $_GET['cartitemid'];

    $delprod = "delete from cart_item where cart_item_id = $prodid";


   
    if(mysqli_query($con, $delprod)){

        echo "Product removed successfully";
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



<!-- 
  table to create cart items list
 -->
<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Product_name</th>
      <th scope="col">Quantity</th>
      <th scope="col">Total Price</th>
      <th scope="col">Edit</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>
  <?php 

$tprice = 0;
$ucartid='';
//getting cart for logged in user
  $sql11 = "SELECT * FROM cart where User_id = '{$_SESSION['username']}' LIMIT 1";

  //echo $sql11;
  $recordscartcheck = mysqli_query($con, $sql11);

  $numofrows = mysqli_num_rows($recordscartcheck);
  $numofrows22 =0;
  if($numofrows>0){

    
//getting all the items in the cart 
    while ($row = mysqli_fetch_array($recordscartcheck)) {

  $rowid = $row['Cart_id'];
  $ucartid = $rowid;
  $sql22 = "SELECT * FROM cart_item where Cart_id = $rowid";//getting all items based on the cart id

  //echo $sql22;

  $records22 = mysqli_query($con, $sql22);

  $numofrows22 = mysqli_num_rows($records22);

  if($numofrows22>0){

    $count =0;
    while ($row11 = mysqli_fetch_array($records22)) {
  
      //getting product based on the product id
        $sql33 = "Select * from `product` where Product_id = {$row11['product_id']} LIMIT 1";
        $records1 = mysqli_query($con, $sql33);
    
        $prodid = $row11['product_id'];
        $prodname ="";
        $prodprice = 0;
        $prodquantity = 0;
        //getting the product details of the item in cart_item
        while($row1 = mysqli_fetch_assoc($records1)){
    
            $prodname = $row1['Product_name'];
            $prodprice = $row1['Price']*$row11['quantity'];
            $prodquantity = $row1['product_quantity'];
            $tprice = $tprice + $prodprice;
        }
    

    
    $quantity = $row11['quantity'];
    $cartitemid = $row11['cart_item_id'];
        


    $count = $count+1;

   


    ?>
    <tr>
      <th scope="row"><?php echo $count; ?></th>
      <td><?php echo $prodname; ?></td>
      <td><?php echo $quantity; ?></td>
      <td><?php echo $prodprice; ?></td>
      <td><a class="btn btn-primary" href="cart.php?edit&cartitemid=<?php echo $cartitemid; ?>&quantity=<?php echo $quantity; ?>&prodname=<?php echo $prodname; ?>&prodTotalquantity=<?php echo $prodquantity; ?>" role="button">Edit</a></td>
      <td><a class="btn btn-warning" href="cart.php?delete&cartitemid=<?php echo $cartitemid; ?>" onclick="return confirm('are you sure to remove!');"  role="button">remove</a></td>
    </tr>
    <?php 
  }
    }else{
        echo "<h4>No Items in the cart</h4>";
      }
  }
  
}else{
    echo "<h4>No Items in the cart</h4>";
  }
    ?>
  </tbody>
</table>

<?php

if($numofrows22>0){
  ?>
   <div style = "text-align: center;" >
  <a href="Order.php?tprice=<?php echo $tprice; ?>&ucartid=<?php echo $ucartid; ?>" class="btn btn-info" role="button" >Checkout</a>
</div>

<?php

}
?>



</body>
</html>



</body>
</html>