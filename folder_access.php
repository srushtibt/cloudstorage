<?php
include 'security.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database</title>
    <style>
        #file_table {
            width: 100%;
            margin-top: 3%;
            border-collapse: collapse;
        }

        .file_td {
            padding: 8px;
            text-align: center;
        }

        th {
            font-size: 22px;
        }

        .down, .dlt, .cpy {
            width: 35px;
            height: 35px;
            border: none;
            background-color: transparent;
            background-repeat: no-repeat;
            background-size: contain;
            cursor: pointer;
        }

        .down { background-image: url(images/direct-download.png); }
        .dlt { background-image: url(images/trash.png); }
        .cpy { background-image: url(images/copy.png); }

        .Up_btn {
            width: 100px;
            height: 35px;
            background-color: #00bc28;
            color: white;
            border-radius: 5px;
            border: none;
            cursor: pointer;
        }

        .log_btn {
            height: 40px;
            width: 40px;
            background-image: url(images/iconfinder_exit_17902.ico);
            background-size: contain;
            background-repeat: no-repeat;
            background-color: transparent;
            border: none;
            cursor: pointer;
        }

        h4 {
            color: green;
        }
    </style>
    <script src="heart.js"></script>
</head>
<body>

<div>
    <h2 style="color: red; font-family: Century Schoolbook;">Cloud Storage
        <div style="float:right;">
            <form method="post" action="log_btn_activity.php">
                <input type="submit" class="log_btn" name="log_btn" value="">
            </form>
        </div>
    </h2>
</div>

<div style="margin-top:-20px;">
    <h5>Don't forget to logout after using your database. Your data is precious to us.</h5>
</div>

<div style="float: right; padding: 20px;">
    <h4>Upload your file</h4>
    <form method="post" enctype="multipart/form-data">
        <input type="file" name="file_to_upload" required>
        <input type="submit" value="Upload" name="upload" class="Up_btn">
    </form>
</div>

<?php
$your_database = $_SESSION['database_name'];
$folder_dist = "admin_database/" . $your_database;
$_SESSION["database_loc"] = $folder_dist;

if (isset($_POST['upload'])) {
    if ($_FILES['file_to_upload']['size'] != 0) {
        $file = $_FILES['file_to_upload'];
        $file_name = $file['name'];
        $file_tmp = $file['tmp_name'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $dest = $folder_dist . "/" . $file_name;

        $allowed_ext = ["jpeg", "jpg", "png", "bmp", "docx", "doc", "pdf", "zip", "rar", "mdb", "sql", "php", "js", "html", "xlsx", "java", "c", "cpp", "txt"];

        if (in_array($file_ext, $allowed_ext)) {
            if (!is_dir($folder_dist)) {
                mkdir($folder_dist, 0755, true);
            }

            if (file_exists($dest)) {
                unlink($dest);
            }

            move_uploaded_file($file_tmp, $dest);
            echo '<script>alert("Uploaded Successfully");</script>';
        } else {
            echo '<script>alert("File type not allowed.");</script>';
        }
    } else {
        echo '<script>alert("No file chosen.");</script>';
    }
}

$uploaded_files = is_dir($folder_dist) ? scandir($folder_dist) : [];
?>

<div style="width: 100%;">
    <table id="file_table" border="1">
        <tr><th colspan="2">Files</th></tr>
        <?php
        foreach ($uploaded_files as $index => $file) {
            if (!in_array($file, ['.', '..', 'index.php'])) {
                echo "
                <tr>
                    <td class='file_td' id='file_td$index'>$file</td>
                    <td class='file_td'>
                        <table width='100%'>
                            <tr>
                                <td><button id='$index' onclick='download_btn_press(this.id)' class='down'></button></td>
                                <td><button id='$index' onclick='dlt_btn_press(this.id)' class='dlt'></button></td>
                                <td><button id='$index' onclick='cpy_btn_press(this.id)' class='cpy'></button></td>
                            </tr>
                        </table>
                    </td>
                </tr>";
            }
        }
        ?>
    </table>
</div>

</body>
</html>
