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

    <?php
//INSERT INTO `products` (`product_id`, `name`, `description`, `price`, `type`, `imagelink`, `blobimage`) VALUES (NULL, '', '', '', '', NULL, NULL)

$query = "SELECT * FROM products";
$r = mysqli_query($dbc, $query);

//echo "hello";
        ?>
        <form id="menuForm" method='POST' action='cart.php'>
            <ul class="products">
                <?php
while (   $row = mysqli_fetch_array($r, MYSQLI_NUM)  )
{
    ?>


                    <?php
        //echo '<a href="#">'; 
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
