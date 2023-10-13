<?php
session_start();

    $conn=new PDO("mysql:host=localhost;dbname=grocerydb","root",null);
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
   
    $msg="";
    $ordernum=$_REQUEST["x"];
    try
    {
        $stmt=$conn->prepare("update orders set status='Delivered' where ordernum=?");
        $stmt->bindParam(1,$ordernum);
        $stmt->execute();
        $c=$stmt->rowCount();
        if($c==1)
        {
            $msg="Order Delivered Update successful";
        }
        else
        {
            $msg="Order Not Delivered Update unsuccessful";
        }
    }
    catch(Exception $e)
    {
        $msg="Error" .$e->getMessage();
        $conn->rollback();
    }
?>
<html>
    <head>
        <title>checkout</title>
        <?php
            include("headerlink.php");
        ?>
    </head>
    <body>
        <?php
            include("header.php");
        ?>
        <?php
            echo $msg;
        ?>
        <?php
            include("footer.php");
        ?>
    </body>
</html>