<?php
include
('includes/conn.php');
//page for dispalying the order conformation

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

<h4>
Order placed successfully
</h4>

<br>
<h6>

Continue shopping, return to home ->
<a href="index.php" class="btn btn-info" role="button" >Home</a>

</h6>

</body>
</html>