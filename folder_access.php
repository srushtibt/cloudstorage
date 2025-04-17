<?php
ob_start(); // Start output buffering to prevent "headers already sent" errors
session_start(); // Start session before anything else
include 'connection.php'; // Include DB connection

// Check if database_name is set in session
if (!isset($_SESSION['database_name'])) {
    echo '<script>alert("Session expired. Please log in again."); window.location.href="index.php";</script>';
    exit();
}

$your_database = $_SESSION['database_name'];
$folder_dist = "/mnt/data/admin_database/" . $your_database; // Path to persistent volume on Render

// Ensure the directory exists before moving files there
if (!file_exists($folder_dist)) {
    mkdir($folder_dist, 0777, true); // Attempt to create the directory with full permissions
}

if (isset($_POST['upload'])) {
    if ($_FILES['file_to_upload']['size'] != 0) {
        $file = $_FILES['file_to_upload'];
        $file_name = $_FILES['file_to_upload']['name'];
        $file_tmp = $_FILES['file_to_upload']['tmp_name'];

        // Ensure the file extension is allowed
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $allowed_ext = ["jpeg", "jpg", "png", "bmp", "docx", "doc", "pdf", "zip", "rar", "mdb", "sql", "php", "js", "html", "xlsx", "java", "c", "cpp", "txt"];

        if (in_array($file_ext, $allowed_ext)) {
            // Check if the file already exists and delete it
            $dest = $folder_dist . "/" . $file_name;
            if (file_exists($dest)) {
                unlink($dest); // Delete existing file
            }

            // Move the uploaded file to the persistent volume
            if (move_uploaded_file($file_tmp, $dest)) {
                echo '<script>alert("File uploaded successfully!");</script>';
            } else {
                echo '<script>alert("Error uploading file.");</script>';
            }
        } else {
            echo '<script>alert("Invalid file type.");</script>';
        }
    } else {
        echo '<script>alert("No file selected.");</script>';
    }
}

// Fetch and display the list of uploaded files
$user_uploaded_files = scandir($folder_dist); // Get all files from the directory

if ($user_uploaded_files !== false) {
    echo '<div style="width:100%"><table border="1" cellspacing="0" cellpadding="5" style="width:100%;">';
    echo '<tr><th colspan="2">Uploaded Files</th></tr>';

    foreach ($user_uploaded_files as $file) {
        if ($file != '.' && $file != '..' && $file != 'index.php') {
            echo '<tr>';
            echo '<td>' . $file . '</td>';
            echo '<td><a href="' . $folder_dist . '/' . $file . '" download>Download</a></td>';
            echo '</tr>';
        }
    }

    echo '</table></div>';
} else {
    echo '<script>alert("Failed to read the uploaded files directory.");</script>';
}

ob_end_flush(); // End output buffering
?>

