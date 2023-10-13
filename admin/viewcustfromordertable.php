<?php
session_start();
if(empty($_SESSION))
{
    header('location:../adminsigninform.php');
}
$custcode_array=$_REQUEST["x"];
//set up connection
$conn=new PDO("mysql:host=localhost;dbname=grocerydb","root",null);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//create arrays

$custcode=array();
$custfname=array();
$custlname=array();
$custfirmname=array();
$custphone=array();
$custemail=array();
$custgstnum=array();
$custaddress=array();
$custcity=array();
$custpin=array();
$balance=array();
//prepere select statemnt
$stmt=$conn->prepare("select * from customer where custcode=?");
$stmt->bindparam(1,$custcode_array);
$stmt->execute();
//push rows into arrays
while($row=$stmt->fetch(PDO::FETCH_ASSOC))
{
    array_push($custcode,$row["custcode"]);
    array_push($custfname,$row["fname"]);
    array_push($custlname,$row["lname"]);
    array_push($custfirmname,$row["firmname"]);
    array_push($custphone,$row["phone"]);
    array_push($custemail,$row["emailid"]);
    array_push($custgstnum,$row["gstnum"]);
    array_push($custaddress,$row["address"]);
    array_push($custcity,$row["city"]);
    array_push($custpin,$row["pincode"]);
    array_push($balance,$row["balance"]);
}
$conn=null;
?>

<html>
<head>
    <title>View customer detail</title>
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
    <h1>Customer Detail</h1></br>
    <table class="table" style="font-weight:bold; width:100%;" >
        <tr>
            <td>Code</td>
            <td>First Name</td>
            <td>Last Name</td>
            <td>Firm Name</td>
            <td>Phone</td>
            <td>Email</td>
            <td>GST Number</td>
            <td>Address</td>
            <td>City</td>
            <td>Pin</td>
            <td>Balance</td>
        </tr>
        <?php
        $len=count($custcode);
        for($i=0;$i<$len;$i++)
        {
            echo "<tr>";
            echo "<td>".$custcode[$i]."</td>";
            echo "<td>".$custfname[$i]."</td>";
            echo "<td>".$custlname[$i]."</td>";
            echo "<td>".$custfirmname[$i]."</td>";
            echo "<td>".$custphone[$i]."</td>";
            echo "<td>".$custemail[$i]."</td>";
            echo "<td>".$custgstnum[$i]."</td>";
            echo "<td>".$custaddress[$i]."</td>";
            echo "<td>".$custcity[$i]."</td>";
            echo "<td>".$custpin[$i]."</td>";
            echo "<td>".$balance[$i]."</td>";
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
