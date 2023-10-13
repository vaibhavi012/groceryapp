<?php
session_start();
if(empty($_SESSION))
{
    header('location:../adminsigninform.php');
}
$catid=$_POST["textcatid"];
$catname=$_POST["textcatname"];
$productname=$_POST["textproductname"];
$brand=$_POST["textbrand"];
$packingtype=$_POST["textpackingtype"];
$price=$_POST["textprice"];
$igst=$_POST["textigst"];
$cgst=$_POST["textcgst"];
$sgst=$_POST["textsgst"];
$stock=$_POST["textstock"];
$boxsize=$_POST["textboxsize"];
$boxdesc=$_POST["textboxdesc"];
$status="";

try
{
    if(isset($_FILES["file1"]["type"]))
    {
        $validextensions=array("jpeg","jpg","png");
        //split file,extension and store into $temporary
        $temporary=explode(".",$_FILES["file1"]["name"]);
        //get file extension from $temporary variable
        $file_extension=end($temporary);
        //check the mine type provided by the browser
        if((($_FILES["file1"]["type"]=="image/png")
            ||($_FILES["file1"]["type"]=="image/jpg")
            ||($_FILES["file1"]["type"]=="image/jpeg"))
            &&($_FILES["file1"]["size"]<50000000)
            &&in_array($file_extension,$validextensions))
            {
                //if file was not upload correctly or partially uploaded,rreturns 0 if valid
                if($_FILES["file1"]["error"]>0)
                    $msg=$_FILES["file1"]["error"];
                //check if file is already uploaded
                else if(file_exists("../photos/".$_FILES["file1"]["name"]))
                    $msg="this file already exists.";
                else
                {
                    $sourcePath=$_FILES['file1']['tmp_name'];
                    $targetPath="../photos/".$_FILES['file1']['name'];
                    move_uploaded_file($sourcePath,$targetPath);
                    $photo=$targetPath;
                    $status="ok";
                }
            }
            else
            {
                $msg="invalid file size or type";
            }
    }
    else
    {
        $msg="please select file";
    }
    if($status=="ok")
    {
        $conn=new PDO("mysql:host=localhost;dbname=grocerydb","root",null);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt=$conn->prepare("insert into product(catid,prodname,brand,packtype,imgname,price,igst,cgst,sgst,stock,boxsize,boxdesc)values(?,?,?,?,?,?,?,?,?,?,?,?)");
           
            $stmt->bindParam(1,$catid);
            $stmt->bindParam(2,$productname);
            $stmt->bindParam(3,$brand);
            $stmt->bindParam(4,$packingtype);
            $stmt->bindParam(5,$photo);
            $stmt->bindParam(6,$price);
            $stmt->bindParam(7,$igst);
            $stmt->bindParam(8,$cgst);
            $stmt->bindParam(9,$sgst);
            $stmt->bindParam(10,$stock);
            $stmt->bindParam(11,$boxsize);
            $stmt->bindParam(12,$boxdesc);
            $stmt->execute();
            $msg=" Product added";
    }
}
catch(Exception $e)
{
    $msg="product not added".$e->getMessage();
}
finally
{
    $conn=null;
}
?>
<html>
    <head>
        <title>Add product info</title>
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
            <h4><?php echo $msg; ?></h4>
        </div>
    </div>
    <?php
        include('footer.php');
    ?>
</body>
</html>


