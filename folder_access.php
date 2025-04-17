<?php include'security.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="HandheldFriendly" content="true">
    <title>Database</title>
</head>
<style type="text/css">
    #file_table {
        width: 100%;
        margin: 0 auto;
        margin-top: 3%;
        padding: 5px;
        border-width: thin;
        border-color: black;
    }

    .file_td {
        padding: 5px;
        text-align: center;
    }

    th {
        font-size: 25px;
    }

    .down {
        width: 30px;
        height: 30px;
        border-radius: 5px;
        border-width: 1px;
        background: url(images/direct-download.png);
        background-size: 30px, 30px;
        background-repeat: no-repeat;
    }

    .dlt {
        width: 35px;
        height: 35px;
        border-radius: 5px;
        border-width: 1px;
        background: url(images/trash.png);
        background-size: 30px, 30px;
        background-repeat: no-repeat;
        background-color: transparent;
        border-color: transparent;
    }

    .cpy {
        width: 35px;
        height: 35px;
        border-radius: 5px;
        border-width: 1px;
        background: url(images/copy.png);
        background-size: 30px, 30px;
        background-repeat: no-repeat;
        background-color: transparent;
        border-color: transparent;
    }

    button:hover {
        cursor: pointer;
    }

    input[type="submit"]:hover {
        cursor: pointer;
    }

    .Up_btn {
        width: 70px;
        height: 30px;
        background-color: #00bc28;
        border-radius: 5px;
        border-width: 1px;
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

    h4 {
        color: green;
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

</style>
<script src="heart.js"></script>

<body>
    <div>
        <h2>
            <font color="red" face="Century Schoolbook">Cloud Storage</font>
            <div style="float:right;">
                <form method="post" action="log_btn_activity.php">
                    <input type="submit" class="log_btn" id="img" name="log_btn" value="">
                </form>
            </div>
        </h2>
    </div><br>
    <div style="margin-top:-60px;">
        <h5>Don't forget to logout your database after use.Your data is precious to us.</h5>
    </div>

    <div style="float: right; padding:20px;">
        <h4>Upload your file to database</h4>
        <form method="post" action="?" enctype="multipart/form-data">
            <input type=file name="file_to_upload">&nbsp;
            <input type=submit value="Upload" name="upload" class="Up_btn">
        </form>
    </div>
</body>

</html>
<?php
  $your_database=$_SESSION['database_name'];
     $folder_dist="admin_database/".$your_database;// user folder location

$_SESSION["database_loc"]=$folder_dist;
if(isset($_POST['upload']))
{
     if($_FILES['file_to_upload']['size'] != 0)
        {
    
    $file=$_FILES['file_to_upload'];
    $file_name=$_FILES['file_to_upload']['name'];
    $file_type=$_FILES['file_to_upload']['type'];
    $file_tmp=$_FILES['file_to_upload']['tmp_name'];
    $file_size=$_FILES['file_to_upload']['size'];
    //explode used to splot a string from delimeter
    //explode('.',$file_name) it is a array of spleted statement
    $file_extenton=explode('.',$file_name);
    $dest="admin_database/".$your_database."/".$file_name;
    //print_r($file); //printin array
   
    
    //fetching extention o is name and 1 is extention
    $file_ext= strtolower($file_extenton[1]);
    $require_ext=array("jpeg","jpg","png","bmp","docx","doc","pdf","zip","rar","mdb","sql","php","js","html","xlsx","java","c","cpp","txt");
    for($i=0;$i<count($require_ext);$i++)
    {
        if($require_ext[$i]==$file_ext)
        {
            if(file_exists($dest))
                unlink($dest);
                move_uploaded_file($file_tmp,$dest);echo '<script>
    alert("Uploded Sucessfully");
</script>';
        }
        
    }
        }
    else
    {
        echo'<script>alert("No file choosen...");</script>';
    }
    
    
}

$user_uploaded_files=scandir($folder_dist); // take all files from directory from an array
?>

<div style="width:100%">

    <table id="file_table" border="1px;">
        <tr>
            <th colspan="2">Files</th>
        </tr>
        <?php 
       for($a=0;$a<count($user_uploaded_files);$a++)
       {
           if($user_uploaded_files[$a]!='.' && $user_uploaded_files[$a]!='..' && $user_uploaded_files[$a]!='index.php')
           {
        echo '
        <tr>
            <td class="file_td" id="file_td'.$a.'"> '.$user_uploaded_files[$a].'</td>

            <td class="file_td">
<table width=100%>

<tr><td>
              <button id='.$a.' onclick="download_btn_press(this.id)" class="down"></button>
              </td><td>
              <button  id='.$a.' onclick="dlt_btn_press(this.id)" class="dlt"></button>
              </td><td>
              <button id='.$a.' onclick="cpy_btn_press(this.id)" class="cpy"></button></td></tr>
</table>
        </td>
        </tr>';

        }
       };

        ?>
    </table>

</div>
