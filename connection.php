<?php 
$connection = mysqli_connect("db", "root", "root", "data");

// Optional: basic error check
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
