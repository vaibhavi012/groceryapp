<?php
//session start
session_start();
if(empty($_SESSION))
    {
        header('location:../adminsigninform.php');
    }
//fetch input
$currentpwd=$_POST["textcurrentpassword"];
$newpwd=$_POST["textnewpassword"];
$confirmpwd=$_POST["textconfirmpassword"];

//compare session and current pwd
if($currentpwd==$_SESSION["pwd"])
{
    if($newpwd==$confirmpwd)
    {
        //update
        try
        {
            $conn=new PDO("mysql:host=localhost;dbname=grocerydb","root",null);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt=$conn->prepare("update admin set password=? where emailid=?");
            $stmt->bindParam(1,$newpwd);
            $stmt->bindParam(2,$_SESSION["email"]);
            $stmt->execute();
            $c=$stmt->rowCount();
            if($c==1)
            {
                //update session pwd
                $_SESSION["pwd"]=$newpwd;
                $msg="Password change successfully";
            }
             else
            {
                $msg="Password change failed";
            }
        }
        catch(Exception $e)
        {
            $msg="Invalid failed,".$e->getMessage();
        }
        finally
        {
            $conn=null;
        }
    }
    else
    {
        $msg="new and confirm pwd do not match";
    }
}
else
{
    $msg="current password is invalid";
}
?>
<html>
    <head>
        <title>Change password</title>
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
            <?php echo $msg; ?>
        </div>
    </div>
    <?php
        include("footer.php");
    ?>
</body>
</html>



    

