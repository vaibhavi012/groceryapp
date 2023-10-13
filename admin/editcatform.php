<?php
session_start();
if(empty($_SESSION))
{
    header('location:../adminsigninform.php');

}
//fetch url param
$catid=$_REQUEST["id"];
$catname=urldecode($_REQUEST["catname"]);
?>
<html>
    <head>
        <title>Edit categories</title>
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
          <h1>Edit Category</h1></br>
            <form method="POST" action="editcat.php">
            <table class="table" style="font-weight:bold; width:100%;" >
                <tr>
                    <td>
                        Categoryid
                    </td>
                    <td>
                        <input type="text" name="textcatid" value=<?php echo $catid;?> readonly/>

                    </td>
                </tr>
                <tr>
                    <td>
                        Category name
                    </td>
                    <td>
                        <input type="text" name="textcatname" value="<?php echo $catname;?>" autofocus requered/>

                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" class="btn btn-success" value="update"/>
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