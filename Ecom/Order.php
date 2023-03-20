<?php
include
    ('includes/conn.php');
//order confirmation page for the user

if (isset($_POST['neworder'])) {

    session_start();
    $payment = $_POST['paymentmethod'];
    $address = $_POST['address'];
    $cartid = $_GET['ucartid']; 
    $totalprice = $_GET['tprice'];
    $userid = $_SESSION['username'];
    date_default_timezone_set('America/Chicago');
    $datetime = date('m/d/Y h:i:s a', time());
    $datetime1 = date('m/d/Y h:i', time());

    echo $datetime1;
    $sql2 = "Select * from `cart_item` where cart_id = '$cartid'";
    $records1 = mysqli_query($con, $sql2);

    $records = mysqli_num_rows($records1);

    if ($records > 0) {

        //inserting the order into orders table
        $sql = "INSERT INTO `orders`( `user_id`, `order_date`, `payment`, `address`, `total_price`, `order_status`) VALUES ('$userid','$datetime','$payment','$address',$totalprice,'accepted')";

        if (mysqli_query($con, $sql)) {
            echo " order inserted successfully.";
        } else {
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);

        }

        //getting inserted order to insert order_line that is each product in the order.

        $sql33 = "SELECT * FROM `orders` WHERE order_date like '$datetime1%' order by order_date DESC LIMIT 1";
        $records33 = mysqli_query($con, $sql33);

        $results33 = mysqli_num_rows($records33);

        if ($results33 > 0) {
            $orderid = 0;
            while ($row11 = mysqli_fetch_assoc($records33)) {
                $orderid = $row11['order_id'];
            }
            //deleting all the cart items before inserting in the order_line
            while ($row11 = mysqli_fetch_assoc($records1)) {

                $cartitemid = $row11['cart_item_id'];

                $delprod = "delete from cart_item where cart_item_id = $cartitemid";

                if (mysqli_query($con, $delprod)) {

                    // echo "Product removed successfully";
                } else {
                    echo "Error deleting record: " . mysqli_error($con);
                }

                $productid = $row11['product_id'];
                //getting product id for each product in cart item
                $sql44 = "SELECT * FROM `product` WHERE Product_id = $productid";
                $records44 = mysqli_query($con, $sql44);

                $results44 = mysqli_num_rows($records44);

                while ($row111 = mysqli_fetch_assoc($records44)) {
                    $quantity = $row11['quantity'];
                    $price = $row111['Price']*$quantity;
                    $prodname = $row111['Product_name'];
                }

                //inserting into order_line
                $sql = "INSERT INTO `order_line`(`order_id`, `product_name`, `quantity`, `total_price`, `product_id`) VALUES ($orderid,'$prodname',$quantity,$price,$productid)";

                if (mysqli_query($con, $sql)) {
                    echo " orderline inserted successfully.";
                } else {
                    echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);

                }


            }
        }

        header("location:orderplaced.php"); //navigating to the orderplaced page
    } else {
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);

    }
}


?>


<!DOCTYPE html>
<html>

<head>
    <title>shopme</title>

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <!-- font awesome link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
        crossorigin="anonymous"></script>
</head>

<body>


    <nav class="navbar navbar-expand-lg bg-info">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">ShopMe</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>





                </ul>
                <form class="d-flex" role="search" action="index.php" method="GET">
                    <input class="form-control me-2" name="search" type="search" placeholder="Search"
                        aria-label="Search">
                    <button class="btn btn-dark" name="submit" type="submit">Search</button>
                </form>
                <ul class="navbar-nav ">
                    <li class="nav-item">
                        <a class="nav-link" href="cart.php">Cart</a>
                    </li>

                    <?php
                    if (isset($_SESSION['username'])) {





                        echo "
            <li class='nav-item'>
            <a class='nav-link' href='index.php?logout'>Logout</a>
          </li>";


                    } else {

                        echo " <li class='nav-item'>
            <a class='nav-link' href='index.php?signin'>Signin</a>
          </li>";
                        echo "<li class='nav-item'>
          <a class='nav-link' href='index.php?signup'>Signup</a>
        </li>";
                    }
                    ?>



                </ul>
            </div>
        </div>
    </nav>





    <h3 style="text-align: center;">Order confirmation page</h3>

    <form action="" method="post">
        <label>Payment Method</label>
        <select class="form-control" id="sel1" name="paymentmethod">
            <option>Credit card</option>
            <option>Debit Card</option>
            <option>Bank</option>
        </select>
        <br>
        <label for="sel1">Address:</label>
        <input type="text" name="address" class="form-control" aria-label="Sizing example input"
            aria-describedby="inputGroup-sizing-default">
        <br>

        <label for="sel1">Total Price:</label>
        <label for="sel1">
            <?php echo $_GET['tprice']; ?>
        </label>
        <br>
        <br>



        <button type="submit" name="neworder" class="btn btn-primary">Place Order</button>
    </form>


</body>

</html>