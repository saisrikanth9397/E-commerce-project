<?php
//home page for admins and distributer


session_start();
//checking if the user is admin or customer to allow only admins or distributer
if (!isset($_SESSION['admin'])) {
  header("location:signin.php");
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
    integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
    crossorigin="anonymous"></script>
</head>

<body>


  <nav class="navbar navbar-expand-lg bg-info">
    <div class="container-fluid">
      <a class="navbar-brand" href="admin.php">Admin</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <ul class="navbar-nav ">
        <?php
    if (isset($_SESSION['admin'])) {

      echo "
            <li class='nav-item'>
            <a class='nav-link' href='admin.php?logout'>Logout</a>
          </li>";
    }
    ?>
      </ul>

    </div>
  </nav>

  <h4 style="text-align: center;"> ShopMe Manager
    <?php
  if ($_SESSION['profile_id'] == 2) {
    echo "Admin Login";
  }
  if ($_SESSION['profile_id'] == 3) {
    echo "distributer Login";
  }
  ?>
  </h4>

  <div style="text-align: center;">


    <?php

if ($_SESSION['profile_id'] == 2) {
  //if the user is admin then profile id is 2 if the user is distributor then the profile id is 3 

echo "<a class='btn btn-primary' href='admin.php?add_newproduct' role='button'>Add Products</a>
<a class='btn btn-primary' href='admin.php?view_products' role='button'>View Products</a>
<a class='btn btn-primary' href='admin.php?new_category' role='button'>New Category</a>
<a class='btn btn-primary' href='admin.php?categories' role='button'>Categories</a>
<a class='btn btn-primary' href='admin.php?orders' role='button'>Orders</a>
<a class='btn btn-primary' href='admin.php?userslist' role='button'>Users</a>
<a class='btn btn-primary' href='admin.php?signup' role='button'>New Admin</a>
<a class='btn btn-primary' href='admin.php?distributer' role='button'>New Distributer</a>
<a class='btn btn-primary' href='admin.php?survey' role='button'>Survey info</a>";
}

//for the distributor, he can add only products
if ($_SESSION['profile_id'] == 3) {

  echo "<a class='btn btn-primary' href='admin.php?add_newproduct' role='button'>Add Products</a>
  <a class='btn btn-primary' href='admin.php?view_products' role='button'>View Products</a>
  <a class='btn btn-primary' href='admin.php?orders' role='button'>Orders</a>";
  }
  


if (isset($_GET['logout'])) {

  include('logout.php');
}
?>




  </div>

  <br><br>

  <div class="container">

    <?php

//showing neccessary information based on the profile id
  if ($_SESSION['profile_id'] == 2) {

    if (isset($_GET['categories'])) {
      include('view_categories.php');
    }
    if (isset($_GET['add_newproduct'])) {
      include('add_newproduct.php');
    }
    if (isset($_GET['view_products'])) {
      include('view_products.php');
    }
    if (isset($_GET['new_category'])) {
      include('new_category.php');
    }
    if (isset($_GET['orders'])) {
      include('orders.php');
    }
    if (isset($_GET['userslist'])) {
      include('userslist.php');
    }

    if (isset($_GET['payments'])) {
      include('payments.php');
    }

    if (isset($_GET['signup'])) {
      include('signup.php');
    }

    if (isset($_GET['distributer'])) {
      include('distributer.php');
    }

    if (isset($_GET['survey'])) {
      include('survey.php');
    }
  }
  
if ($_SESSION['profile_id'] == 3) {


if (isset($_GET['add_newproduct'])) {
  include('add_newproduct.php');
}
if (isset($_GET['view_products'])) {
  include('view_products.php');
}
if (isset($_GET['orders'])) {
  include('orders.php');
}
}
?>
  </div>


</body>

</html>