<?php include'security.php'; ?>
<?php
include 'connection.php';
$folder_name=trim($_GET["uid"]);
$result=mysqli_query($connection,"SELECT * FROM user WHERE database_name='$folder_name'");
if($row=mysqli_fetch_array($result))
{
    $user_name=$row['user'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="HandheldFriendly" content="true">
    <title>Admin Full Permission</title>
    <style type="text/css">
        button {
            height: 40px;
            width: 40px;
            background: url(images/trash.png);
            background-size: 30px, 30px;
            background-repeat: no-repeat;
            border-color: transparent;
            background-color: transparent;
        }

        img {
            width: 45px;
            height: 45px;
        }

        #logout {
            float: right;
        }

        td {
            text-align: center;
        }

    </style>
    <script src="heart.js"></script>
</head>

<body>
    <table width=100%>
        <tr>
            <td style="text-align:left;">
                <div style="padding:10px;">
                    <font size="5"> Folder Name: <?php echo $folder_name; ?></font> <br>
                    <font size="4"> User: <?php echo $user_name; ?></font>
                </div>
            </td>
            <td>
                
            </td>
        </tr>
    </table>
    <center>
        <h2>File List</h2>
    </center>
    <table border="" width="100%">
        <?php 
    $dir_content=scandir("admin_database/".$folder_name);
    for($i=0;$i<count($dir_content);$i++)
    { 
        if($dir_content[$i]!="." && $dir_content[$i]!=".." && $dir_content[$i]!="index.php")
        {
        ?>
        <tr>
            <td><?php echo $dir_content[$i]; ?></td>
            <td><button onclick="admin_file_delete()"></button></td>
        </tr>

        <?php
        }
    }
    
}
    
    ?>
    </table>
</body>

</html>
