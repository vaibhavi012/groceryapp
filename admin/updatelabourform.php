<?php
session_start();
if(empty($_SESSION))
{
    header('location:../adminsigninform.php');
}
    
    $conn=new PDO("mysql:host=localhost;dbname=grocerydb","root",null);
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $msg="";
    $ordernum=$_REQUEST["s"];
?>

    <html>
    <head>
        <title>Shipping Charge</title>
        <?php
            include("headerlink.php");
        ?>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <div class="container">
            <div class="item">
            <?php
                include("header.php");
            ?>
            <h1>Labour Charge</h1></br>
            <form method="POST" action="updatelabour.php">
                <table class="table" style="font-weight:bold; width:100%;" >
                    <tr>
                        <td>Order Number</td>
                        <td>
                            <input type="text" name="textordernum" value="<?php echo $ordernum;?>"readonly>
                        </td>
                    </tr>
                       
                    <tr>
                        <td>Labour Charge</td>
                        <td>
                            <input type="text" name="textlabour" />
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
        include("footer.php");
        ?>
    </body>
</html>
