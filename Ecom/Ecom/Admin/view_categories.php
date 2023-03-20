<?php 
include('../includes/conn.php');
//to display all categories the database, can edit or delete them
if(isset($_GET['edit'])){

    $catid = $_GET['catid'];
    $catname = $_GET['catname'];
    include("edit_category.php");

}
if(isset($_GET['delete'])){

    $catid = $_GET['catid'];
    $delprod = "delete from `category` where Category_id = $catid";


   
    if(mysqli_query($con, $delprod)){

        echo "Category deleted successfully";
    }else {
        echo "Error deleting record: " . mysqli_error($con);
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




<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Category Name</th>
      <th scope="col">Edit</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>
  <?php 
  $results = mysqli_query($con, "SELECT * FROM category");
  $count =0;
  while ($row = mysqli_fetch_array($results)) { 

    $count = $count+1;


    ?>
    <tr>
      <th scope="row"><?php echo $count; ?></th>
      <td><?php echo $row['Category_Name']; ?></td>
      <td><a class="btn btn-primary" href="admin.php?categories&edit&catid=<?php echo $row['Category_id']; ?>&catname=<?php echo $row['Category_Name']; ?>" role="button">Edit</a></td>
      <td><a class="btn btn-warning" href="admin.php?categories&delete&catid=<?php echo $row['Category_id']; ?>" onclick="return confirm('are you sure to delete!');"  role="button">Delete</a></td>
    </tr>
    <?php } ?>
  </tbody>
</table>



</body>
</html>
