<?php
 
//set up connection
$conn=new PDO("mysql:host=localhost;dbname=grocerydb","root",null);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//create arrays
$custcode=array();
$fname=array();
$lname=array();
$firmname=array();
$rating=array();
$ratingdate=array();
$description=array();

//prepere select statemnt
$stmt=$conn->prepare("select customer.custcode,customer.fname,customer.lname,customer.firmname,feedback.rating,feedback.ratingdate,feedback.description from customer inner join feedback on customer.custcode=feedback.custcode");
$stmt->execute();
$c=$stmt->rowCount();

//push rows into arrays
while($row=$stmt->fetch(PDO::FETCH_ASSOC))
{
    array_push($custcode,$row["custcode"]);
    array_push($fname,$row["fname"]);
    array_push($lname,$row["lname"]);
   
    array_push($firmname,$row["firmname"]);
    array_push($rating,$row["rating"]);
    array_push($ratingdate,$row["ratingdate"]);
    array_push($description,$row["description"]);
}
$conn=null;
?>

<html>
<head>
    <title>View Feedback</title>
    <link rel="stylesheet" type="text/css" href="style.css"/>
    
</head>
<div class="container">
<div class="item">
    <div align="center">
    <h1>View Feedback</h1></br>
    <table border="2" class="table" style="font-weight:bold; width:100%;" >
        <tr>
            <td>Name</td>
            <td>Firm Name</td>
            <td>Rating</td>
            <td>Date</td>
            <td>Feedback</td>
        </tr>
        
        <?php
        $len=count($custcode);
        
        for($i=0;$i<$len;$i++)
        {
            echo "<tr>";
            echo "<td>".$fname[$i]."<br>$lname[$i]</td>";
            
            echo "<td>".$firmname[$i]."</td>";
            echo "<td>".$rating[$i]."</td>";
            echo "<td>".$ratingdate[$i]."</td>";
            echo "<td>".$description[$i]."</td>";
            
            echo "</tr>";
        }
        ?>
    </table>
    </div> 
</div>
</div>
</body>
</html>
