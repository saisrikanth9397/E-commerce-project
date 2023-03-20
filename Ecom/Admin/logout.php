<?php
//loggout page for admin and distributor
session_unset();
session_destroy();

echo "successfully logged out";

header("location:admin.php");


?>
