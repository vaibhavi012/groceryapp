<?php
    //get all the values from session and from cartform
    session_start();
    if(empty($_SESSION))
    {
        header('location:../customersigninform.php');
    }
    $customercode=$_SESSION["code"];
    $productcode=$_POST["textproductcode"];
    $productname=$_POST["textproductname"];
    $price=$_POST["textprice"];
    $igst=$_POST["textigst"];
    $cgst=$_POST["textcgst"];
    $sgst=$_POST["textsgst"];
    $qty=$_POST["textqty"];
    $amount=$_POST["textamount"];


    //insert to cart table
    //open conn
    $conn=new PDO("mysql:host=localhost;dbname=grocerydb","root",null);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    try
    {
        //build the stmt to check
        $stmt=$conn->prepare("insert into cart(custcode,prodcode,prodname,price,igst,cgst,sgst,qty,amt)values(?,?,?,?,?,?,?,?,?)");
        $stmt->bindParam(1,$customercode);
        $stmt->bindParam(2,$productcode);
        $stmt->bindParam(3,$productname);
        $stmt->bindParam(4,$price);
        $stmt->bindParam(5,$igst);
        $stmt->bindParam(6,$cgst);
        $stmt->bindParam(7,$sgst);
        $stmt->bindParam(8,$qty);
        $stmt->bindParam(9,$amount);
        
        $stmt->execute();
        $c=$stmt->rowCount();

        if($c==1)
        {
            $msg="Added to cart ";
        }
        else
        {
            $msg="failed to add to cart, retry...,";
        }
    }
    catch(Exception $e)
    {
        $msg="failed to add to cart, retry...,".$e->getMessage();
    }
?>
<html>
<head>
    <title>Add product info</title>
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
 
