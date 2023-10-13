<?php
    session_start();
    $_SESSION["searchtype"]="regular";
    if(empty($_SESSION))
    {
        header('location:../customersigninform.php');
    }
    //set up connection
    $conn=new PDO("mysql:host=localhost;dbname=grocerydb","root",null);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //create arrays
    $catid=array();
    $catname=array();
    //prepere select statemnt
    $stmt=$conn->prepare("select * from category");
    $stmt->execute();
    //push rows into arrays
    while($row=$stmt->fetch(PDO::FETCH_ASSOC))
    {
        array_push($catid,$row["catid"]);
        array_push($catname,$row["catname"]);
    }
    $conn=null;
?>

<html>
<head>
    <title>View categories</title>
    <?php
        include('headerlink.php');
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
            <h1>Category List</h1></br>
            <table class="table table-hover" style="font-weight:bold;">
                <?php
                    $len=count($catid);
                    for($i=0;$i<$len;$i++)
                    {
                        echo "<tr>";
                        $querystring='id='.$catid[$i].'&name='.urlencode($catname[$i]);
                        echo "<td><a href=browseproducts.php?" . $querystring .">" . $catname[$i] . "</a></td>";
                        $i++;
                        if ($i<$len)
                        {
                            $querystring='id='.$catid[$i].'&name='.urlencode($catname[$i]);
                            echo "<td><a href=browseproducts.php?" . $querystring .">" . $catname[$i] . "</a></td>";        
                        }
                        echo "</tr>";
                    }
                ?>
            </table>
        </div>
    </div>
    <?php
        include('footer.php');
    ?>
</body>
</html>