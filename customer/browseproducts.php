<?php
    session_start();
    $conn=new PDO("mysql:host=localhost;dbname=grocerydb","root",null);
    if(empty($_SESSION))
    {
        header('location:../customersigninform.php');
    }
        
    if($_SESSION["searchtype"]=="regular")
    {
        //get param
        $categoryid=$_REQUEST["id"];
        //set up connection

        $stmt=$conn->prepare("select * from product where catid=? and status ='Available'");
        $stmt->bindParam(1,$categoryid);
        $stmt->execute();
        $c=$stmt->rowCount();
    }
    else
    {
        $productname=strtoupper($_POST["textcategoryname"]);
        $stmt=$conn->prepare("select * from product where status='Available' and upper(prodname) like '%$productname%'");
        $stmt->execute();
        $c=$stmt->rowCount();  
    }
    //create arrays
    $categoryid=array();
    $category=array();
    $productcode=array();
    $productname=array();
    $boxsize=array();
    $boxdesc=array();
    $brand=array();
    $price=array();
    $igst=array();
    $cgst=array();
    $sgst=array();
    $stock=array();
    $imagename=array();


    //push rows into arrays
    if($c>0)
    {
        while($row=$stmt->fetch(PDO::FETCH_ASSOC))
        {
            
            array_push($productcode,$row["prodcode"]);
            array_push($productname,$row["prodname"]);
            array_push($price,$row["price"]);
            array_push($boxsize,$row["boxsize"]);
            array_push($boxdesc,$row["boxdesc"]);
            array_push($brand,$row["brand"]);
            array_push($igst,$row["igst"]);
            array_push($cgst,$row["cgst"]);
            array_push($sgst,$row["sgst"]);
            array_push($stock,$row["stock"]);
            array_push($imagename,$row["imgname"]); 
        }
    }
    $conn=null;
?>

<html>
<head>
    <title>View Product detail</title>
    <?php
        include('headerlink.php');
    ?>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container" style="width:100%;">
        <div class="item" style="width:100%;">
            <?php
                include('header.php');
            ?>
        </div>
        <div class="item" style="font-size:20px; width:100%;">
            <h1>Product List</h1></br>
            <?php
            //display array in table tab
            if($c>0)
            {
                ?>
        
                <?php
                $len=count($productcode);
                echo "<div style=display:flex; flex-wrap:wrap; justify-content:space-evenly;>";
            
                for($i=0;$i<$len;$i++)
                {
                    echo "<div>";
                    echo "<img src=".$imagename[$i]." height=100 width=100/>";
                    echo "<br/>";
            
                    echo "productcode:".$productcode[$i];
                    echo "<br/>";
                    echo "product name:".$productname[$i];
                    $productname[$i]=urlencode($productname[$i]);
                    echo "<br/>";
                    echo "Box Size:".$boxsize[$i];
                    $boxsize[$i]=urlencode($boxsize[$i]);
                    echo "<br/>";
                    echo "Box Description:".$boxdesc[$i];
                    $boxdesc[$i]=urlencode($boxdesc[$i]);
                    echo "<br/>";
                    echo "Brand Name:".$brand[$i];
                    $brand[$i]=urlencode($brand[$i]);
                    echo "<br/>";
                    echo "price:".$price[$i];
                    echo "<br/>";
                    echo "IGST:".$igst[$i];
                    echo "<br/>";
                    echo "CGST:".$cgst[$i];
                    echo "<br/>";
                    echo "SGST:".$sgst[$i];
                    echo "<br/>";
                    if ($stock[$i]==0)
                        echo "Out of stock currently";    
                    
                    else if ($stock[$i]<=20)
                    {
                        echo "</br>Hurry up Only " .$stock[$i]." left</br>";
                        echo "</br><a href=addtocartform.php?code=$productcode[$i]&pname=$productname[$i]&boxsize=$boxsize[$i]&boxdesc=$boxdesc[$i]&brand=$brand[$i]&price=$price[$i]&igst=$igst[$i]&cgst=$cgst[$i]&sgst=$sgst[$i]&stock=$stock[$i]>Add to cart</a>";
                    }    
                    else
                            echo "<a href=addtocartform.php?code=$productcode[$i]&pname=$productname[$i]&boxsize=$boxsize[$i]&boxdesc=$boxdesc[$i]&brand=$brand[$i]&price=$price[$i]&igst=$igst[$i]&cgst=$cgst[$i]&sgst=$sgst[$i]&stock=$stock[$i]>Add to cart</a>";
                    echo "<br/>";
                    echo "</div>";
                }
                echo "</div>";
                ?>
            </table>
            <?php
            }
            else
            {
                echo "No products of the selected category";
            }
            ?>    
        </div>
    </div>
    <?php
        include('footer.php');
    ?>
    </body>
</html>
