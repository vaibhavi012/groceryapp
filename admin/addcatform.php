<?php
    session_start();
    if(empty($_SESSION))
    {
        header('location:../adminsigninform.php');
    }
?>
<html>
    <head>
        <title>Add category</title>
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
          <h1>Add New Category</h1></br>
            <form method="POST" action="addcat.php">
            <table class="table" style="font-weight:bold; width:100%;" >
                <tr>
                    <td>
                        New Category
                    </td>
                    <td>
                        <input type="text" name="textcategory" id="textcategory" required autofocus/>

                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" class="btn btn-success" value="ADD"/>
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