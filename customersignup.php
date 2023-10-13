<?php
    //fetch the input from html
    $customerfname=$_POST["textfname"];
    $customerlname=$_POST["textlname"];
    $customerfirmname=$_POST["textfirmname"];
    $customerphone=$_POST["textphone"];
    $customeremail=$_POST["textemail"];
    $customerpassword=$_POST["textpassword"];
    $customergstnum=$_POST["textgstnum"];
    $customercpassword=$_POST["textcpassword"];
    $customeraddress=$_POST["textaddress"];
    $customercity=$_POST["textcity"];
    $customerpin=$_POST["textpin"];
    $msg=null;
    if($customerpassword==$customercpassword)
    {
        //2.connect to mysql database
        $conn=new PDO("mysql:host=localhost;dbname=grocerydb","root",null);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //3.prepare statement to insert data into the category table
        try
        {
            $stmt=$conn->prepare("insert into customer(fname,lname,firmname,phone,emailid,password,gstnum,address,city,pincode) values (?,?,?,?,?,?,?,?,?,?)");
            $stmt->bindParam(1,$customerfname);
            $stmt->bindParam(2,$customerlname);
            $stmt->bindParam(3,$customerfirmname);
            $stmt->bindParam(4,$customerphone);
            $stmt->bindParam(5,$customeremail);
            $stmt->bindParam(6,$customerpassword);
            $stmt->bindParam(7,$customergstnum);
            $stmt->bindParam(8,$customeraddress);
            $stmt->bindParam(9,$customercity);
            $stmt->bindParam(10,$customerpin);
            $stmt->execute();
            $c=$stmt->rowCount();
            if($c>0)
            {
                $msg="SignUp successful";
            }
            else
            {
                $msg="SignUp failed";
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
    }
    else
    {
        $msg="New and confirm password do not match";
        
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
            include('header.php');
        ?>    
        <form method="POST" action="customersignin.php">
        <?php
          echo $msg;
          echo "<h3><a href=customersigninform.php>Sign In</a></h3>";  
        ?>
        </form>
        <?php
            include('footer.php');
        ?>
    </body>
</html>
