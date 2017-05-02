<?php


require ("config.inc.php");

require (MYSQL);


//handle login attempt
if (   $_SERVER['REQUEST_METHOD'] == 'POST'   )
{
      include('login.inc.php');

}

include ("html/header.html");
?>
    <style>
        <?php include 'html/Styles/MenuStyle.css';
        ?>

    </style>
    <article class="content">


        <span class="headertext">
        <?php
            
    if (!isset($_SESSION['loggedin'])){
        echo 'Welcome to Power House Pizza';
    }
    else{
        echo 'Welcome back to Power House Pizza ';
        echo  ucwords($_SESSION['S_firstname']);
    }
            ?>
        </span>
        <p> Purchase our freshly made pizza that are totally not from the fidge and definely not stole from other pizza co. We made our pizza from the freshest ingredients and cooked in our special secert <strong>Power House Sauce</strong></p>

        <!-- end .content -->
    </article>

    <?php

echo '<h1>Check out our specials</h1>';

$query = "SELECT * FROM products WHERE type LIKE 'special'";
$r = mysqli_query($dbc, $query);


?>
        <form id="menuForm" method='POST' action='cart.php'>
            <ul class="products">
                <?php
while (   $row = mysqli_fetch_array($r, MYSQLI_NUM)  )
{
    ?>


                    <?php
        echo '<li class="productbox">';
        echo '<img class="productimage" src="' . $row[5] . '"/>';
        echo '<p id="titlep">' . $row[1] . ' </p>';
        echo '<div class="floating-box"><p>' . $row[2]. '</p></div>';
    
         $priceformat = number_format($row[3], 2, '.', ',');
         echo '<div><p id="spandisplay" style="float: left; width: 50%; text-align: center;">$' . $priceformat . '</p>';
    
         echo '<p id="buttondisplay" style="float: left; width: 50%; text-align: center;"><button name="menusubmit" class="myButton" type="submit" value="' . $row[0] . '">Buy Me!</button></p></div></li>';
}?>
            </ul>
        </form>
        <?php

include ("html/footer.html");



?>
