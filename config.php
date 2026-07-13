<?php
// ⚠️ Replace these with your real InfinityFree database credentials
// Found in: InfinityFree Control Panel → MySQL Databases

$host    = "sqlXXX.infinityfree.com"; // your MySQL hostname
$db_user = "epiz_XXXXXXXX";           // your database username
$db_pass = "your_database_password";  // your database password
$db_name = "epiz_XXXXXXXX_dbname";    // your database name

$conn = mysqli_connect($host, $db_user, $db_pass, $db_name);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
