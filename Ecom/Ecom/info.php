<?php
include('includes/conn.php');

//page for user information edit
if (isset($_POST['edituser'])) {

  $uname = $_POST['uname'];
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $email = $_POST['email'];
  $address = $_POST['address'];
  $mobile = $_POST['mobile'];
  $password = $_POST['password'];
  $cpassword = $_POST['cpassword'];


//checking if the password is less than 3 characters and password match
  if ($password) {
    if ($cpassword != $password or strlen(trim($password)) < 3) {

      echo "enter password correctly";

    } else {

      $sql = "UPDATE `users` SET `password`='$password',`email`='$email',`address`='$address',`Mobile`='$mobile',`fname`='$fname',`lname`='$lname' where user_name='$uname'";

      if (mysqli_query($con, $sql)) {
        echo "info updated successfully.";
      } else {
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);

      }
    }
  } else {
    // if password is not changed
    $sql = "UPDATE `users` SET `email`='$email',`address`='$address',`Mobile`='$mobile',`fname`='$fname',`lname`='$lname' where user_name='$uname'";

    if (mysqli_query($con, $sql)) {
      echo "info updated successfully.";
    } else {
      echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);

    }

  }




}

?>


<h3 style="text-align: center;"> My Information</h3>

<?php


$results = mysqli_query($con, "SELECT * FROM users where user_name='{$_SESSION['username']}' LIMIT 1");

while ($row = mysqli_fetch_array($results)) {
  $uname = $row['user_name'];
  $fname = $row['fname'];
  $lname = $row['lname'];
  $email = $row['email'];
  $address = $row['address'];
  $mobile = $row['Mobile'];

?>

<!-- 
  edit form for user information
-->
<form action="" method="post" enctype="multipart/form-data">
  <label>username:</label>
  <label>
    <?php echo $uname; ?>
  </label>
  <input type="hidden" value="<?php echo $uname; ?>" name="uname" class="form-control" aria-label="Sizing example input"
    aria-describedby="inputGroup-sizing-default">
  <br>

  <label>FirstName</label>
  <input type="text" value="<?php echo $fname; ?>" name="fname" class="form-control" aria-label="Sizing example input"
    aria-describedby="inputGroup-sizing-default">
  <br>
  <label>LastName</label>
  <input type="text" value="<?php echo $lname; ?>" name="lname" class="form-control" aria-label="Sizing example input"
    aria-describedby="inputGroup-sizing-default">
  <br>
  <label>email</label>
  <input type="text" value="<?php echo $email; ?>" name="email" class="form-control" aria-label="Sizing example input"
    aria-describedby="inputGroup-sizing-default">
  <br>
  <label>Address</label>
  <input type="text" value="<?php echo $address; ?>" name="address" class="form-control"
    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
  <br>
  <label>Mobile</label>
  <input type="text" value="<?php echo $mobile; ?>" name="mobile" class="form-control" aria-label="Sizing example input"
    aria-describedby="inputGroup-sizing-default">
  <br>
  <label>New Password</label>
  <input type="text" value="" name="password" class="form-control" aria-label="Sizing example input"
    aria-describedby="inputGroup-sizing-default">
  <br>
  <label>Confirm Password</label>
  <input type="text" value="" name="cpassword" class="form-control" aria-label="Sizing example input"
    aria-describedby="inputGroup-sizing-default">
  <br>

  <button type="submit" name="edituser" class="btn btn-primary">Update</button>
</form>

<?php }
?>