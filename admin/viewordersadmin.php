<?php
session_start();
if(empty($_SESSION))
{
    header('location:../adminsigninform.php');
}

//set up connection
$conn=new PDO("mysql:host=localhost;dbname=grocerydb","root",null);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//create arrays
$custcode=array();
$firmname=array();
$ordernum=array();
$orderdate=array();
$amt=array();
$shipping=array();
$netamount=array();
$deliveryneeded=array();
$labourneeded=array();
$labour=array();
$status=array();

//prepere select statemnt
$stmt=$conn->prepare("select orders.custcode,firmname,ordernum,orderdate,amt,shipping,netamount,deliveryneeded,labourneeded,labour,status from orders inner join customer on customer.custcode=orders.custcode where status='new'");
$stmt->execute();
$c=$stmt->rowCount();

//push rows into arrays
while($row=$stmt->fetch(PDO::FETCH_ASSOC))
{
    array_push($custcode,$row["custcode"]);
    array_push($firmname,$row["firmname"]);
    array_push($ordernum,$row["ordernum"]);
    array_push($orderdate,$row["orderdate"]);
    array_push($amt,$row["amt"]);
    array_push($shipping,$row["shipping"]);
    array_push($netamount,$row["netamount"]);
    array_push($deliveryneeded,$row["deliveryneeded"]);
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
    <table class="table" style="font-weight:bold; width:100%;" >
        <tr>
            <td>Customer Code (Check Customer Details)</td>
            <td>Firm Name</td>
            <td>Order Number (Check Order Details)</td>
            <td>Order Date</td>
            <td>Amount</td>
            <td>Delivery Needed</td>
            
            <td>Shipping Amount</td>
            <td>Labour Needed</td>
            <td>Labour Amount</td>
            <td>Net Amount</td>
            <td>Process </td>
            <td>Status </td>
        </tr>
        
        <?php
        $len=count($custcode);
        
        for($i=0;$i<$len;$i++)
        {
            echo "<tr>";
            echo "<td><a href=viewcustfromordertable.php?x=$custcode[$i]>".$custcode[$i].".  Click here</td>";
            echo "<td>" .$firmname[$i]."</td>";
            echo "<td><a href=vieworderdetailsadmin.php?x=$ordernum[$i]>".$ordernum[$i].".  Click here</td>";
            echo "<td>".$orderdate[$i]."</td>";
            echo "<td>".$amt[$i]."</td>";
           
            if ($deliveryneeded[$i]=="Yes")
                echo "<td><a href=updateshippingform.php?s=$ordernum[$i]>".$deliveryneeded[$i]."</a></td>";
            else
                echo "<td>No</td>";
            echo "<td>".$shipping[$i]."</td>";

            
            if($labourneeded[$i]=="Yes")
                echo "<td><a href=updatelabourform.php?s=$ordernum[$i]>".$labourneeded[$i]."</a></td>";
            else
            echo "<td>No</td>";

            echo "<td>".$labour[$i]."</td>";
            echo "<td>".$netamount[$i]."</td>";
            echo "<td><a href=process.php?x=$ordernum[$i]>".$ordernum[$i]."</td>";
            echo "<td>".$status[$i]."</td>";
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
