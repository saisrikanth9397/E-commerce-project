<?php 
include('../includes/conn.php');
//list users in the database, displays all the customers, admins and distributor
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
      <th scope="col">User Name</th>
      <th scope="col">First Name</th>
      <th scope="col">Last Name</th>
      <th scope="col">Profile</th>
      <th scope="col">Password</th>
      <th scope="col">Email</th>
      <th scope="col">Address</th>
      <th scope="col">Mobile Number</th>
    </tr>
  </thead>
  <tbody>
  <?php 
  //below is the userlist, which is view from users and profile
  $results = mysqli_query($con, "SELECT * FROM userslist");  
  $count =0;
  while ($row = mysqli_fetch_array($results)) { 

    
    $cat = "";
    $count = $count+1;
    ?>
    <tr>
      <th scope="row"><?php echo $count; ?></th>
      <td><?php echo $row['user_name']; ?></td>
      <td><?php echo $row['fname']; ?></td>
      <td><?php echo $row['lname']; ?></td>
      <td><?php echo $row['profile_name']; ?></td>
      <td><?php echo $row['password']; ?></td>
      <td><?php echo $row['email']; ?></td>
      <td><?php echo $row['address']; ?></td>
      <td><?php echo $row['Mobile']; ?></td>
    </tr>
    <?php } ?>
  </tbody>
</table>



</body>
</html>
