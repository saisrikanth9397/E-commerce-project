
<!--
  displaying items for the particular order
-->
<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Order ID</th>
      <th scope="col">Product Name</th>
      <th scope="col">Quantity</th>
      <th scope="col">Total Price in $</th>
    </tr>
  </thead>
  <tbody>
  <?php 
  $results = mysqli_query($con, "SELECT * FROM order_line where order_id = {$_GET['orderid']}");
  $count =0;
  while ($row = mysqli_fetch_array($results)) { 
    $count = $count +1;
    ?>
    <tr>
      <th scope="row"><?php echo $count; ?></th>
      <td><?php echo $row['order_id']; ?></td>
      <td><?php echo $row['product_name']; ?></td>
      <td><?php echo $row['quantity']; ?></td>
      <td><?php echo $row['total_price']; ?></td>
    </tr>
    <?php } ?>
  </tbody>
</table>
