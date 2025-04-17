<?php
ob_start(); // Start output buffering to prevent "headers already sent"
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
    <title>Login</title>
    <style>
        #log_div {
            width: auto;
            margin: auto;
            margin-top: 10%;
            padding: 20px;
            background-color: white;
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
            color: white;
        }

        #img {
            height: 80px;
            width: 80px;
        }

        .login-btn { background-color: #62a26b; }
        .register-btn { background-color: #7486d7; }
    </style>
</head>
<body>
    <div id="log_div">
        <center>
            <form method="post">
                <table>
                    <tr>
                        <td colspan="2"><img id="img" src="images/avatar.png"></td>
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
                        <td><br><input class="login-btn" name="btn" type="submit" value="Login"></td>
                        <td><br><input class="register-btn" name="btn1" type="submit" value="Register User"></td>
                    </tr>
                </table>
            </form>
        </center>
    </div>
</body>
</html>

<?php
if (isset($_POST['btn'])) {
    $user = trim($_POST['u']);
    $pass = trim($_POST['p']);
    $_SESSION['user'] = $user;
    $_SESSION['time'] = time();

    // Prepared statement to fetch user info
    $stmt = mysqli_prepare($connection, "SELECT * FROM user WHERE user = ?");
    mysqli_stmt_bind_param($stmt, "s", $user);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        if (password_verify($pass, $row['pass'])) {
            $_SESSION['database_name'] = $row['database_name'];
            $_SESSION['user'] = $user;
            $_SESSION['active_time'] = time();
            $_SESSION['expire_time'] = $_SESSION['active_time'] + (15 * 60); // 15-minute session
            $type = $row['type'];

            if ($type === "user") {
                header("Location: folder_access.php");
                exit();
            } elseif ($type === "admin") {
                header("Location: admin_panel.php");
                exit();
            }
        } else {
            echo '<script>alert("Incorrect password");</script>';
        }
    } else {
        echo '<script>alert("User not found");</script>';
    }
}

if (isset($_POST['btn1'])) {
    header("Location: reg.php");
    exit();
}

ob_end_flush(); // Send output
?>
