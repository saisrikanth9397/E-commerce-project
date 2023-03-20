<?php
include('../includes/conn.php');

//edit category name page
if(isset($_POST['newcat'])){

  $catname = $_POST['catename'];


  
//updating category name
    $sql = "UPDATE `category` SET `Category_Name`='$catname' WHERE category_id=$catid LIMIT 1";

  if(mysqli_query($con, $sql)){
    echo "$catname category updated successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " .mysqli_error($con);

}
  


  
}

?>


<h3 style = "text-align: center;" > Edit product</h3>

<?php 

    $catid = $_GET['catid'];
    $catname = $_GET['catname'];

  $results = mysqli_query($con, "SELECT * FROM category where Category_id=$catid LIMIT 1");

  

  ?>


<form action="" method = "post" enctype="multipart/form-data">
<label >Category Name</label>
<input type="text" name="catename" value="<?php echo $catname; ?>" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
<br>

<button type="submit" name ="newcat" class="btn btn-primary">Update</button>
</form>