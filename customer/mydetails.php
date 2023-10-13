<?php
session_start();
if(empty($_SESSION))
    {
        header('location:../customersigninform.php');
    }
//get session emailid
$email=$_SESSION["email"];
//fetch entire roe of customer feom database
$fname=null;
$lname=null;
$firmname=null;
$phone=null;
$balance=null;
$gstnum=null;
$address=null;
$city=null;
$pin=null;

try
{
    //build the stmt to check
    $conn=new PDO("mysql:host=localhost;dbname=grocerydb","root",null);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt=$conn->prepare("select * from customer where emailid=?");
    $stmt->bindParam(1,$email);
    $stmt->execute();
    
    //store in variable
    while($row=$stmt->fetch(PDO::FETCH_ASSOC))
    {
        $fname=$row["fname"];
        $lname=$row["lname"];
        $firmname=$row["firmname"];
        $phone=$row["phone"];
        $email=$row["emailid"];
        $balance=$row["balance"];
        $gstnum=$row["gstnum"];
        $address=$row["address"];
        $city=$row["city"];
        $pin=$row["pincode"];
    }
}
catch(Exception $e)
{
    $msg="Failed to fetch the details,".$e->getMessage();
}
//in html display the value
?>

<html>
    <head>
        <title>My Detail</title>
        <?php
            include("headerlink.php");
        ?>
        <link rel="stylesheet" href="styles.css">
        <style>
            input,
            textarea{
                background-color:#D5D7DA;
            }
        </style>
    </head>
    <script>
        function validate()
        {
            var textphonepattern=/^[0-9]{10}$/;
            var phone=document.forms["regform"]["textphone"].value;
            if(phone.search(textphonepattern)==-1)
            {
                document.getElementById("phoneresult").innerHTML="Phone number should contain only digits and minimum 10";
                return false;
            }

            var gstnumpattern=/^[a-zA-Z0-9]{15,15}$/;
            var gstnum=document.forms["regform"]["textgstnum"].value;
            if(gstnum.search(gstnumpattern)==-1)
            {
                document.getElementById("gstresult").innerHTML="gst number should contain only alphanumeric";
                return false;
            }
            
        }
    </script>
<body>
        <div class="container">
        <div class="item">
            <?php
                include('header.php');
            ?>
        </div>
        <div class="item">
            <h1>My info</h1></br>
            <button id="btn"  class="btn btn-success" onclick="enable()">Edit</button>
            <form method="POST" action="updatedetails.php" name="regform" onsubmit="return validate();">
            <table class="table" style="font-weight:bold; width:100%;" >
                <tr>
                    <td>
                        First Name
                    </td>
                    <td>
                        <input type="text" name="textfname" id="textfname" value="<?php echo $fname;?>" readonly/>

                    </td>
                </tr>
                <tr>
                    <td>
                        Last Name
                    </td>
                    <td>
                        <input type="text" name="textlname" id="textlname" value="<?php echo $lname;?>" readonly/>

                    </td>
                </tr>
                <tr>
                    <td>
                        Firm Name
                    </td>
                    <td>
                        <input type="text" name="textfirmname" id="textfirmname" value="<?php echo $firmname;?>" readonly/>

                    </td>
                </tr>
                <tr>
                    <td>
                        Phone
                    </td>
                    <td>
                        <input type="text" name="textphone" id="textphone"value="<?php echo $phone;?>"  maxlength="10" minlength="10"readonly />
                        <p id="phoneresult" style="color:tomato;"></p>
                    </td>
                </tr>
                <tr>
                    <td>
                        Email
                    </td>
                    <td>
                        <input type="text" name="textemail" id="textemail"value="<?php echo $email;?>" readonly />

                    </td>
                </tr>
                
                <tr>
                    <td>
                        GST Number
                    </td>
                    <td>
                        <input type="text" name="textgstnum" id="textgstnum" value="<?php echo $gstnum;?>" maxlength="15" minlength="15" readonly/>
                        <p id="gstresult" style="color:tomato;"></p>
                    </td>
                </tr>
                <tr>
                    <td>
                        address
                    </td>
                    <td>
                        <textarea name="textaddress" id="textaddress" readonly> <?php echo $address;?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        City
                    </td>
                    <td>
                        <input type="text" name="textcity" id="textcity"value="<?php echo $city;?>" readonly />

                    </td>
                </tr>
                <tr>
                    <td>
                        PinCode
                    </td>
                    <td>
                        <input type="text" name="textpin" id="textpin"value="<?php echo $pin;?>" readonly />

                    </td>
                </tr> 
                <tr>
                    <td>
                        Balance
                    </td>
                    <td>
                        <input type="text" name="textbalance" id="textbalance"value="<?php echo $balance;?>" readonly />

                    </td>
                </tr> 

                <tr>
                    <td colspan="2">
                    <input type="submit"  value="update change"  class="btn btn-success" id="btnupdate" disabled/>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<script>
    function enable()
    {
        document.getElementById("textphone").readOnly=false;
        document.getElementById("textgstnum").readOnly=false;
        document.getElementById("textcity").readOnly=false;
        document.getElementById("textpin").readOnly=false;
        document.getElementById("textaddress").readOnly=false;
       
        document.getElementById("textphone").style.backgroundColor="white";
        document.getElementById("textgstnum").style.backgroundColor="white";
        document.getElementById("textcity").style.backgroundColor="white";
        document.getElementById("textpin").style.backgroundColor="white";
        document.getElementById("textaddress").style.backgroundColor="white";
       

        document.getElementById("btnupdate").disabled=false;
        document.getElementById("textphone").focus();
    }
    </script>
    <?php
        include('footer.php');
    ?>
</body>
</html>