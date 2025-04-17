<?php include'security.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="HandheldFriendly" content="true">
    <title>Delete Confirmation</title>
</head>
<style type="text/css">
    #img_div {
        width: auto;
        margin-top: 5%;
    }

    img {
        height: 20%;
        width: 25%;
    }

    input[type="submit"] {
        width: 150px;
        height: 50px;
        border-radius: 5px;
        border-width: 1px;
        background-color: burlywood;
    }

    h5 {
        color: red;
    }

</style>

<body>
    <div id="img_div">
        <center>
            <img src="images/remove.png">
            <h2>Delete File</h2>
            <h2 id="file"></h2>
            <form method="post">
                <input type="hidden" id="hide" name="dlt_file_name">
                <input type="submit" name="dlt_btn" value="Delete">
            </form>
            <h5>You are going to delete your file from Cloud.You can't undo this operation</h5>
        </center>
    </div>
    <script>
        document.getElementById("hide").value = localStorage.getItem("dlt_data");
        document.getElementById("file").innerHTML = localStorage.getItem("dlt_data");

    </script>
</body>

</html>
<?php 
if(isset($_POST["dlt_btn"]))
{
    session_start();
    $file_name=trim($_POST['dlt_file_name']);
    $data_loc=trim($_SESSION["database_loc"]);
    $full_location=$data_loc."/".$file_name;
    unlink($full_location);
   header("location:folder_access.php");
}


?>
