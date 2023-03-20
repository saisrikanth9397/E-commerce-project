
<!--
  to show survey report
 -->
<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Username</th>
      <th scope="col">Subject</th>
      <th scope="col">User Opinion</th>
    </tr>
  </thead>
  <tbody>
  <?php 
  include('../includes/conn.php');
  //getting all the surveys
  $results = mysqli_query($con, "SELECT * FROM survey");
  $count =0;
  while ($row = mysqli_fetch_array($results)) { 
    $count = $count +1;
    ?>
    <tr>
      <th scope="row"><?php echo $count; ?></th>
      <td><?php echo $row['user_name']; ?></td>
      <td><?php echo $row['subject']; ?></td>
      <td><?php echo $row['opinion']; ?></td>
    </tr>
    <?php } ?>
  </tbody>
</table>