<?php
    session_start();
    if(empty($_SESSION))
    {
        header('location:../customersigninform.php');
    }
?>
<html>
    <head>
        <title>Feedback </title>
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
          <h1>FeedBack</h1></br>
            <form method="POST" action="feedback.php">
                <table class="table" style="font-weight:bold; width:100%;" >
                <tr><th>Rating</th></tr>
                  <tr>
                      <td><input type="radio" name="rating" id="radioexcellent" value="Excellent"><span style="padding-left:25px;">Excellent</span></td>
                    </tr>
                    <tr>
                        <td><input type="radio" name="rating" id="radiogood" value="Good" ><span style="padding-left:25px;">Good</span></td>
                    </tr>
                    <tr>
                      <td><input type="radio" name="rating" id="radioaverage" value="Average"><span style="padding-left:25px;">Average</span></td>
                    </tr>
                    <tr>
                      <td><input type="radio" name="rating" id="radiopoor" value="Poor"><span style="padding-left:25px;">Poor</span></td>
                    </tr>
                    
                    <tr>
                      <td>Description 
                        <textarea cols="30" rows="3" name="textdesc" id="textdesc" required></textarea>
                    </td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="submit" class="btn btn-success" name="btn" value="Submit"></td>
                </table>
            </form>
        </div>
    </div>
    <?php
        include('footer.php');
    ?>
    </body>
</html>
