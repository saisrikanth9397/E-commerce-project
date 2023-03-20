<?php 
include('../includes/conn.php');
//to display all orders by the users
if(isset($_GET['orderid'])){

    $catid = $_GET['orderid'];
    include("order_line.php");

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




<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">User Name</th>
      <th scope="col">Order Date</th>
      <th scope="col">Payments</th>
      <th scope="col">Address</th>
      <th scope="col">Total Price in $</th>
      <th scope="col">Order Status</th>
    </tr>
  </thead>
  <tbody>
  <?php 
  //getting all the orders in the database
  $results = mysqli_query($con, "SELECT * FROM orders");
  $count =0;
  while ($row = mysqli_fetch_array($results)) { 
    $ordid = $row['order_id'];
    //qurerying users for username based on the userid in the orders
    $sql = "Select * from `users` where user_name = '{$row['user_id']}' LIMIT 1";
    $records1 = mysqli_query($con, $sql);

    
    $cat = "";
    $count = $count+1;

    while($row1 = mysqli_fetch_assoc($records1)){

        $unmae = $row1['user_name'];
    }
  

    ?>
    <tr>
      <th scope="row"><?php echo $count; ?></th>
      <td><?php echo $unmae; ?></td>
      <td><?php echo $row['order_date']; ?></td>
      <td><?php echo $row['payment']; ?></td>
      <td><?php echo $row['address']; ?></td>
      <td><?php echo $row['total_price']; ?></td>
      <td><?php echo $row['order_status']; ?></td>
      <td><a class="btn btn-primary" href="admin.php?orders&orderid=<?php echo $ordid; ?>" role="button">View Items</a></td>
    </tr>
    <?php } ?>
  </tbody>
</table>



</body>
</html>
