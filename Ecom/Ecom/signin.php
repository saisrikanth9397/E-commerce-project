<?php
include('includes/conn.php');
//sign in page for user
if(isset($_POST['signin'])){

  $uname = $_POST['username'];

  $password = $_POST['password'];

  //checking entered username or password
  $sql = "SELECT * FROM `users` WHERE user_name = '$uname' and password='$password' and profile_id=1 LIMIT 1";

  $sqlresult = mysqli_query($con, $sql);
  $records = mysqli_num_rows($sqlresult);

  if($records>0){
    //setting the session for user
    $_SESSION['username'] = $uname;
    while($row1 = mysqli_fetch_assoc($sqlresult)){

   // echo $row1['user_id'];
   // $_SESSION['userid'] = $row1['user_id'];
    }

    echo "$uname loggen in";

    header("location:index.php");

  }else{

    echo "username or password entered is wrong";

  }
  


  
}

?>

<div class="container">
<form action="" method = "post" enctype="multipart/form-data">


<label > Username</label>
&nbsp; &nbsp; &nbsp; &nbsp;<input type="text" name="username" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
<br>

<label > Password</label>
<input type="Password" name="password" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
<br>


<button type="submit" name ="signin" class="btn btn-primary">Sign in</button>

</form>

</div>
