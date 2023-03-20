<?php
//databse connection page
$con = mysqli_connect('localhost','root','','Ecommerce');

if(!$con){
    die(mysqli_error($con));
}


?>