<?php


require ('config.inc.php');
redirect_invalid_user();


require(MYSQL); 

if ($_SERVER['REQUEST_METHOD']  == 'POST')    {
//handles the adding
    // set the variables that are being added to the cart
      $inputvar = $_POST['menusubmit'];
    array_push($_SESSION['cart'],$inputvar);
    //product id number}
}
include ('html/header.html');
?>
    <style>
        <?php include 'html/Styles/MenuStyle.css';
        include 'html/Styles/OrderStyle.css';
        ?>

    </style>

    <?php

if (empty($_SESSION['cart'])){
    $_SESSION['cart'] = array();
    }
    

    ?>
        <article class="content"><span class="headertext">Shopping Cart</span></article>

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
foreach ($_SESSION['cart'] as $k => $v)  {
    
$query = "SELECT `products`.`name`, `products`.`description`, `products`.`price`
FROM `products`
WHERE (`products`.`product_id` = '$v')";

$r = mysqli_query($dbc, $query);
$row = mysqli_fetch_array($r, MYSQLI_NUM);


$altrow = false;
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
    $orderTotal = $orderTotal + $row[2];
    echo "$" . $row[2];
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


                        <tr>
                            <td></td>
                            <td></td>
                            <td>
                                <p id="buttondisplay" style="float: left; width: 50%; text-align: center;"><button name="menusubmit" class="myButton" type="submit" value="">Reset Cart</button></p>
                                <p id="buttondisplay" style="float: left; width: 50%; text-align: center;"><button name="menusubmit" class="myButton" type="submit" value="">Complete Orders</button></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <?php 

include ('html/footer.html');

?>
