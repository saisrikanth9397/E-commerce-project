<?php
include('../includes/conn.php');
//add new distributor page for admin, the admin can create new distributor page
if(isset($_POST['signup'])){

  $uname = $_POST['username'];
  $email = $_POST['useremail'];
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];

  $password = $_POST['password'];

  $cpassword = $_POST['confirm_password'];
  
  $address = $_POST['address'];
  $phone = $_POST['phonenumber'];
  $idproof = $_POST['idproof'];

  $sql1 = "SELECT * FROM `users` WHERE user_name = '$uname' ";


  $records1 = mysqli_num_rows(mysqli_query($con, $sql1));


 // echo strlen(trim($password)); 
if(strlen(trim($uname))<7){

  echo "length of the username must be atleast 7 characters";

}elseif($cpassword!=$password or strlen(trim($password))<3){

        echo "enter password correctly";

  }elseif($records1>0){

      echo "$uname username already taken";

}else{
//setting profile id as 3 for distributor
    $sql = "INSERT INTO `users`( `user_name`,`fname`,`lname`, `password`, `email`, `address`, `Mobile`,`profile_id`) VALUES ('$uname','$fname','$lname','$password','$email','$address','$phone','3')";

    $sql1 = "INSERT INTO `customer`(`user_name`, `customer_proof`) VALUES ('$uname','$idproof')";

  if(mysqli_query($con, $sql)){
    echo "user created successfully with username $uname";

    //header("location:admin.php?");
} else{
    echo "ERROR: Could not able to execute $sql. " .mysqli_error($con);

}


if(mysqli_query($con, $sql1)){
    echo "<br>$uname identification saved";
  
    
  } else{
    echo "ERROR: Could not able to execute $sql1. " .mysqli_error($con);
  
  }


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


<div class="container">
<form action="" method = "post" enctype="multipart/form-data">


<label > Username</label>
&nbsp; &nbsp; &nbsp; &nbsp;<input type="text" name="username" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
<br>

<label > FirstName</label>
&nbsp; &nbsp; &nbsp; &nbsp;<input type="text" name="fname" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
<br>

<label > LastName</label>
&nbsp; &nbsp; &nbsp; &nbsp;<input type="text" name="lname" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
<br>

<label > Email</label>
<input type="Email" name="useremail" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
<br>

<label > Password</label>
<input type="Password" name="password" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
<br>

<label >Confirm Password</label>
<input type="Password" name="confirm_password" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
<br>

<label >Address</label>
<input type="text" name="address" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
<br>

<label >Identification Proof</label>
<input type="text" name="idproof" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
<br>

<label >Phonenumber</label>
<input type="text" name="phonenumber" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
<br>

<button type="submit" name ="signup" class="btn btn-primary">Sign up</button>

</form>

</div>
</body>