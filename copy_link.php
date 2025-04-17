<?php include'security.php'; ?>
<?php 
$file=trim($_GET["uid"]);
$URL="http://ser00.rf.gd/admin_database/".$_SESSION['database_name']."/".$file;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="HandheldFriendly" content="true">
    <title>Copy Link</title>
    <style type="text/css">
        img {
            height: 60px;
            width: 60px;
        }

        #img1 {
            height: 30px;
            width: 30px;
        }

        #div_info {
            position: absolute;
            bottom: 0;
        }

        h5 {
            position: absolute;
            bottom: 50px;
            text-align: center;
            padding: 10px;
        }

        #info {
            padding-right: 10px;
        }

        input[type="text"] {
            width: 50%;
            height: 25px;
            border-radius: 5px;
            border-width: 1px;
            text-align: center;
        }

    </style>
</head>

<body>
    <center>
        <div id="info">
            <h1><img src="images/database.png">Cloud Storage</h1>
            <div style="margin:0 auto; position:relative; top:100px;">
                <h4>Copy this link for share file: </h4><br>
                <form method="post">
                    <input type="text" id="link" name="link_to_copy" value="<?php echo $URL; ?>" readonly>
                </form>
            </div>
            <h5>
                <font color="blue">This fill website is made by Soumya Manna for giving FREE & UNLIMITED CLOUD Storage space for you.This ia a fully non-profitable project and hosted in free domain.If you like this project please contribute your coding skill in GITHUB.We want to improve this project and make free storage space for all of INDIANS. Thank You</font>
            </h5>
            <center>
                <div id="div_info">
                    <table>
                        <tr>
                            <td style="text-align:center;"><a href="https://www.facebook.com/soumya.manna.961"><img src="images/facebook-circular-logo.png" id="img1"></a></td>
                            <td style="text-align:center;"><a href="https://github.com/Soumya-Manna-1999"><img src="images/github.png" id="img1"></a></td>
                            <td style="text-align:center;"><a href="mailto:soumyamanna180898@gmail.com?subject = Feedback&body = Message"><img src="images/email.png" id="img1"></a></td>
                        </tr>
                    </table>
                </div>
            </center>
        </div>
    </center>
</body>

</html>
