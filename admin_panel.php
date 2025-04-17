<?php include'security.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="HandheldFriendly" content="true">
    <title>Admin Panel</title>
</head>
<style type="text/css">
    #admin_welcome {
        width: auto;
        color: coral;
    }

    img {
        height: 50px;
        width: 50px;
    }

    #box {
        display: inline-block;
        word-wrap: break-word;
        padding-left: 30px;
    }

    .log_btn {
        height: 50px;
        width: 50px;
        background-image: url(images/iconfinder_exit_17902.ico);
        background-size: 40px, 40px;
        background-repeat: no-repeat;
        background-color: transparent;
        border-color: transparent;
    }

    #logout {
        float: right;
    }

</style>
<script src="heart.js"></script>

<body>
    <table width="100%">
        <tr>
            <td>
                <div id="admin_welcome">
                    <h1>Welcome Admin</h1>
                </div>
            </td>
            <td>
                <div id="logout">
                    <form method="post" action="log_btn_activity.php"><input type="submit" class="log_btn" name="log_btn" value=""></form>
                </div>
            </td>
        </tr>
    </table>
    <div id="box">
        <?php
$admin_dir_array=scandir("admin_database");

for($a=0;$a<count($admin_dir_array);$a++)
{ 
    if($admin_dir_array[$a]!='.' && $admin_dir_array[$a]!='..' && $admin_dir_array[$a]!='index.php' ) 
    { 
       ?>
        <div style="float:left;">
            <table width="100px">
                <tr>
                    <td><img src=" images/folder.png" id="<?php echo $a ?>" onclick="on_user_folder_click(this.id)"></td>
                </tr>
                <tr>
                    <td id="folder<?php echo $a ?>"><?php echo $admin_dir_array[$a]; ?></td>
                </tr>
            </table>
        </div>
        <?php
    }
    
}
?>
    </div>
</body>

</html>
