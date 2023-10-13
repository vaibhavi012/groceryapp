<?php
    //get all the values from session and from cartform
    session_start();
    if(empty($_SESSION))
    {
        header('location:../customersigninform.php');
    }
    $productcode=$_REQUEST["s"];
    $custcode=$_SESSION["code"];
    //insert to cart table
    //open conn
    $conn=new PDO("mysql:host=localhost;dbname=grocerydb","root",null);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    try
    {
        //build the stmt to check
        $stmt=$conn->prepare("delete from cart where prodcode=? and custcode=?");
        $stmt->bindParam(1,$productcode);
        $stmt->bindParam(2,$custcode);
        $stmt->execute();
        $c=$stmt->rowCount();

        if($c==1)
        {
            $msg="Deleted from cart successfully ";
        }
        else
        {
            $msg="failed to delete from cart, retry...,";
        }
    }
    catch(Exception $e)
    {
        $msg="failed to delete from cart, retry...,".$e->getMessage();
    }
?>
<html>
<head>
    <title>Delete from cart</title>
        <?php
            include("headerlink.php");
        ?>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <div class="item">
            <?php
                include('header.php');
            ?>
        </div>
        <div class="item">
            <?php echo $msg;?>
        </div>
    </div>
    <?php
        include('footer.php');
    ?>
</body>
</html>
 
