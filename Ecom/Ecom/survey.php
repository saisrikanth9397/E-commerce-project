<?php
include('includes/conn.php');
//sign in page for user
if(isset($_POST['survey'])){

  $subject = $_POST['subject'];

  $opinion = $_POST['opinion'];

  //checking entered username or password
  $sql = "INSERT INTO `survey`(`user_name`, `subject`, `opinion`) VALUES ('{$_SESSION['username']}','$subject','$opinion')";


  if(mysqli_query($con, $sql)){
    echo "survey created successfully";


} else{
    echo "ERROR: Could not able to execute $sql. " .mysqli_error($con);

}
  


  
}

?>

<div class="container">
<form action="" method = "post" enctype="multipart/form-data">


<label > Subject</label>
&nbsp; &nbsp; &nbsp; &nbsp;<input type="text" name="subject" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
<br>

<label >opinion on the website</label>
&nbsp; &nbsp; &nbsp; &nbsp;<input type="text" name="opinion" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
<br>


<button type="submit" name ="survey" class="btn btn-primary">insert</button>

</form>

</div>
