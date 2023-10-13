<?php
session_start();
if(empty($_SESSION))
{
    header('location:../customersigninform.php');
}

$balance=$_POST["textbalance"];

$paidamount=$_POST["textpaidamount"];
$status="";
$custcode=$_SESSION["code"];
$paiddate=date('Y/m/d');
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
            &&($_FILES["file1"]["size"]<500000)
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
        $stmt=$conn->prepare("insert into transaction(paiddate,paidamount,image,custcode)values(?,?,?,?)");
        $stmt->bindParam(1,$paiddate);
        $stmt->bindParam(2,$paidamount);
        $stmt->bindParam(3,$photo);
        $stmt->bindParam(4,$custcode);
        $stmt->execute();
        $c=$stmt->rowCount();
            
        //update balance of customer table
        if($c==1)
        {
            $stmtbal=$conn->prepare("update customer set balance=balance-? where custcode=?");
            $stmtbal->bindParam(1,$paidamount);
            $stmtbal->bindParam(2,$custcode);
            $stmtbal->execute();
            $s=$stmtbal->rowCount();
            
            if($s==1)
            {
            $msg="Transaction updated";
            }
            else
            {
                $msg="update balance failed";
            }
        }
        else
        {
            $msg="transaction failed";
        }
    }
}
catch(Exception $e)
{
    $msg="Transaction updattion failed".$e->getMessage();
}
finally
{
    $conn=null;
}
?>
<html>
    <head>
        <title>Transaction</title>
            <?php
                include('headerlink.php');
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


