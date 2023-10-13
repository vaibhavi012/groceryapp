<html>
    <head>
        <title>Customer</title>
        <link rel="stylesheet" type="text/css" href="style.css"/>
    </head>
    <script>
        function validate()
        {
            var fnamepattern=/^[A-Za-z]+$/;
            var fname=document.forms["regform"]["textfname"].value;
            if(fname.search(fnamepattern)==-1)
            {
                document.getElementById("fnameresult").innerHTML="First Name contains only alphabets without space";
                return false;
            }

            var lnamepattern=/^[A-Za-z]+$/;
            var lname=document.forms["regform"]["textlname"].value;
            if(lname.search(lnamepattern)==-1)
            {
                document.getElementById("lnameresult").innerHTML="Last Name contains only alphabets without space";
                return false;
            }

            var firmnamepattern=/^[A-Za-z]+\s?[A-Za-z]+$/;
            var firmname=document.forms["regform"]["textfirmname"].value;
            if(firmname.search(firmnamepattern)==-1)
            {
                document.getElementById("firmresult").innerHTML="Firm Name contains only alphabets with one space between each word";
                return false;
            }
            var textphonepattern=/^[0-9]{10}$/;
            var phone=document.forms["regform"]["textphone"].value;
            if(phone.search(textphonepattern)==-1)
            {
                document.getElementById("phoneresult").innerHTML="Phone number should contain only digits and minimum 10";
                return false;
            }
            //which should contain at least one lowercase latter,one uppercase,one numeric digit,and one special charater
            var npwdpattern=/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{6,8}$/;
            var npwd=document.forms["regform"]["textpassword"].value;
            if(npwd.search(npwdpattern)==-1)
            {
                document.getElementById("npwdresult").innerHTML="pwd must contain at least 1 lower,1 upper,1 digit,1 special";
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
    <div>
     
        <form method="POST" action="customersignup.php" name="regform" onsubmit="return validate();">
        <h2>Customer Sign Up</h2></br>
            <table>
                <tr>
                    <td>
                        User First Name
                    </td>
                    <td>
                        <input type="text" name="textfname" id="textfname" maxlength="20" minlength="3" required autofocus/>
                        <p id="fnameresult" style="color:tomato;"></p>
                    </td>
                </tr>

                <tr>
                    <td>
                        User Last Name
                    </td>
                    <td>
                        <input type="text" name="textlname" id="textlname"  maxlength="20" minlength="3" required/>
                        <p id="lnameresult" style="color:tomato;"></p>
                    </td>
                </tr>

                <tr>
                    <td>
                        Firm Name
                    </td>
                    <td>
                        <input type="text" name="textfirmname" id="textfirmname" maxlength="30" minlength="3" required/>
                        <p id="firmresult" style="color:tomato;"></p>
                    </td>
                </tr>

                <tr>
                    <td>
                        Phone
                    </td>
                    <td>
                        <input type="text" name="textphone" id="textphone" maxlength="10" minlength="10" required/>
                        <p id="phoneresult" style="color:tomato;"></p>
                    </td>
                </tr>

                <tr>
                    <td>
                        Email
                    </td>
                    <td>
                        <input type="text" name="textemail" id="textemail" required/>

                    </td>
                </tr>

                <tr>
                    <td>
                        New Password
                    </td>
                    <td>
                        <input type="password" name="textpassword" id="textpassword" maxlength="8" minlength="6" required/>
                        <p id="npwdresult" style="color:tomato;"></p>
                    </td>
                </tr>

                <tr>
                    <td>
                        Confirm Password
                    </td>
                    <td>
                        <input type="password" name="textcpassword" id="textcpassword" maxlength="8" minlength="6" required/>

                    </td>
                </tr>

                <tr>
                    <td>
                        GST Number
                    </td>
                    <td>
                        <input type="text" name="textgstnum" id="textgstnum" maxlength="15" minlength="15"/>
                        <p id="gstresult" style="color:tomato;"></p>
                    </td>
                </tr>

                <tr>
                    <td>
                        address
                    </td>
                    <td>
                        <textarea row=5 name="textaddress" id="textaddress" required></textarea>

                    </td>
                </tr>

                <tr>
                    <td>
                        City
                    </td>
                    <td>
                        <input type="text" name="textcity" id="textcity" required/>

                    </td>
                </tr>
                
                <tr>
                    <td>
                        PinCode
                    </td>
                    <td>
                        <input type="text" name="textpin" id="textpin" maxlength="6" minlength="6" required/>

                    </td>
                </tr> 

                <tr>
                    <td>
                        <input type="submit" class="btn btn-success" value="SignUp"/>
                    </td>
                </tr>
            </table>
            
        </form>
    </div>
 
</body>
</html>