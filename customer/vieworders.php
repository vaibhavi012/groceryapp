<?php
session_start();
if(empty($_SESSION))
{
    header('location:../customersigninform.php');
}
//store custcode  from session
$custcode=$_SESSION["code"];

//set up connection
$conn=new PDO("mysql:host=localhost;dbname=grocerydb","root",null);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//create arrays
$ordernum=array();
$orderdate=array();
$amt=array();

$netamount=array();
$deliveryneeded=array();
$shipping=array();
$labourneeded=array();
$labour=array();
$status=array();

//prepere select statemnt
$stmt=$conn->prepare("select * from orders where custcode=?");
$stmt->bindParam(1,$custcode);
$stmt->execute();
$c=$stmt->rowCount();

//push rows into arrays
while($row=$stmt->fetch(PDO::FETCH_ASSOC))
{
    array_push($ordernum,$row["ordernum"]);
    array_push($orderdate,$row["orderdate"]);
    array_push($amt,$row["amt"]);
   
    array_push($netamount,$row["netamount"]);
    array_push($deliveryneeded,$row["deliveryneeded"]);
    array_push($shipping,$row["shipping"]);
    array_push($labourneeded,$row["labourneeded"]);
    array_push($labour,$row["labour"]);
    array_push($status,$row["status"]);
}
$conn=null;
?>

<html>
<head>
    <title>View Orders</title>
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
    
    <h1>View Orders</h1></br>
    <table class="table" width="1200px" style="font-weight:bold; width:100%;" >
        <tr>
            <td>Order Number</td>
            <td>Order Date</td>
            <td>Amount</td>
            
            <td>Net Amount</td>
            <td>Delivery Needed</td>
            <td>Shipping</td>
            <td>Labour Needed</td>
            <td>Labour</td>
            <td>Status </td>
        </tr>
        
        <?php
            $len=count($ordernum);
            if(count($ordernum)>0)
            {
                for($i=0;$i<$len;$i++)
                {
                echo "<tr>";
                echo "<td><a href=vieworderdetails.php?x=$ordernum[$i]>".$ordernum[$i].".  Click here</br>(Check Order Detail)</td>";
                echo "<td>".$orderdate[$i]."</td>";
                echo "<td>".$amt[$i]."</td>";
                
                echo "<td>".$netamount[$i]."</td>";
                echo "<td>".$deliveryneeded[$i]."</td>";
                echo "<td>".$shipping[$i]."</td>";
                echo "<td>".$labourneeded[$i]."</td>";
                echo "<td>".$labour[$i]."</td>";
                echo "<td>".$status[$i]."</td>";
                
                echo "</tr>";
                }
        ?>
    </table>   
        <?php
            }
            else
            {
                echo "No orders";
            }
        ?>        
    </div>
    </div>
    <?php
        include('footer.php');
    ?>
    </body>
</html>
