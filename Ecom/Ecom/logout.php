<?php
//destroying session if the user loggs out
session_unset();
session_destroy();

echo "successfully logged out";

header("location:index.php");


?>
