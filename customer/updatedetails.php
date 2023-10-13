<?php
session_start();
if(empty($_SESSION))
    {
        header('location:../customersigninform.php');
    }
//grt input
$email=$_SESSION["email"];
$fname=$_POST["textfname"];
$lname=$_POST["textlname"];
$firmname=$_POST["textfirmname"];
$address=$_POST["textaddress"];
$gstnum=$_POST["textgstnum"];
$phone=$_POST["textphone"];
$city=$_POST["textcity"];
$pin=$_POST["textpin"];
$msg=null;

try{
    $conn=new PDO("mysql:host=localhost;dbname=grocerydb","root",null);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt=$conn->prepare("update customer set fname=?,lname=?,firmname=?,phone=?,address=?,gstnum=?,city=?,pincode=? where emailid=?");
    $stmt->bindParam(1,$fname);
    $stmt->bindParam(2,$lname);
    $stmt->bindParam(3,$firmname);
    $stmt->bindParam(4,$phone);
    $stmt->bindParam(5,$address);
    
    $stmt->bindParam(6,$gstnum);
    $stmt->bindParam(7,$city);
    $stmt->bindParam(8,$pin);
    $stmt->bindParam(9,$email);
    $stmt->execute();
    $c=$stmt->rowCount();
    if($c==1)
    {
        $msg="Update done";
    }
     else
    {
        $msg="Update failed";
    }
}
catch (Exception $e)
{
    $msg="Update failed,".$e->getmessage();
}
finally
{
    $conn=null;
}
?>

<html>
    <head>
        <title>My Detail</title>
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
            <?php echo $msg;?>
        </div>
        </div>
        <?php
            include('footer.php');
        ?>
</body>
</html>