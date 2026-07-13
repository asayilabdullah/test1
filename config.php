<?php

 
$host    = "sql208.infinityfree.com";
$db_user = "if0_42402844";
$db_pass = "BimET0Jtjkf";
$db_name = "if0_42402844_asayil_db";
 
$conn = mysqli_connect($host, $db_user, $db_pass, $db_name);
 
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
