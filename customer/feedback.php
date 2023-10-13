<?php
    session_start();
    if(empty($_SESSION))
    {
        header('location:../customersigninform.php');
    }
    //store custcode  from session
    $custcode=$_SESSION["code"];
    $ratingdate=date('Y/m/d');
    //fetch input
    $rating=$_POST["rating"];
    $description=$_POST["textdesc"];
    //update
    try
    {
        $conn=new PDO("mysql:host=localhost;dbname=grocerydb","root",null);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt=$conn->prepare("insert into feedback(rating,ratingdate,description,custcode)values(?,?,?,?)");
        $stmt->bindParam(1,$rating);
        $stmt->bindParam(2,$ratingdate);
        $stmt->bindParam(3,$description);
        $stmt->bindParam(4,$custcode);
        $stmt->execute();
        $c=$stmt->rowCount();
        if($c==1)
        {
            $msg="feedback sent successfully";
        }
         else
        {
            $msg="Feedbak failed";
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
?>
<html>
    <head>
        <title>Feedback </title>
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
        include('footer.php');
    ?>
</body>
</html>



    

