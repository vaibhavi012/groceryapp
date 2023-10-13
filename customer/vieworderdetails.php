<?php
session_start();
if(empty($_SESSION))
{
    header('location:../customersigninform.php');
}
$ordernum=$_REQUEST["x"];
//set up connection
$conn=new PDO("mysql:host=localhost;dbname=grocerydb","root",null);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//create arrays

$prodcode=array();
$prodname=array();
$price=array();
$igst=array();
$cgst=array();
$sgst=array();
$qty=array();
$amt=array();

//prepere select statemnt
$stmt=$conn->prepare("select orderdetails.ordernum,orderdetails.prodcode,product.prodname,orderdetails.price,product.igst,product.cgst,product.sgst,orderdetails.qty,orderdetails.amt from orderdetails inner join product on orderdetails.prodcode=product.prodcode where orderdetails.ordernum=?");
$stmt->bindParam(1,$ordernum);
$stmt->execute();
$c=$stmt->rowCount();

//push rows into arrays
while($row=$stmt->fetch(PDO::FETCH_ASSOC))
{
    array_push($prodcode,$row["prodcode"]);
    array_push($prodname,$row["prodname"]);
    array_push($price,$row["price"]);
    array_push($igst,$row["igst"]);
    array_push($cgst,$row["cgst"]);
    array_push($sgst,$row["sgst"]);
    array_push($qty,$row["qty"]);
    array_push($amt,$row["amt"]);
}
$conn=null;
?>

<html>
<head>
    <title>View Order Details</title>
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
        <h1>View OrderDetails</h1></br>
        <table class="table" style="font-weight:bold; width:100%;" >
            <tr>
                <td>Order Number</td>
                <td>Product Name</td>
                <td>Price</td>
                <td>IGST</td>
                <td>CGST</td>
                <td>SGST</td>
                <td>Quantity </td>
                <td>Amount </td>
            </tr>
            
            <?php
                $len=count($prodcode);
                
                for($i=0;$i<$len;$i++)
                {
                    echo "<tr>";
                    echo "<td>".$ordernum."</td>";
                    echo "<td>".$prodname[$i]."</td>";
                    echo "<td>".$price[$i]."</td>";
                    echo "<td>".$igst[$i]."</td>";
                    echo "<td>".$cgst[$i]."</td>";
                    echo "<td>".$sgst[$i]."</td>";
                    echo "<td>".$qty[$i]."</td>";
                    echo "<td>".$amt[$i]."</td>";
                    
                    echo "</tr>";
                }
            ?>
        </table>
    </div>
    </div>
    <?php
        include('footer.php');
    ?>
    </body>
</html>
