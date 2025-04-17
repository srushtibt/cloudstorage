
<?php
$connection = mysqli_connect("mysql.railway.app", "root", "VqGDSftFDKaMgYLFepfLhhWBxYkMoLhs", "railway");

// Optional: basic error check
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
