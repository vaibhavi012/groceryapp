<?php
session_start();
//get catid parameter
if(empty($_SESSION))
{
    header('location:../adminsigninform.php');
}
?>
<?php
//set up connection
$conn=new PDO("mysql:host=localhost;dbname=grocerydb","root",null);
$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
//create arrays

$custcode=array();
$firmname=array();
$balance=array();
$paiddate=array();
$paidamount=array();
$image=array();


//prepere select statemnt
$stmt=$conn->prepare("select transaction.custcode,paiddate,paidamount,image,customer.balance,firmname from transaction inner join customer on transaction.custcode=customer.custcode");

$stmt->execute();
//push rows into arrays
while($row=$stmt->fetch(PDO::FETCH_ASSOC))
{
    array_push($custcode,$row["custcode"]);
    array_push($firmname,$row["firmname"]);
    array_push($balance,$row["balance"]);
    array_push($paiddate,$row["paiddate"]);
    array_push($paidamount,$row["paidamount"]);
    array_push($image,$row["image"]);
}
$conn=null;
?>

<html>
<head>
    <title>Amount detail</title>
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
    <h1>Amount Detail</h1></br>
    <table class="table" style="font-weight:bold; width:100%;" >
        <tr>
            <td>Customer Code</td>
            <td>Firm Name</td>
            <td>Balance</td>
            <td>Paid Date</td>
            <td>Paid Amount</td>
            <td>Image</td>
        </tr>
        
        <?php
        $len=count($custcode);
        for($i=0;$i<$len;$i++)
        {
            echo "<tr>";
            echo "<td>".$custcode[$i]."</td>";
            echo "<td>".$firmname[$i]."</td>";
            echo "<td>".$balance[$i]."</td>";
            echo "<td>".$paiddate[$i]."</td>";
            echo "<td>".$paidamount[$i]."</td>";
            echo "<td><img class=item1 height=100 width=100 src=".$image[$i]."></td>";
            echo"</tr>";
        }
        ?>
    </table>
    <style>
        .item1:hover
        {
            transform:scale(4.0);
        }
        </style>
            </div>
    </div>
    </div>
    <?php
        include('footer.php');
    ?>
    </body>
    </html>


    


    