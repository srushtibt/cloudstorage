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

// SQL to create the 'user' table if it doesn't exist
$table_create_query = "
CREATE TABLE IF NOT EXISTS `user` (
  `user` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `database_name` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  PRIMARY KEY (`database_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
";

// Execute the query
mysqli_query($connection, $table_create_query);

// Optional: Close the connection
// mysqli_close($connection); // Uncomment if you're not doing more DB work in the same script
?>
