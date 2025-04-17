<?php
$host = "yamabiko.proxy.rlwy.net";
$username = "root";
$password = "VqGDSftFDKaMgYLFepfLhhWBxYkMoLhs";
$database = "railway";
$port = 43109;

// Create a connection
$connection = mysqli_connect($host, $username, $password, $database, $port);

// Error check
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Optional: Close the connection
// mysqli_close($connection); // Uncomment if you're not doing more DB work in the same script
?>
