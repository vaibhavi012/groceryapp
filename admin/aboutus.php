<?php
    session_start();
    if(empty($_SESSION))
    {
        header('location:../adminsigninform.php');
    }
?>
<html>
    <head>
        <title>About us</title>
        <?php
            include("headerlink.php");
        ?>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
            <?php
                include('aboutheader.php');
            ?>
        <h1>WHO WE ARE?</h1></br>
        <p>We are the wholesaler or individual that purchases great quantities of products
            from Manufacturers,Farmers,other producers and vendors.</p>

        <p>We store them in warehouses and sell them on to retailers(shops and stores) and
            businesses.We are the merchant middlemen who sell mainly to retailers,other merchants,
            commercial,industrial or institutional users.They buy principaly for resale or business use.</p>

        <h1>OUR STORY:</h1></br>
        <p>Our shop "VEERABHADRESHWAR TRADERS" was started in the year 1992.This shop is owned by Mahantesh Pattanshetty
            and it is being managed and handled by himself.It is located near subhas road balikai wakar cross Dharwad.</p>

        <h1>BUSINESS TIMING:</h1></br>
            <p>Monday to Saturday :- 8am to 10pm</p>
            <p>Sunday:- 10am to 2pm</p>

        <h1>OUR MISSION:</h1>
        <p>To satisfy our patners and customers with a unique shopping experience offering quality,variety,
            price and service based on the attention and commitment of our emplyoees.
            "COMMITTED WORKERS,SATISFIED CUSTOMERS".
            Our website allows you the pleasure of shopping from your business place,your office,your home without
            navigating crowded aisles and lengthy cashier lines.</p>

        <h1>Contact us:</h1>
        <p>email:-mahanteshpattanshetty@gmail.com</p>
        <p>call:-9343401845</p>
        <?php
        include('aboutfooter.php');
        ?>
    </body>
</html>







