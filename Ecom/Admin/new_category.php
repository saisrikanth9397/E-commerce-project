<?php
include('../includes/conn.php');

//add category page for admin and distributor
if(isset($_POST['newcat'])){

  $catname = $_POST['catname'];


  $sql2 = "Select * from `Category` where Category_Name = '$catname'";

  $records = mysqli_num_rows(mysqli_query($con, $sql2));

  if($records>0){
    echo "$catname Category already exists.";
  } else{
    //inserting into category
    $sql = "INSERT INTO `Category` (Category_Name) VALUES ('$catname')";

  if(mysqli_query($con, $sql)){
    echo "$catname Category inserted successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " .mysqli_error($con);

}
  }


  
}

?>


<h3 style = "text-align: center;" > Add Category</h3>

<form action="" method = "post">
<label >New Category Name</label>
<input type="text" name="catname" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
<br>
<button type="submit" name ="newcat" class="btn btn-primary">Add</button>
</form>