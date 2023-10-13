<?php
    session_start();
    if(empty($_SESSION))
    {
        header('location:../adminsigninform.php');
    }
?>
<html>
    <head>
        <title>Change password</title>
        <?php
            include("headerlink.php");
        ?>
        <link rel="stylesheet" href="styles.css">
    </head>

    <script>
        function validate()
        {
            //which should contain at least one lowercase latter,one uppercase,one numeric digit,and one special charater
            var npwdpattern=/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{6,8}$/;
            var npwd=document.forms["regform"]["textnewpassword"].value;
            if(npwd.search(npwdpattern)==-1)
            {
                document.getElementById("npwdresult").innerHTML="pwd must contain at least 1 lower,1 upper,1 digit,1 special";
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
          <h1>Admin Change Password</h1></br>
          <form method="POST" action="changepwd.php" name="regform" onsubmit="return validate();">
            <table class="table" style="font-weight:bold; width:100%;" >
                <tr>
                    <td>current password</td>
                    <td><input type="password" name="textcurrentpassword" autofocus></td>
                </tr>
                <tr>
                    <td>new password</td>
                    <td>
                        <input type="password" name="textnewpassword" id="textnewpassword" maxlength="8" minlength="6">
                        <p id="npwdresult" style="color:tomato;"></p>
                    </td>
                </tr>
                <tr>
                    <td>confirm password</td>
                    <td><input type="password" name="textconfirmpassword"></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" class="btn btn-succcess" name="btn" value="change"></td>
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

