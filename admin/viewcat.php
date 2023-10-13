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
$catid=array();
$catname=array();
//prepere select statemnt
$stmt=$conn->prepare("select * from category");
$stmt->execute();
//push rows into arrays
while($row=$stmt->fetch(PDO::FETCH_ASSOC))
{
    array_push($catid,$row["catid"]);
    array_push($catname,$row["catname"]);
}
$conn=null;
?>


<html>
<head>
    <title>View categories</title>
    <link rel="stylesheet" href="styles.css">
    <?php
        include("headerlink.php");
    ?>
</head>
<body>
    <div class="container">
        <div class="item">
            <?php
                include('header.php');
            ?>
        </div>
    <div class="item">
    <h1>Category List</h1></br>
    <table class="table" style="font-weight:bold; width:100%;" >
        <tr>
            <td>CategoryId</td>
            <td>Category</td>
            <td>Add product</td>
        </tr>
        
        <?php
        $len=count($catid);
        for($i=0;$i<$len;$i++)
        {
            echo "<tr>";
            echo "<td>".$catid[$i]."</td>";
            $name=urlencode($catname[$i]);
            
            echo "<td><a href=editcatform.php?id=$catid[$i]&catname=$name>".$catname[$i]."</a></td>";
            echo "<td><a href=addproductform.php?&catid=$catid[$i]&catname=$name>Add Productinfo</a></td>";
           
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