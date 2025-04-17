<?php include'connection.php' ?>
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
            background-color: white;
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
                            <td colspan="2">
                                <h3>Username</h3>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"><input type=text name="u" value=""></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <h3>Password</h3>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"><input type=password name="p" value=""></td>
                        </tr>
                        <tr>
                            <td><br><input name="btn" type=submit value="Login" style="background-color:#62a26b;"></td>

                            <td><br><input name="btn1" type=submit value="Register User" style="background-color:#7486d7;"></td>
                        </tr>
                    </table>
                </form>
            </div>
        </center>
    </div>
</body>

</html>

<?php 
    
    if(isset($_POST['btn']))
    {
        $type="";
$user=$_POST['u'];
$pass=$_POST['p'];
$_SESSION['user']=$user;
$_SESSION['time']=time();
$result=mysqli_query($connection,"select * from user where user='$user' and pass='$pass'");
if(mysqli_num_rows($result)!=0)
{
    if($row=mysqli_fetch_assoc($result))
    {
        session_start();
        $_SESSION['database_name']=$row['database_name'];
        $_SESSION['user']=$user;
        $_SESSION['active_time']=time();
        $_SESSION['expire_time']=$_SESSION['active_time']+(15*60);
        $type=$row['type'];
    }
    if($type=="user")
    header("location:folder_access.php");
    elseif($type=="admin")
        header("location:admin_panel.php");
}
else
        echo'<script>alert("record not matched")</script>';
    }
if(isset($_POST['btn1']))
{ 
header("location:reg.php");
}

?>
