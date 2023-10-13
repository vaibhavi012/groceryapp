<?php
session_start();
if(empty($_SESSION))
{
    header('location:../adminsigninform.php');
}
//fetch posted data
$productcode=$_POST["textproductcode"];
$productname=$_POST["textproductname"];
$brand=$_POST["textbrand"];
$price=$_POST["textprice"];
$igst=$_POST["textigst"];
$cgst=$_POST["textcgst"];
$sgst=$_POST["textsgst"];
$stock=$_POST["textstock"];
$newprice=$_POST["textnewprice"];
$newstock=$_POST["textnewstock"];
$boxsize=$_POST["textboxsize"];
$boxdesc=$_POST["textboxdesc"];
if($stock==0)
{
    $stock=$newstock;
}
else{
    $stock=$stock+$newstock;
}
$msg=null;
try
{
    $conn=new PDO("mysql:host=localhost;dbname=grocerydb","root",null);
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $stmt=$conn->prepare("update product set prodname=?,brand=?,stock=?,price=?,igst=?,cgst=?,sgst=?,boxsize=?,boxdesc=? where prodcode=?");
    $stmt->bindParam(1,$productname);
    $stmt->bindParam(2,$brand);
    $stmt->bindParam(3,$stock);
    $stmt->bindParam(4,$newprice);
    $stmt->bindParam(5,$igst);
    $stmt->bindParam(6,$cgst);
    $stmt->bindParam(7,$sgst);
    $stmt->bindParam(8,$boxsize);
    $stmt->bindParam(9,$boxdesc);
    $stmt->bindParam(10,$productcode);
    $stmt->execute();
    $c=$stmt->rowCount();
    if($c==1)
    {
        $msg="product update done";
    }
    else
    {
        $msg="product update failed";
    }
}
catch(Exception $e)
{
    $msg="product update failed".$e->getMessage();
}
//4.clos ethe connection to datebase
finally
{    
    $conn=null;
}
?>
<html>
    <head>
        <title>view product</title>
        <?php
            include("headerlink.php");
        ?>
        <link rel="stylesheet" href="styless.css">
    </head>
    <body>
        <div class="container">
            <div class="item">
            <?php
                include('header.php');
            ?>
        </div>
        <div class="item">
            <h4><?php echo $msg; ?></h4>
        </div>
        </div>
        <?php
            include('footer.php');
        ?>
    </body>
</html>


  