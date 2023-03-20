<?php
include('../includes/conn.php');
//sign in page for admin and distributor
session_start();
if (isset($_POST['signin'])) {


  $uname = $_POST['username'];

  $password = $_POST['password'];

  $sql = "SELECT * FROM `users` WHERE user_name = '$uname' and password='$password' and (profile_id=2 or profile_id=3) LIMIT 1";


  $records = mysqli_num_rows(mysqli_query($con, $sql));

  if ($records > 0) {

    while ($row = mysqli_fetch_array(mysqli_query($con, $sql))) {
      $_SESSION['admin'] = $uname;
      $_SESSION['profile_id'] = $row['profile_id'];
      echo "$uname loggen in";

      header("location:admin.php");
    }
  } else {
    echo "username or password entered is wrong";
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
      <a class="navbar-brand" href="admin.php">ShopMe Admin page</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <ul class="navbar-nav ">

      </ul>

    </div>
  </nav>


  <div class="container">
    <form action="" method="post" enctype="multipart/form-data">


      <label> Username</label>
      &nbsp; &nbsp; &nbsp; &nbsp;<input type="text" name="username" class="form-control"
        aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
      <br>

      <label> Password</label>
      <input type="Password" name="password" class="form-control" aria-label="Sizing example input"
        aria-describedby="inputGroup-sizing-default">
      <br>


      <button type="submit" name="signin" class="btn btn-primary">Sign in</button>

    </form>

  </div>
</body>

</html>