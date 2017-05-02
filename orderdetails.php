<?php

require ('config.inc.php');
redirect_invalid_user();
require(MYSQL); 

if ($_SERVER['REQUEST_METHOD']  == 'POST')    {

    // set the variables that are being added to the cart
      $detailvar = $_POST['viewdetailbtn'];

}
include ('html/header.html');
?>
    <style>
        <?php include 'html/Styles/MenuStyle.css';
        include 'html/Styles/OrderStyle.css';
        ?>

    </style>

    <?php

//Query to generate our orders for the customer that is logged in
$query = "SELECT `products`.*, `users`.`user_id`
    FROM `products`
    LEFT JOIN `order_items` ON `order_items`.`product_id` = `products`.`product_id`
    LEFT JOIN `orders` ON `order_items`.`order_id` = `orders`.`order_id`
    LEFT JOIN `users` ON `orders`.`user_id` = `users`.`user_id`
    WHERE (`orders`.`order_id` = '$detailvar')";

$r = mysqli_query($dbc, $query);

?>
        <article class="content"><span class="headertext">Details for Order Number <?php echo $detailvar;?></span></article>

        <div class="content">
            <div class="datagrid">
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>



                        <?php
$orderTotal = 0;
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
    echo $row[1];
    echo'</td><td>';;
    echo $row[2];
    echo '</td><td>';
    $orderTotal = $orderTotal + $row[3];
    echo "$" . $row[3];
    echo '</td></tr>';

}
?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>Order Sub-Total:
                                    <?php echo "$" . number_format($orderTotal, 2, '.', ','); ?>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <?php $orderTax = number_format($orderTotal * .07,2, '.', ',');  ?>
                                <td>Order Tax:
                                    <?php echo "$" . $orderTax//echo "$" . number_format($orderTotal, 2, '.', ','); ?>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <?php $orderTotal = $orderTotal + $orderTax; ?>
                                <td>Order Total:
                                    <?php echo "$" . number_format($orderTotal, 2, '.', ','); ?>
                                </td>
                            </tr>
                    </tbody>
                </table>
            </div>
        </div>


        <?php


include ('html/footer.html');






//1 set the session variables for the passing of the clicked view detail button
