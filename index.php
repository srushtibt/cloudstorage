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
    <title>Index</title>
    <style type="text/css">
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
            border-width: 1px;
        }

        #img {
            height: 80px;
            width: 80px;
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
                            <td colspan="2" style="text-align:center;"><img id="img" src="images/avatar.png"></td>
                        </tr>
                        <tr>
                            <td colspan="2"><h3>Username</h3></td>
                        </tr>
                        <tr>
                            <td colspan="2"><input type="text" name="u" required></td>
                        </tr>
                        <tr>
                            <td colspan="2"><h3>Password</h3></td>
                        </tr>
                        <tr>
                            <td colspan="2"><input type="password" name="p" required></td>
                        </tr>
                        <tr>
                            <td><br><input name="btn" type="submit" value="Login" style="background-color:#62a26b;"></td>
                            <td><br><input name="btn1" type="submit" value="Register User" style="background-color:#7486d7;"></td>
                        </tr>
                    </table>
                </form>
            </div>
        </center>
    </div>
</body>
</html>

<?php
if (isset($_POST['btn'])) {
    $type = "";
    $user = $_POST['u'];
    $pass = $_POST['p'];

    // Store session user and time regardless of result
    $_SESSION['user'] = $user;
    $_SESSION['time'] = time();

    // Query to find matching user
    $result = mysqli_query($connection, "SELECT * FROM user WHERE user='$user' AND pass='$pass'");
    
    if (mysqli_num_rows($result) != 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['database_name'] = $row['database_name'];
        $_SESSION['user'] = $user;
        $_SESSION['active_time'] = time();
        $_SESSION['expire_time'] = $_SESSION['active_time'] + (15 * 60); // 15 minutes session

        $type = $row['type'];

        // Redirect based on user type
        if ($type == "user") {
            header("Location: folder_access.php");
            exit();
        } elseif ($type == "admin") {
            header("Location: admin_panel.php");
            exit();
        }
    } else {
        echo '<script>alert("Record not matched")</script>';
    }
}

if (isset($_POST['btn1'])) {
    header("Location: reg.php");
    exit();
}

ob_end_flush(); // End output buffering and send output
?>
