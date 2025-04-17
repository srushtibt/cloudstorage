<?php include'security.php'; ?>
<?php
$filename=trim($_GET["uid"]);
$URL="admin_database/".$_SESSION['database_name']."/".$filename; 

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="HandheldFriendly" content="true">
    <title>Wait Please</title>
</head>
<style type="text/css">
    #img_div {
        width: auto;
        margin-top: 5%;
    }

    img {
        height: 25%;
        width: 25%;
    }

    #down_btn {
        width: 150px;
        height: 50px;
        border-radius: 5px;
        border-width: 1px;
        background-color: burlywood;
    }

</style>
<script src="heart.js"></script>

<body>
    <div id="img_div">
        <center>
            <img src="images/cloud-computing.png">
            <h2>Download file</h2>
            <h2 id="file"></h2>
            <a download="<?php echo $filename; ?>" href="<?php echo $URL ?>"><button id="down_btn" onclick="go_page()">Generate & Download</button></a>
        </center>
    </div>
</body>

</html>
