<?php
$host = "yamabiko.proxy.rlwy.net";  // Host provided in the URL
$username = "root";  // Username provided in the URL
$password = "VqGDSftFDKaMgYLFepfLhhWBxYkMoLhs";  // Password provided in the URL
$database = "railway";  // Database name provided in the URL
$port = 43109;  // Port provided in the URL

// Create a connection
$connection = mysqli_connect($host, $username, $password, $database, $port);

// Optional: basic error check
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    echo "Successfully connected to the database!";
}
?>
