<?php
session_start();
//get catid parameter
if(empty($_SESSION))
{
    header('location:../adminsigninform.php');
}
?>
<html>
    <head>
        <title>Amount Report</title>
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
                <form method="POST" action="viewreport.php">
                    <h1>Total Amount Summary</h1></br>
                    <table class="table" style="font-weight:bold; width:100%;" >
                        <tr>
                            <td>From Date</td>
                            <td>
                                <input type="date" name="textfdate" required/>
                            </td>
                        </tr>
                        <tr>
                            <td>To Date</td>
                            <td>
                                <input type="date" name="texttdate" required/>
                            </td>
                        </tr>
                        <tr>
                        <td colspan="2">
                            <input type="submit" class="btn btn-success" value="Generate"/>
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