<?php
session_start();
//get catid parameter
if(empty($_SESSION))
{
    header('location:../adminsigninform.php');
}
$catid=$_REQUEST["catid"];
$catname=urldecode($_REQUEST["catname"]);

?>
<html>
    <head>
        <title>Add Product</title>
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
                <h1>Add New Product</h1></br>
                <form method="POST" action="addproduct.php" enctype="multipart/form-data">
                    <table class="table" style="font-weight:bold; width:100%;" >
                        <tr>
                            <td>category id</td>
                            <td>
                                <input type="text" name="textcatid" value="<?php echo $catid;?>"readonly>
                            </td>
                        </tr>
                        <tr>
                            <td>category name</td>
                            <td>
                                <input type="text" name="textcatname" value="<?php echo $catname;?>"readonly>
                            </td>
                        </tr>
                        <tr>
                            <td>productname</td>
                            <td>
                                <input type="text" name="textproductname" required autofocus/>
                            </td>
                        </tr>
                        <tr>
                            <td>Brand</td>
                            <td>
                                <input type="text" name="textbrand" value="No brand"/>
                            </td>
                        </tr>
                        <tr>
                            <td>Packing Type</td>
                            <td>
                                <input type="text" name="textpackingtype" required/>
                            </td>
                        </tr>
                        <tr>
                            <td>price</td>
                            <td>
                                <input type="number" name="textprice" min="0" max="100000"required/>
                            </td>
                        </tr>
                        <tr>
                            <td>IGST</td>
                            <td>
                                <input type="text" name="textigst" value="0" />
                            </td>
                        </tr>
                        <tr>
                            <td>CGST</td>
                            <td>
                                <input type="text" name="textcgst" value="0" />
                            </td>
                        </tr>
                        <tr>
                            <td>SGST</td>
                            <td>
                                <input type="text" name="textsgst" value="0" />
                            </td>
                        </tr>
                        <tr>
                            <td>stock</td>
                            <td>
                                <input type="number" name="textstock" required/>
                            </td>
                        </tr>
                        <tr>
                            <td>Box/Bag Size</td>
                            <td>
                                <input type="text" name="textboxsize"  required/>
                            </td>
                        </tr>
                        <tr>
                            <td>Box/Bag Description</td>
                            <td>
                                <input type="text" name="textboxdesc" value="null" required/>
                            </td>
                        </tr>
                        <tr>
                            <td>Image</td>
                            <td>
                                <input type="file" name="file1" id="file1">
                            </td>
                        </tr>

                        <tr>
                            <td colspan="2">
                                <input type="submit" class="btn btn-success" name="btn" value="ADD"/>
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

