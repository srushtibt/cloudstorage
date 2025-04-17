<?php
ob_start(); // Prevents "headers already sent" errors
include 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="HandheldFriendly" content="true">
    <title>Register</title>
    <style type="text/css">
        .header_div {
            background-color: green;
            width: 100%;
            height: 90px;
        }

        #log_div {
            width: auto;
            margin: auto;
            background-color: white;
            margin-top: 10%;
            padding: 20px;
            text-align: center;
        }

        h3 {
            color: black;
        }

        input[type="text"],
        input[type="password"] {
            height: 25px;
            width: 300px;
            border-radius: 4px;
            border-width: 1px;
        }

        input[type="submit"] {
            width: 150px;
            height: 40px;
            border-radius: 5px;
            background-color: blue;
            border-width: 1px;
            color: white;
        }

        #img {
            height: 70px;
            width: 70px;
        }
    </style>
</head>

<body>
    <div id="log_div">
        <center>
            <div>
                <form method="post">
                    <table>
                        <tr>
                            <td colspan="2" style="text-align:center;"><img id="img" src="images/user.png"></td>
                        </tr>
                        <tr><td><h3>Username</h3></td></tr>
                        <tr><td><input type="text" name="ru" required></td></tr>
                        
                        <tr><td><h3>Password</h3></td></tr>
                        <tr><td><input type="password" name="rp" required></td></tr>
                        
                        <tr><td><h3>Directory Name</h3></td></tr>
                        <tr><td><input type="text" name="rdir" required></td></tr>

                        <tr>
                            <td colspan="2" style="text-align:center;"><br>
                                <input name="opn_acc" type="submit" value="Open Account">
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </center>
    </div>
    <div class="footer_div"></div>
</body>
</html>

<?php
if (isset($_POST['opn_acc'])) {
    $reg_u = trim($_POST['ru']);
    $reg_p = trim($_POST['rp']);
    $reg_dir = trim($_POST['rdir']);
    $type = "user";

    if (empty($reg_u) || empty($reg_p) || empty($reg_dir)) {
        echo '<script>alert("All fields are required.");</script>';
    } else {
        // Use /tmp directory on Render since only it is writable
        $base_path = "/tmp/admin_database";
        $dir_path = $base_path . "/" . $reg_dir;

        // Ensure base directory exists
        if (!file_exists($base_path)) {
            mkdir($base_path, 0755, true);
        }

        // Check if specific user directory exists
        if (!file_exists($dir_path)) {
            // Hash the password securely
            $hashed_pass = password_hash($reg_p, PASSWORD_DEFAULT);

            // Insert user into database
            $stmt = mysqli_prepare($connection, "INSERT INTO user (user, pass, database_name, type) VALUES (?, ?, ?, ?)");
            mysqli_stmt_bind_param($stmt, "ssss", $reg_u, $hashed_pass, $reg_dir, $type);
            mysqli_stmt_execute($stmt);

            // Create user directory
            mkdir($dir_path, 0755, true);

            // Create index.php in user directory
            $security_path = $dir_path . "/index.php";
            $handle = fopen($security_path, 'w');
            if ($handle) {
                fwrite($handle, "<?php // Silence is golden ?>");
                fclose($handle);
            }

            // Redirect back to login
            header("Location: index.php");
            exit();
        } else {
            echo '<script>alert("Directory already exists. Choose a different name.");</script>';
        }
    }
}
ob_end_flush();
?>
