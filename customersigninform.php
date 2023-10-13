<html>
    <head>
        <title>Customer SignIn</title>
        <?php
            include("headerlink.php");
        ?>
    </head>
<body>
    <?php
        include('header.php');
    ?>
    <div align="center">
        
        <form method="POST" action="customersignin.php">
        <h2>Customer SignIn</h2></br>
            <table>
                <tr>
                    <td>
                        EmailId
                    </td>
                    <td>
                        <input type="email" name="textemail" id="textemail" required autofocus />

                    </td>
                </tr>
                <tr>
                    <td>
                        Password
                    </td>
                    <td>
                        <input type="password" name="textpassword" id="textpassword" rquired />

                    </td>
                </tr>
                <tr>
                    <td>
                        <a href="customersignupform.php">New user? Sign Up</a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" class="btn btn-success" value="Login"/>
                    </td>
                </tr>
            </table>
            <a href="forgotpwdform.php">Forgotpassword? Click here</a>
        </form>
    </div>
    <?php
        include('footer.php');
    ?>
</body>
</html>