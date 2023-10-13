<?php
    session_start();
    $to=$_POST["textemailid"];
    $msg=null;

    //from="shashikala.ghastel@gmail.com";

    //Sto="shashikala.ghaste34@gmail.com";
    try
    {
        $conn = new PDO("mysql:host=localhost; dbname=grocerydb", "root", null);
        $conn->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        $stmt = $conn->prepare("select password from customer where emailid=?");
        $stmt->bindParam(1, $to);
        $stmt->execute();
        $r=$stmt->rowCount();

        if($r==1)
        {
            $row = $stmt->fetch(PDO:: FETCH_ASSOC);
            $password=$row["password"]; 
            $subject = "Forgot password";
            $message ="<b>Your password is $password</b>";
            $header = "From:annapurna19042001@gmail.com \r\n";
            $returnval = mail ($to, $subject, $message, $header);

            if( $returnval == true) 
            {
                $msg = "Password sent to your mail.";
            }
            else {   
                $msg="Mail failed";
            }
        }
    }
    catch (Exception $e) 
    {
        $msg=$e->getMessage();
    }
?>

<html>
    <head>
        <title>Forgot Password</title>
        <link rel="stylesheet" type="text/css" href="style.css"/>
    </head>
<body>
    <form method="POST" action="customersigninform.php">
        <?php
            echo $msg;
        ?>
        <input type="submit" name="btn" class="btn btn-success" value="Back">
    </form>
</body>
</html>

