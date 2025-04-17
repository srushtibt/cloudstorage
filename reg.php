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
                            <td colspan="2" style="text-align:center;"><img id="img" src="images//user.png"></td>
                        </tr>
                        <tr>
                            <td>
                                <h3>Username</h3>
                            </td>
                        </tr>
                        <tr>
                            <td><input type=text name="ru"></td>
                        </tr>
                        <tr>
                            <td>
                                <h3>Password</h3>
                            </td>
                        </tr>
                        <tr>
                            <td><input type=password name="rp"></td>
                        </tr>
                        <tr>
                            <td>
                                <h3>Director Name</h3>
                            </td>
                        </tr>
                        <tr>
                            <td><input type=text name="rdir"></td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align:center;"><br><input name="opn_acc" type=submit value="Open Account"></td>

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
    if(isset($_POST['opn_acc']))
    {

        $reg_u=$_POST['ru'];
        $reg_p=$_POST['rp'];
        $reg_dir=$_POST['rdir'];
        $type="user";
         if(!file_exists("admin_database/".$reg_dir))
        {
        mysqli_query($connection,"insert into user values('$reg_u','$reg_p','$reg_dir','$type')");
        mkdir("admin_database/".$reg_dir,0755,true);
       $security_path="admin_database/".trim($reg_dir)."/index.php";
        $handel=fopen($security_path,'w');
        fwrite($handel,"");
        fclose($handel);
        header("location:index.php");
        }
        else{
            echo '<script>alert("Choose different database name");</script>';
        }
}

?>
