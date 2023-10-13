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
$categoryid=array();
$category=array();
$productcode=array();
$productname=array();
$brand=array();
$packingtype=array();
$price=array();
$igst=array();
$cgst=array();
$sgst=array();
$stock=array();
$boxsize=array();
$boxdesc=array();
$imagename=array();

//prepere select statemnt
$stmt=$conn->prepare("select product.catid,catname,prodcode,prodname,brand,packtype,stock,price,igst,cgst,sgst,boxsize,
boxdesc,product.imgname from product inner join category on product.catid=category.catid where status ='Available'");
$stmt->execute();
//push rows into arrays
while($row=$stmt->fetch(PDO::FETCH_ASSOC))
{
    array_push($categoryid,$row["catid"]);
    array_push($category,$row["catname"]);
    array_push($productcode,$row["prodcode"]);
    array_push($productname,$row["prodname"]);
    array_push($brand,$row["brand"]);
    array_push($packingtype,$row["packtype"]);
    array_push($price,$row["price"]);
    array_push($igst,$row["igst"]);
    array_push($cgst,$row["cgst"]);
    array_push($sgst,$row["sgst"]);
    array_push($stock,$row["stock"]);
    array_push($boxsize,$row["boxsize"]);
    array_push($boxdesc,$row["boxdesc"]);
    array_push($imagename,$row["imgname"]);
    
}
$conn=null;
?>

<html>
<head>
    <title>View Product detail</title>
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
    <h1>Product List</h1></br>
    <table class="table" style="font-weight:bold; width:100%;" >
        <tr>
            <td>Category Code</td>
            <td>Category Name</td>
            <td>Product Code</td>
            <td>Product Name</td>
            <td>Brand</td>
            <td>Packing Type</td>
            <td>Price</td>
            <td>IGST</td>
            <td>CGST</td>
            <td>SGST</td>
            <td>Stock</td>
            <td>Box Size</td>
            <td>Box Description</td>
            <td>Image</td>
            <td>Edit</td>
            <td>Delete Product</td>
        </tr>
        
        <?php
        $len=count($productcode);
        for($i=0;$i<$len;$i++)
        {
            echo "<tr>";
            echo "<td>".$categoryid[$i]."</td>";
            echo "<td>".$category[$i]."</td>";
            echo "<td>".$productcode[$i]."</td>";
            echo "<td>".$productname[$i]."</td>";
            $name=urlencode($productname[$i]);
            echo "<td>".$brand[$i]."</td>";
            $brandname=urlencode($brand[$i]);
            echo "<td>".$packingtype[$i]."</td>";
            echo "<td>".$price[$i]."</td>";
            echo "<td>".$igst[$i]."</td>";
            echo "<td>".$cgst[$i]."</td>";
            echo "<td>".$sgst[$i]."</td>";
            
            echo "<td>".$stock[$i]."</td>";
            echo "<td>".$boxsize[$i]."</td>";
            $boxsizename=urlencode($boxsize[$i]);
            echo "<td>".$boxdesc[$i]."</td>";
            $boxdescname=urlencode($boxdesc[$i]);
            
            echo "<td><img src=".$imagename[$i]." height=100 width=100/></td>";
            echo "<td><a href=editproductform.php?code=$productcode[$i]&name=$name&brand=$brandname&packingtype=$packingtype[$i]&price=$price[$i]&igst=$igst[$i]&cgst=$cgst[$i]&sgst=$sgst[$i]&stock=$stock[$i]&boxsize=$boxsizename&boxdesc=$boxdescname&imgname=$imagename[$i]>Edit</a></td>";

            echo "<td><a href=deleteproduct.php?s=$productcode[$i]>"."Delete"."</a></td>";
            echo"</tr>";
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


    


    