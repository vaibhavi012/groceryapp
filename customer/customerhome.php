<?php
    session_start();
    if(empty($_SESSION))
    {
        header('location:../customersigninform.php');
    }
    $email=$_SESSION["email"];
?>
<html>
    <head>
        <?php
            include("headerlink.php");
        ?>
        <title>
            Customer home
        </title>   
    </head>
    <body>
        <?php
            include('customerheader.php');
        ?>
        <h3>Welcome <?php echo $email;?></h3>
        <?php
            include('customerfooter.php');
        ?>
    </body>
</html>