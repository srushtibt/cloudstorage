<?Php 
        if(isset($_POST['log_btn']))
        {
            session_start();
            session_destroy();
            header("location:logout.php");
        }
?>
