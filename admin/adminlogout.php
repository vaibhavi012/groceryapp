<?php
    session_start();
    if(empty($_SESSION))
        {
            header('location:../adminsigninform.php');
        }
    session_destroy();
    header('location:../loginhome.php');
?>