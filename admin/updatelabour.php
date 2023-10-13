<?php
//set up connection
$conn=new PDO("mysql:host=localhost;dbname=grocerydb","root",null);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$msg="";
$ordernum=$_POST["textordernum"];
$labour=$_POST["textlabour"];
$amount=$labour;
//prepere select statemnt
try
{
    $stmt=$conn->prepare("update orders set labour=?,netamount=netamount+? where ordernum=?");
    $stmt->bindParam(1,$labour);
    $stmt->bindParam(2,$amount);
    $stmt->bindParam(3,$ordernum);
    $stmt->execute();
    $c=$stmt->rowCount();
    if($c>0)
    {
        $msg="Updated successfuly";
    }
    else
    {
        $msg="Update failed";
    }
}

catch(Exception $e)
{
    $msg="Error" .$e->getMessage();
}
finally
{
    $conn=null;
}
?>

<html>
    <head>
        <title>labour charge</title>
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