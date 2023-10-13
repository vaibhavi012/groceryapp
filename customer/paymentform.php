<?php
session_start();
if(empty($_SESSION))
    {
        header('location:../customersigninform.php');
    }

$balance=0;
$conn=new PDO("mysql:host=localhost;dbname=grocerydb","root",null);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt=$conn->prepare("select balance from customer where custcode=?");
$stmt->bindParam(1,$_SESSION["code"]); 
$stmt->execute();
$c=$stmt->rowCount();

if($c==1)
    {
        //fetch customercode from row
        while($row=$stmt->fetch(PDO::FETCH_ASSOC))
        {
            $balance=$row["balance"];
        }   
    }
?>
<html>
    <head>
        <title>Payment Details</title>
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
          <h1>Payments Details</h1></br>
            <form method="POST" action="payment.php" enctype="multipart/form-data">
                <table class="table" style="font-weight:bold; width:100%;" >
                  <tr>
                      <td>Balance</td>
                      <td><input type="text" name="textbalance" value=<?php echo $balance;?> autofocus readonly></td>
                    </tr>
                    
                    <tr>
                      <td>paid Amount</td>
                      <td><input type="text" name="textpaidamount" required></td>
                    </tr>
                    <tr>
                        <td>Image</td>
                        <td>
                            <input type="file" name="file1" id="file1" required>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" class="btn btn-success" name="btn" value="Submit"/>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
        <?php
            include('footer.php');
        ?>
    </body>
</html>

