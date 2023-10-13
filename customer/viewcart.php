<?php
session_start();
if(empty($_SESSION))
{
    header('location:../customersigninform.php');
}

//set up connection
$conn=new PDO("mysql:host=localhost;dbname=grocerydb","root",null);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//create arrays

$custcode=array();
$imgname=array();
$amt=array();
$price=array();
$igst=array();
$cgst=array();
$sgst=array();
$qty=array();
$boxsize=array();
$boxdesc=array();
$brand=array();
$prodname=array();
$prodcode=array();
$packingtype=array();


//prepere select statemnt
$stmt=$conn->prepare("select cart.prodcode,custcode,cart.prodname,cart.price,cart.igst,cart.cgst,cart.sgst,qty,amt,boxsize,boxdesc,packtype,brand,
stock,imgname from cart inner join product on cart.prodcode=product.prodcode where custcode=?");
$stmt->bindParam(1,$_SESSION["code"]);
$stmt->execute();
$c=$stmt->rowCount();

//push rows into arrays
while($row=$stmt->fetch(PDO::FETCH_ASSOC))
{
    array_push($custcode,$row["custcode"]);
    array_push($imgname,$row["imgname"]);
    array_push($amt,$row["amt"]);
    array_push($price,$row["price"]);
    array_push($igst,$row["igst"]);
    array_push($cgst,$row["cgst"]);
    array_push($sgst,$row["sgst"]);
    array_push($qty,$row["qty"]);
    array_push($boxsize,$row["boxsize"]);
    array_push($boxdesc,$row["boxdesc"]);
    array_push($brand,$row["brand"]);
    array_push($prodname,$row["prodname"]);
    array_push($prodcode,$row["prodcode"]);
    array_push($packingtype,$row["packtype"]);
}
$conn=null;
?>

<html>
<head>
    <title>View cart detail</title>
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
        <h1>Cart List</h1></br>
        <table class="table" style="font-weight:bold; width:100%;" >
            <tr>
                <td>Customer Code</td>
                <td>Image</td>
                <td>Amount</td>
                <td>Price</td>
                <td>IGST</td>
                <td>CGST</td>
                <td>SGST</td>
                <td>Quantity</td>
                <td>Box Size</td>
                <td>Box Description</td>
                <td>Brand</td>
                <td>Product Name</td>
                <td>Product Code</td>
                <td>Packing Type</td>
                <td>Delete product</td>
            </tr>
        
            <?php
                $len=count($custcode);
                if(count($prodcode)>0)
                {
                    for($i=0;$i<$len;$i++)
                    {
                        echo "<tr>";
                        echo "<td>".$custcode[$i]."</td>";
                        echo "<td><img src=".$imgname[$i]." height=100 width=100/></td>";
                        echo "<td>".$amt[$i]."</td>";
                        echo "<td>".$price[$i]."</td>";
                        echo "<td>".$igst[$i]."</td>";
                        echo "<td>".$cgst[$i]."</td>";
                        echo "<td>".$sgst[$i]."</td>";
                        echo "<td>".$qty[$i]."</td>";
                        echo "<td>".$boxsize[$i]."</td>";
                        echo "<td>".$boxdesc[$i]."</td>";
                        echo "<td>".$brand[$i]."</td>";
                        echo "<td>".$prodname[$i]."</td>";
                        echo "<td>".$prodcode[$i]."</td>";
                        echo "<td>".$packingtype[$i]."</td>";
                        echo "<td><a href=deletefromcart.php?s=$prodcode[$i]>"."Delete"."</a></td>";
                        echo "</tr>";
                    }
            ?>
        </table>
         <form method="POST" action="checkout.php">
            <input type="checkbox" name="chkdelivery" /><span style="padding-left:25px;">Transport Needed</span><br>   
            <input type="checkbox" name="chklabour" /><span style="padding-left:25px;">Labour Needed</span><br>   
            <input type="submit" class="btn btn-success" value="Checkout"/>
        </form>
        <?php
            }
            else
            {
                echo "Cart is empty";
            }
        ?>
    </div>
    </div>
    <?php
        include('footer.php');
    ?>
    </body>
</html>
