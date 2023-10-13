<?php
    session_start();
    //fetch input
    $email=$_POST["textemail"];
    $pwd=$_POST["textpassword"];
    $msg=null;
    $c=0;

    //open conn
    $conn=new PDO("mysql:host=localhost;dbname=grocerydb","root",null);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    try
    {
        //build the stmt to check
        $stmt=$conn->prepare("select * from customer where emailid=? and password=?");
        $stmt->bindParam(1,$email);
        $stmt->bindParam(2,$pwd);
        $stmt->execute();
        $c=$stmt->rowCount();

        //if found then goto adminhome.html else error msg
        if($c==1)
        {
            //fetch customercode from row
            while($row=$stmt->fetch(PDO::FETCH_ASSOC))
            {
                $custcode=$row["custcode"];
            }
            //store admin details in session
            $_SESSION["code"]=$custcode;
            $_SESSION["email"]=$email;
            $_SESSION["pwd"]=$pwd;
            
            header('location:customer/customerhome.php');
        }
        else
        {
            $msg="Email Id and passwords do not match";
        }
    }
    catch(Exception $e)
    {
        $msg="Invalid login,".$e->getMessage();
    }
?>
<html>
    <head>
        <title>Customer signin</title>
        <?php
            include("headerlink.php");
        ?>
    </head>
    <body>
    <?php
        include('header.php');
    ?>      
    <form method="POST" action="customersigninform.php">
        <?php
        if($c==0)
        {
            echo $msg;
        }
        ?>
        <input type="submit" name="btn" class="btn btn-success" value="Try Again">
        <?php
            include('footer.php');
        ?>
        </form>
    </body>
</html>