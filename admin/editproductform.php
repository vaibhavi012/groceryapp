<?php
session_start();
//get catid parameter
if(empty($_SESSION))
{
    header('location:../adminsigninform.php');
}
//fetch url param
$productcode=$_REQUEST["code"];
$productname=urldecode($_REQUEST["name"]);
$price=$_REQUEST["price"];
$igst=$_REQUEST["igst"];
$cgst=$_REQUEST["cgst"];
$sgst=$_REQUEST["sgst"];
$stock=$_REQUEST["stock"];
$brand=urldecode($_REQUEST["brand"]);
$packingtype=$_REQUEST["packingtype"];
$boxsize=urldecode($_REQUEST["boxsize"]);
$boxdesc=urldecode($_REQUEST["boxdesc"]);

?>
<html>
    <head>
        <title>Edit product</title>
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
          <h1>Edit Product</h1></br>
            <form method="POST" action="editproduct.php">
            <table class="table" style="font-weight:bold; width:100%;" >
                <tr>
                    <td>
                        Productcode
                    </td>
                    <td>
                        <input type="text" name="textproductcode" value="<?php echo $productcode;?>" readonly/>

                    </td>
                </tr>
                <tr>
                    <td>
                        Productname
                    </td>
                    <td>
                        <input type="text" name="textproductname" value="<?php echo $productname;?>" readonly/>

                    </td>
                </tr> 
                <tr>
                    <td>
                        Brand
                    </td>
                    <td>
                        <input type="text" name="textbrand"  value="<?php echo $brand;?>" />

                    </td>
                </tr> 
                <tr>
                    <td>
                        Packing Type
                    </td>
                    <td>
                        <input type="text" name="textpackingtype"  value="<?php echo $packingtype;?>" readonly />

                    </td>
                </tr>          
                <tr>
                    <td>
                        Price
                    </td>
                    <td>
                        <input type="text" name="textprice" value="<?php echo $price;?>" readonly />

                    </td>
                </tr>
                <tr>
                    <td>
                        IGST
                    </td>
                    <td>
                        <input type="text" name="textigst"  value="<?php echo $igst;?>" />

                    </td>
                </tr> 
                <tr>
                    <td>
                        CGST
                    </td>
                    <td>
                        <input type="text" name="textcgst"  value="<?php echo $cgst;?>" />

                    </td>
                </tr> 
                <tr>
                    <td>
                        SGST
                    </td>
                    <td>
                        <input type="text" name="textsgst"  value="<?php echo $sgst;?>" />

                    </td>
                </tr> 
                <tr>
                    <td>
                        Stock
                    </td>
                    <td>
                        <input type="text" name="textstock" value="<?php echo $stock;?>" readonly />

                    </td>
                </tr>
                <tr>
                    <td>
                        Box Size
                    </td>
                    <td>
                        <input type="text" name="textboxsize"  value="<?php echo $boxsize;?>" />

                    </td>
                </tr>
                <tr>
                    <td>
                        Box Description
                    </td>
                    <td>
                        <input type="text" name="textboxdesc"  value="<?php echo $boxdesc;?>" />

                    </td>
                </tr>
                <tr>
                    <td>
                        New price
                    </td>
                    <td>
                        <input type="text" name="textnewprice" required/>

                    </td>
                </tr>
                <tr>
                    <td>
                        New stock
                    </td>
                    <td>
                        <input type="text" name="textnewstock" required/>

                    </td>
                </tr>
                
                <tr>
                    <td colspan="2">
                        <input type="submit" class="btn btn-success" value="update"/>
                    </td>
                </tr>
            </table>
            </form>
        </div>
    </div>
    <?php
        include('footer.php');
    ?>
</body>
</html>