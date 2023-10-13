<?php
    session_start();
    if(empty($_SESSION))
    {
    header('location:../customersigninform.php');
    }

    //get parameter values
    $productcode=$_REQUEST["code"];
    $productname=$_REQUEST["pname"];
    $price=$_REQUEST["price"];
    $igst=$_REQUEST["igst"];
    $cgst=$_REQUEST["cgst"];
    $sgst=$_REQUEST["sgst"];
    $stock=$_REQUEST["stock"];
?>
<html>
<head>
    <title>View Categories</title>
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
        <h1>Add to cart</h1></br>
        <form method="POST" action="addtocart.php">
        <table class="table" style="font-weight:bold; width:100%;" >
            <tr>
                <td>product code</td>
                <td><input type="text" name="textproductcode" value=<?php echo $productcode;?>  readonly /></td>
            </tr>
            <tr>
                <td>product name</td>
                <td><input type="text" name="textproductname" value="<?php echo $productname;?>" readonly /></td>
            </tr> 
            <tr>
                <td>price</td>
                <td><input type="text" name="textprice" id="textprice" value="<?php echo $price;?>" readonly /></td>
            </tr>
            <tr>
                <td>IGST</td>
                <td><input type="text" name="textigst" id="textigst" value="<?php echo $igst;?>" readonly /></td>
            </tr>
            <tr>
                <td>CGST</td>
                <td><input type="text" name="textcgst" id="textcgst" value="<?php echo $cgst;?>" readonly /></td>
            </tr>
            <tr>
                <td>SGST</td>
                <td><input type="text" name="textsgst" id="textsgst" value="<?php echo $sgst;?>" readonly /></td>
            </tr>
            <tr>
                <td>qty</td>
                <td><input type="number" name="textqty" id="textqty" max="<?php echo $stock;?>" onblur="computerAmount()" required autofocus/></td>
            </tr>
            <tr>
                <td>amount</td>
                <td><input type="text" name="textamount" id="textamount" readonly/></td>
            </tr>
            <tr>
                <td><input type="submit"  class="btn btn-success" value="add to cart"/></td>
            </tr>
        </table>
        </form>
    </div>
    </div>
<script>
    function computerAmount()
    {  
        var qty=document.getElementById("textqty").value;
        var price=document.getElementById("textprice").value;
        var igst=document.getElementById("textigst").value;
        var cgst=document.getElementById("textcgst").value;
        var sgst=document.getElementById("textsgst").value;
        var amount=qty*price;
        var i=amount*igst/100;
        var c=amount*cgst/100;
        var s=amount*sgst/100;
        amount+=i+c+s;
        document.getElementById("textamount").value=amount;
    }
</script>
    <?php
        include('footer.php');
    ?>
</body>
</html>