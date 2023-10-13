<?php
    session_start();
    $_SESSION["searchtype"]="search";
?>
<html>
    <head>
        <title>My Details</title>
        <link rel="stylesheet" href="styles.css">
        <?php
            include("headerlink.php");
        ?>
    </head>
    <body>
    <div class="container">
        <div class="item">
            <?php
                include('header.php');
            ?>
        </div>
        <div class="item">
            <h1>Search</h1></br>
            <form method="POST" action="browseproducts.php">
            <table class="table" style="font-weight:bold; width:100%;" >
                  <tr>
                      <td>Type of product</td>
                      <td><input type="text" name="textcategoryname" /></td>
                    </tr>
                <tr>
                  <td></td>
                  <td><input type="submit" class="btn btn-success" value="search" /></td>
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

