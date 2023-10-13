<?php
session_start();
if(empty($_SESSION))
{
    header('location:../customersigninform.php');
}
if(isset($_POST["chkdelivery"])){
    $deliveryneeded="Yes";
}
else{
    $deliveryneeded="No";
}
if(isset($_POST["chklabour"])){
    $labourneeded="Yes";
}
else{
    $labourneeded="No";
}
$custcode=$_SESSION["code"];
$status="new";
$orderdate=date('Y/m/d');
$msg="";
$conn=new PDO("mysql:host=localhost;dbname=grocerydb","root",null);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->beginTransaction(); //for rollback and commit
try  //1
{
//fetch all rows from cart based on customercode and store in array
    $cart_array=array();
    $stmt=$conn->prepare("select * from cart where custcode=?");
    $stmt->bindParam(1,$custcode);
    $stmt->execute();
    while($row=$stmt->fetch(PDO::FETCH_ASSOC))  //2
    {
        array_push($cart_array,$row);
    }//end of 2
//calculate totalamount,shippingcharges,tax,netamount
    $total=0;
    $len=count($cart_array);
    for($i=0;$i<$len; $i++)  //3
    {
        $total+=$cart_array[$i]["amt"];
    }//end of 3
   
    
    $shipping=0;
    $labour=0;
   
   
    $netamount=$total+$shipping+$labour;
    
    //insert one row into orders tables
    $stmtorders=$conn->prepare("insert into orders(orderdate,custcode,amt,shipping,labour,netamount,status,deliveryneeded,labourneeded) values(?,?,?,?,?,?,?,?,?)");
    $stmtorders->bindParam(1,$orderdate);
    $stmtorders->bindParam(2,$custcode);
    $stmtorders->bindParam(3,$total);
    $stmtorders->bindParam(4,$shipping);
    $stmtorders->bindParam(5,$labour);
    $stmtorders->bindParam(6,$netamount);
    $stmtorders->bindParam(7,$status);
    $stmtorders->bindParam(8,$deliveryneeded);
    $stmtorders->bindParam(9,$labourneeded);
    $stmtorders->execute();
    $c=$stmtorders->rowCount();
    if($c==1)  //4
    {
        //insert multiple rows of cart into orderdetails based on ordernumber
        //get the ordernumber generated
        $ordernumber=$conn->lastInsertId();
        $cartlength=count($cart_array);
        for($i=0;$i<$cartlength;$i++)  //5
        {
            $stmtdetails=$conn->prepare("insert into orderdetails (ordernum,prodcode,qty,price,igst,cgst,sgst,amt)values(?,?,?,?,?,?,?,?)");
            $stmtdetails->bindParam(1,$ordernumber);
            $stmtdetails->bindParam(2,$cart_array[$i]["prodcode"]);
            $stmtdetails->bindParam(3,$cart_array[$i]["qty"]);
            $stmtdetails->bindParam(4,$cart_array[$i]["price"]);
            $stmtdetails->bindParam(5,$cart_array[$i]["igst"]);
            $stmtdetails->bindParam(6,$cart_array[$i]["cgst"]);
            $stmtdetails->bindParam(7,$cart_array[$i]["sgst"]);
            $stmtdetails->bindParam(8,$cart_array[$i]["amt"]);
            $stmtdetails->execute();
        }//end of 5
        $d=$stmtdetails->rowCount();
        //update product table 'stock' column
        if($d>0)  //6
        {
            for($i=0;$i<$cartlength;$i++)  //7
            {
                $stmtproduct=$conn->prepare("update product set stock=stock-? where prodcode=?");
                $stmtproduct->bindParam(1,$cart_array[$i]["qty"]);
                $stmtproduct->bindParam(2,$cart_array[$i]["prodcode"]);
                $stmtproduct->execute();
            }//end of 7
            $f=$stmtproduct->rowCount();
            if($f>0)  //8
            {
                
                //delete from cart
                $stmtcartdelete=$conn->prepare("delete from cart where custcode=?");
                $stmtcartdelete->bindParam(1,$_SESSION["code"]);
                $stmtcartdelete->execute();
                $g=$stmtcartdelete->rowCount();
         
                if($g>0)  //9
                {
                    //update balance of customer table
                    $stmtbal=$conn->prepare("update customer set balance=balance+? where custcode=?");
                    $stmtbal->bindParam(1,$netamount);
                    $stmtbal->bindParam(2,$custcode);
                    $stmtbal->execute();
                    $h=$stmtbal->rowCount();
                    if($h>0){

                        $conn->commit();
                        $msg="order placed, you will get your goods soon";
                        $stmtstock=$conn->prepare("select * from product where stock<=10");
                        $stmtstock->execute();
                        $s=$stmtstock->rowCount();
                        if($s>0){
                        //create arrays
                            $categoryid=array();
                            $productcode=array();
                            $productname=array();
                            $brand=array();
                            $packingtype=array();
                            $stock=array();
                            $boxsize=array();
                            $boxdesc=array();
                            
                            //push rows into arrays
                            while($row=$stmtstock->fetch(PDO::FETCH_ASSOC))
                            {
                                array_push($productcode,$row["prodcode"]);
                                array_push($productname,$row["prodname"]);
                                array_push($brand,$row["brand"]);
                                array_push($packingtype,$row["packtype"]);
                                array_push($stock,$row["stock"]);
                                array_push($boxsize,$row["boxsize"]);
                                array_push($boxdesc,$row["boxdesc"]);
                            }
                            
                            $header="annapurna19042001@gmail.com";
                            $header.="MIME-Version:1.0"."\r\n";
                            $header.='Content-Type: text/html; charset=ISO-8859-1' ."\r\n";
                            $to="annapurnapattanshetty@gmail.com";
                            $stockmessage="The following products are out of stock, Reorder them.\r\n";
                            $subject="Out of stock notification";
                            $stockmessage="<table border=1>";
                            $stockmessage.="<tr>";
                            $stockmessage.="<td>Product</td>";
                            $stockmessage.="<td>Brand</td>";
                            $stockmessage.="<td>Packing Type</td>";
                            $stockmessage.="<td>Boxsize</td>";
                            $stockmessage.="<td>Box Desc</td>";
                            $stockmessage.="<td>Stock</td>";
                            

                            
                            for($i=0;$i<count($productcode);$i++){
                                
                                if($boxdesc!=null)
                                    $stockmessage.="<tr><td>".$productname[$i]."</td><td>".$brand[$i]."</td><td>".$packingtype[$i]."</td><td>".$boxsize[$i]."</td><td>".$boxdesc[$i]."</td><td>".$stock[$i]."</td></tr>";
                                else
                                    $stockmessage.="<tr><td>".$productname[$i]."</td><td>".$brand[$i]."</td><td>".$packingtype[$i]."</td><td>".$boxsize[$i]."</td><td>".$stock[$i]."</td></tr>";
                                
                            }
                            $stockmessage.="</table>";
                            $returnval=mail($to,$subject,$stockmessage,$header);
                            
                        }      
                    }
                    else{
                        $msg="Balance update failed";
                        $conn->rollBack();
                    }
                }  //9
                else  
                {
                    $msg="Cart delete failed";
                    $conn->rollBack();
                }  
            }//end of 8
            else
            {
                $msg="Product update failed";
                $conn->rollBack();
            }
        }//end of $d  6
        else
        {
            $msg="Stock update failed";
            $conn->rollBack();
        }
    }//end of $c   4
    else 
    {
        $msg="order details failed";
        $conn->rollback();
    }
}//end of try  1
catch(exception $e)
{
    $msg="Error ".$e->getMessage();
    $conn->rollBack();
}

?>

<html>
    <head>
        <title>Chechout</title>
        <?php
            include("headerlink.php");
        ?>
</head>
<body>
    <?php
        include("header.php");
    ?>
    <?php
        echo "Total=$total<br>";
        echo "Shipping amount=$shipping<br>Net amount=$netamount<br>";
        echo $msg;
    ?>
    <?php
                include('footer.php');
            ?>
</body>
</html>

