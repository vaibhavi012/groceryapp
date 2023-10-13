<?php
    session_start();
    if(empty($_SESSION))
    {
        header('location:../adminsigninform.php');
    }
//fetch posted data
$catid=$_POST["textcatid"];
$catname=$_POST["textcatname"];
$msg=null;
try
{
    $conn=new PDO("mysql:host=localhost;dbname=grocerydb","root",null);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt=$conn->prepare("update category set catname=? where catid=?");
    $stmt->bindParam(1,$catname);
    $stmt->bindParam(2,$catid);
    $stmt->execute();
    $c=$stmt->rowCount();
    if($c==1)
    {
        $msg="category update done";
    }
    else
    {
        $msg="Category update failed";
    }
}
catch(Exception $e)
{
    $msg="Category update failed,".$e->getMessage();
}
finally
{
    $conn=null;
}

//update in table
?>
<html>
    <head>
        <title>View categories</title>
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

