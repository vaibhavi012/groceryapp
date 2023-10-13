<?php
session_start();
if(empty($_SESSION))
{
    header('location:../adminsigninform.php');
}
//1.fetch the input from html
$categoryname=$_POST["textcategory"];
$msg=null;
//2.connect to mysql database
$conn=new PDO("mysql:host=localhost;dbname=grocerydb","root",null);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//3.prepare statement to insert data into the category table
try
{
    $stmt=$conn->prepare("insert into category(catname) values (?)");
    $stmt->bindParam(1,$categoryname);
    $stmt->execute();
    $c=$stmt->rowCount();
    if($c>0)
    {
        $msg="Category inserted";
    }
    else
    {
        $msg="Failed to insert category";
    }
}
catch(Exception $e)
{
    $msg=$e->getMessage();
}
//4.close the connection to the database
finally
{
    $conn=null;
}
?>
<html>
    <head>
        <title>customer signup</title>
    <?php
        include("headerlink.php");
    ?>
    </head>
    <body>
    <?php
        include("header.php");
    ?> 
    <?php
        echo $msg;
    ?>
    <?php
        include("footer.php");
    ?>       
    </body>
</html>

