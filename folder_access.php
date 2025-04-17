<?php
ob_start(); // Start output buffering to prevent "headers already sent" errors
session_start(); // Start session before anything else
include 'connection.php'; // Include DB connection
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="HandheldFriendly" content="true">
    <title>Upload File</title>
    <style type="text/css">
        .Up_btn {
            width: 70px;
            height: 30px;
            background-color: #00bc28;
            border-radius: 5px;
            border-width: 1px;
        }
    </style>
</head>
<body>

<div style="margin-top:20px;">
    <h4>Upload your file to database</h4>
    <form method="post" action="?" enctype="multipart/form-data">
        <input type="file" name="file_to_upload" required>&nbsp;
        <input type="submit" value="Upload" name="upload" class="Up_btn">
    </form>
</div>

<?php
$your_database = $_SESSION['database_name'];
// Set the persistent volume path on Render (e.g., '/mnt/data')
$folder_dist = "/mnt/data/admin_database/" . $your_database; // This is the Render persistent volume directory

$_SESSION["database_loc"] = $folder_dist;

if (isset($_POST['upload'])) {
    if ($_FILES['file_to_upload']['size'] != 0) {
        $file = $_FILES['file_to_upload'];
        $file_name = $_FILES['file_to_upload']['name'];
        $file_type = $_FILES['file_to_upload']['type'];
        $file_tmp = $_FILES['file_to_upload']['tmp_name'];
        $file_size = $_FILES['file_to_upload']['size'];

        // Ensure the file extension is allowed
        $file_extention = explode('.', $file_name);
        $file_ext = strtolower($file_extention[1]);

        // Allowed file extensions
        $allowed_ext = ["jpeg", "jpg", "png", "bmp", "docx", "doc", "pdf", "zip", "rar", "mdb", "sql", "php", "js", "html", "xlsx", "java", "c", "cpp", "txt"];

        if (in_array($file_ext, $allowed_ext)) {
            // Create directory if it doesn't exist
            if (!file_exists($folder_dist)) {
                mkdir($folder_dist, 0777, true); // Create the directory with full permissions
            }

            // Define destination path on the persistent volume
            $dest = $folder_dist . "/" . $file_name;

            // Remove the file if it already exists
            if (file_exists($dest)) {
                unlink($dest);
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

ob_end_flush(); // End output buffering
?>

</body>
</html>
