<html>
    <head>
        <title>Admin SignIn</title>
        <?php
            include("headerlink.php");
        ?>
    </head>
<body>
    <?php
        include('header.php');
    ?>      
    <div align="center">
        
        <form method="POST" action="adminsignin.php">
        <h2>Admin SignIn</h2></br>
            <table>
                <tr>
                    <td>
                        EmailId
                    </td>
                    <td>
                        <input type="email" name="textemail" id="textemail" required autofocus/>

                    </td>
                </tr>
                <tr>
                    <td>
                        Password
                    </td>
                    <td>
                        <input type="password" name="textpassword" id="textpassword" required />

                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" class="btn btn-success" value="Login"/>
                    </td>
                </tr>
            </table>
            <a href="adminforgotpwdform.php">Forgotpassword? Click here</a>
        </form>
    </div>

    <?php
        include('footer.php');
    ?>    
    
</body>
</html>