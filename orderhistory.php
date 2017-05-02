<?php


require ('config.inc.php');
redirect_invalid_user();


require(MYSQL); 

if ($_SERVER['REQUEST_METHOD']  == 'POST')    {

    // set the variables that are being added to the cart
     // $inputvar = $_POST['menusubmit'];

}
include ('html/header.html');
?>
    <style>
        <?php include 'html/Styles/MenuStyle.css';
        include 'html/Styles/OrderStyle.css';
        ?>

    </style>

    <?php

$orderHistoryquery = $_SESSION['S_user_id'];
//Query to generate our orders for the customer that is logged in
$query = "SELECT `orders`.`order_id`, `orders`.`total_price`, `orders`.`timestamp`
        FROM `users`
        LEFT JOIN `orders` ON `orders`.`user_id` = `users`.`user_id`
        WHERE (`users`.`user_id` = '$orderHistoryquery')";

$r = mysqli_query($dbc, $query);

//echo "hello";
?>
        <article class="content"><span class="headertext">Order History for <?php echo (ucwords($_SESSION['S_firstname']) . " " . ucwords($_SESSION['S_lastname']));?></span></article>

        <form id="historyForm" method='POST' action='orderdetails.php'>
            <div class="content">
                <div class="datagrid">
                    <table>
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Total Price</th>
                                <th>Order Time</th>
                                <th>Details</th>
                            </tr>
                        </thead>
                        <tbody>



                            <?php
$altrow = false;
while (   $row = mysqli_fetch_array($r, MYSQLI_NUM)  )
{
   if ($altrow == false){
       echo '<tr>';
       $altrow = true;
   }
    else{
        $altrow = false;
       echo  '<tr class="alt">';
    }
echo '<td>';
    echo $row[0];
    echo'</td><td>';;
    echo $row[1];
    echo '</td><td>';
    echo $row[2];
    echo '</td><td>';
    
    echo '<p id="buttondisplay" style="float: left; width: 100%; text-align: center;"><button name="viewdetailbtn" class="" type="submit" value="' . $row[0] . '">View Order Details!</button></p></div></li>';
 
    
    echo '</td></tr>';

}
?>
                        </tbody>
                    </table>
                </div>
            </div>
        </form>


        <?php


include ('html/footer.html');

?>
