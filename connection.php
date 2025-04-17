<?php 
$connection = mysqli_connect("db", "root", "root", "data");

// Optional: basic error check
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// SQL to create the table if it doesn't already exist
$table_create_query = "
CREATE TABLE IF NOT EXISTS `user` (
  `user` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `database_name` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  PRIMARY KEY (`database_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
";

// Run the query to create the table
if (mysqli_query($connection, $table_create_query)) {
    echo "Table 'user' created or already exists.";
} else {
    echo "Error creating table: " . mysqli_error($connection);
}

// SQL to insert data into the table
$insert_data_query = "
INSERT INTO `user` (`user`, `pass`, `database_name`, `type`) 
VALUES ('admin', 'admin', 'admin_database', 'admin')
ON DUPLICATE KEY UPDATE 
    `user` = VALUES(`user`), 
    `pass` = VALUES(`pass`), 
    `type` = VALUES(`type`);
";

// Run the query to insert data
if (mysqli_query($connection, $insert_data_query)) {
    echo "Data inserted or updated successfully.";
} else {
    echo "Error inserting data: " . mysqli_error($connection);
}

// Close the connection
mysqli_close($connection);
?>
