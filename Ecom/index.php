<?php

/*
This is home page for the user. Here the customer browse for products, all products can be viewed, or products can be 
viewed based on category or based on the search as well. If the user wishes to add to cart, he needs to sign in initially and then can
add to cart. User can view cart items by clicking on cart, can view orders by clicking on the orders. IF the user do not have account, he can 
click on sign up and create account to sign in. User can click on log out to sign off. Admin can enter by clicking on admin link.
*/

//including conn.php to connect to the database
include
('includes/conn.php');
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
      <!-- search form  -->
      <form class="d-flex" role="search" action="index.php" method="GET">
        <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-dark" name="submit" type="submit">Search</button>
      </form>
      <ul class="navbar-nav ">
        

        <?php
        //starting session
        session_start();

        //checking if the user is logged in
          if(isset($_SESSION['username'])){


            echo "
            <li class='nav-item'>
            <a class='nav-link' href='index.php?survey'>Survey</a>
          </li>";

            echo "
            <li class='nav-item'>
            <a class='nav-link' href='cart.php'>Cart</a>
          </li>";
            echo "
            <li class='nav-item'>
            <a class='nav-link' href='index.php?orders'>Orders</a>
          </li>";
          echo "
            <li class='nav-item'>
            <a class='nav-link' href='index.php?info'>My Info</a>
          </li>";
            echo "
            <li class='nav-item'>
            <a class='nav-link' href='index.php?logout'>Logout</a>
          </li>";

        
          }else{
              //if the user is not logged in
            echo " <li class='nav-item'>
            <a class='nav-link' href='Admin/admin.php'>Admin</a>
          </li>";
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

//displaying content based the user click, by checking get parameters

if(isset($_GET['survey'])){

  include('survey.php');
}
if(isset($_GET['info'])){

  include('info.php');
}

if(isset($_GET['orders'])){

  include('orders.php');
}
if(isset($_GET['signin'])){

  include('signin.php');
}
if(isset($_GET['signup'])){

  include('signup.php');
}
if(isset($_GET['logout'])){

  include('logout.php');
}

//quering all categories

$sql2 = "Select * from `Category`";

$records = mysqli_query($con, $sql2);

$set = 0000;

//welcome user message if logged in then with username else without username
if(!isset($_GET['signin']) and !isset($_GET['signup'])){



  echo "<h4> Welcome ";

  if(isset($_SESSION['username'])){
    $uname = $_SESSION['username'];
      echo " $uname ,</h4>";
  }
  echo "<h3> Select the products you desire</h3>
  <br>
  <div style = 'text-align: center;' >
    <h4> Categories </h4>";

    //displaying all categories
while($row = mysqli_fetch_assoc($records)){
     $catname =  $row['Category_Name'];
     $catid =  $row['Category_id'];
     $set = 1-1;
     echo "<a class='btn btn-primary' href='index.php?cat=$catid&catname=$catname' role='button'>$catname</a> &nbsp; &nbsp;";

     
}


}


?>

<div>

<br><br>





<section style="background-color: #eee;">
  <div class="text-center container py-5">
  <div class="row">
  <?php

//here showing products based on the search
if(isset($_GET['submit'])){


  //if the user clicks on the add to cart
  if(isset($_GET['addtocart']) ){

    if(isset($_SESSION['username'])){

   $pid = $_GET['addtocart'];
   $uid = $_SESSION['username'];
   $sqlcartcheck = "Select * from `cart` where user_id = '$uid'  LIMIT 1";
   $recordscartcheck = mysqli_query($con, $sqlcartcheck);
   //inserting the cart
   if(mysqli_num_rows($recordscartcheck)==0 ){

     $cartinsert = "INSERT INTO `cart`(`User_id`) VALUES ('$uid')";

     if(mysqli_query($con, $cartinsert)){
   
   } else{
       echo "ERROR: Could not able to execute $cartinsert. " .mysqli_error($con);
   
   }

   }

   $recordscartcheckadd = mysqli_query($con, $sqlcartcheck);
   //inserting cart item
   while($rowcart = mysqli_fetch_assoc($recordscartcheckadd)){
     $cartid = $rowcart['Cart_id'];


     $sqlcartitemcheck = "Select * from `cart_item` where product_id = $pid and cart_id = $cartid  LIMIT 1";
   $recordscartitemcheck = mysqli_query($con, $sqlcartitemcheck);
   if(mysqli_num_rows($recordscartitemcheck)==0 ){

     $cartiteminsert = "INSERT INTO `cart_item`( `cart_id`, `product_id`, `quantity`) VALUES ($cartid,$pid,1)";

     if(mysqli_query($con, $cartiteminsert)){
       echo "<div class='alert alert-primary' role='alert'>
      Product added to the cart! click on cart to checkout.
   </div> <br><div class='row'>";
   
   } else{
       echo "ERROR: Could not able to execute $cartiteminsert. " .mysqli_error($con);
   
   }


     

   }else{
    //if product is already added then displaying to check in cart
     echo "<div class='alert alert-primary' role='alert'>
      Product added to the cart! click on cart to checkout.
   </div> <br><div class='row'>";
   }
   
   } 

   }else{
    //sign in check to add to cart
     echo "<div class='alert alert-primary' role='alert'>
     Please sign in to add to cart!
  </div> <br><div class='row'>";
  include('signin.php');
 }

     
     

 }



  $query=$_GET['search'];

  //check the products if available based on the search

  $sql = "Select * from `Product` where Product_name like '%$query%' and product_quantity>0";
        $records1 = mysqli_query($con, $sql);

        $rowcount = mysqli_num_rows( $records1 );
        if($rowcount==0){
            echo "<h4 style='text:align=center'> no products available </h4>";
        }

        while($row1 = mysqli_fetch_assoc($records1)){


          $image = $row1['Product_image'];
          $name = $row1['Product_name'];
          $price = $row1['Price'];
          $productid = $row1['Product_id'];
          //displaying products using boostarp card

          echo "<div class='col-lg-4 col-md-12 mb-4'>
          <div class='card'>
            <div class='bg-image hover-zoom ripple ripple-surface ripple-surface-light'
              data-mdb-ripple-color='light'>
              <img src='images/$image'
                class='w-100' />
              <a href='#!'>
                <div class='mask'>
                  <div class='d-flex justify-content-start align-items-end h-100'>
                  </div>
                </div>
                <div class='hover-overlay'>
                  <div class='mask' style='background-color: rgba(251, 251, 251, 0.15);'></div>
                </div>
              </a>
            </div>
            <div class='card-body'>
              
                <h5 class='card-title mb-3'>$name</h5>
                
              <h6 class='mb-3'>$ $price</h6>
              <a class='btn btn-warning' href='index.php?search=$query&submit&addtocart=$productid' role='button'>Add to cart</a>
            </div>
          </div>
        </div>";
       
        }

  }else{


  if(isset($_GET['catname'])){
    echo "<h4 class='mt-4 mb-5'><strong>{$_GET['catname']}</strong></h4>";
  }else{
    echo "<h4 class='mt-4 mb-5'><strong>All Products</strong></h4>";



    if(isset($_GET['addtocart']) ){

      if(isset($_SESSION['username'])){

     $pid = $_GET['addtocart'];
     $uid = $_SESSION['username'];
     $sqlcartcheck = "Select * from `cart` where user_id = '$uid'  LIMIT 1";
     $recordscartcheck = mysqli_query($con, $sqlcartcheck);
     if(mysqli_num_rows($recordscartcheck)==0 ){

       $cartinsert = "INSERT INTO `cart`(`User_id`) VALUES ('$uid')";

       if(mysqli_query($con, $cartinsert)){
     
     } else{
         echo "ERROR: Could not able to execute $cartinsert. " .mysqli_error($con);
     
     }

     }

     $recordscartcheckadd = mysqli_query($con, $sqlcartcheck);
     while($rowcart = mysqli_fetch_assoc($recordscartcheckadd)){
       $cartid = $rowcart['Cart_id'];


       $sqlcartitemcheck = "Select * from `cart_item` where product_id = $pid and cart_id = $cartid  LIMIT 1";
     $recordscartitemcheck = mysqli_query($con, $sqlcartitemcheck);
     if(mysqli_num_rows($recordscartitemcheck)==0 ){

       $cartiteminsert = "INSERT INTO `cart_item`( `cart_id`, `product_id`, `quantity`) VALUES ($cartid,$pid,1)";

       if(mysqli_query($con, $cartiteminsert)){
         echo "<div class='alert alert-primary' role='alert'>
        Product added to the cart! click on cart to checkout.
     </div> <br><div class='row'>";
     
     } else{
         echo "ERROR: Could not able to execute $cartiteminsert. " .mysqli_error($con);
     
     }


       

     }else{
       echo "<div class='alert alert-primary' role='alert'>
        Product added to the cart! click on cart to checkout.
     </div> <br><div class='row'>";
     }
     
     } 

     }else{
       echo "<div class='alert alert-primary' role='alert'>
       Please sign in to add to cart!
    </div> <br><div class='row'>";
    include('signin.php');
   }

       
       

   }





// showing all products if only inventory available

    $sql = "Select * from `Product` where product_quantity>0";
    $records1 = mysqli_query($con, $sql);

    while($row1 = mysqli_fetch_assoc($records1)){

      $image = $row1['Product_image'];
      $name = $row1['Product_name'];
      $price = $row1['Price'];
      $productid = $row1['Product_id'];

      echo "<div class='col-lg-4 col-md-12 mb-4'>
      <div class='card'>
        <div class='bg-image hover-zoom ripple ripple-surface ripple-surface-light'
          data-mdb-ripple-color='light'>
          <img src='images/$image'
            class='w-100' />
          <a href='#!'>
            <div class='mask'>
              <div class='d-flex justify-content-start align-items-end h-100'>
              </div>
            </div>
            <div class='hover-overlay'>
              <div class='mask' style='background-color: rgba(251, 251, 251, 0.15);'></div>
            </div>
          </a>
        </div>
        <div class='card-body'>
          
            <h5 class='card-title mb-3'>$name</h5>
          <h6 class='mb-3'>$ $price</h6>
          <a class='btn btn-warning' href='index.php?addtocart=$productid' role='button'>Add to cart</a>
        </div>
      </div>
    </div>";
   
    }
  }


    ?>

    

    

    <?php
//displaying products based on the category
    if(isset($_GET['cat'])){

      $sql2 = "Select * from `Category` where category_id = {$_GET['cat']}";
      $catname =  $_GET['catname'];
      $catid =  $_GET['cat'];

      if(isset($_GET['addtocart']) ){

         if(isset($_SESSION['username'])){

        $pid = $_GET['addtocart'];
        $uid = $_SESSION['username'];
        $sqlcartcheck = "Select * from `cart` where user_id = '$uid'  LIMIT 1";
        $recordscartcheck = mysqli_query($con, $sqlcartcheck);
        if(mysqli_num_rows($recordscartcheck)==0 ){

          $cartinsert = "INSERT INTO `cart`(`User_id`) VALUES ('$uid')";

          if(mysqli_query($con, $cartinsert)){
        
        } else{
            echo "ERROR: Could not able to execute $cartinsert. " .mysqli_error($con);
        
        }

        }

        $recordscartcheckadd = mysqli_query($con, $sqlcartcheck);
        while($rowcart = mysqli_fetch_assoc($recordscartcheckadd)){
          $cartid = $rowcart['Cart_id'];


          $sqlcartitemcheck = "Select * from `cart_item` where product_id = $pid and cart_id = $cartid  LIMIT 1";
        $recordscartitemcheck = mysqli_query($con, $sqlcartitemcheck);
        if(mysqli_num_rows($recordscartitemcheck)==0 ){

          $cartiteminsert = "INSERT INTO `cart_item`( `cart_id`, `product_id`, `quantity`) VALUES ($cartid,$pid,1)";

          if(mysqli_query($con, $cartiteminsert)){
            echo "<div class='alert alert-primary' role='alert'>
           Product added to the cart! click on cart to checkout.
        </div> <br><div class='row'>";
        
        } else{
            echo "ERROR: Could not able to execute $cartiteminsert. " .mysqli_error($con);
        
        }


          

        }else{
          echo "<div class='alert alert-primary' role='alert'>
           Product added to the cart! click on cart to checkout.
        </div> <br><div class='row'>";
        }
        
        } 

        }else{
          echo "<div class='alert alert-primary' role='alert'>
          Please sign in to add to cart!
       </div> <br><div class='row'>";
       include('signin.php');
      }

          
          

      }
    

      

      $records = mysqli_query($con, $sql2);


      while($row = mysqli_fetch_assoc($records)){

        $sql = "Select * from `Product` where Category_id = {$row['Category_id']} and product_quantity>0";
        $records1 = mysqli_query($con, $sql);

        while($row1 = mysqli_fetch_assoc($records1)){

          $image = $row1['Product_image'];
          $name = $row1['Product_name'];
          $price = $row1['Price'];
          $productid = $row1['Product_id'];


          echo "<div class='col-lg-4 col-md-12 mb-4'>
          <div class='card'>
            <div class='bg-image hover-zoom ripple ripple-surface ripple-surface-light'
              data-mdb-ripple-color='light'>
              <img src='images/$image'
                class='w-100' />
              <a href='#!'>
                <div class='mask'>
                  <div class='d-flex justify-content-start align-items-end h-100'>
                  </div>
                </div>
                <div class='hover-overlay'>
                  <div class='mask' style='background-color: rgba(251, 251, 251, 0.15);'></div>
                </div>
              </a>
            </div>
            <div class='card-body'>
             
                <h5 class='card-title mb-3'>$name</h5>
              <h6 class='mb-3'>$ $price</h6>
              <a class='btn btn-warning' href='index.php?cat=$catid&catname=$catname&addtocart=$productid' role='button'>Add to cart</a>
            </div>
          </div>
        </div>";
       
        }



   
        
   
        
   }
  }

}

      ?>



      
    </div>

    
    
  </div>
</section>


</body>
</html>