<?php


$lu = $_POST['LoginUser'];
$lp = $_POST['LoginPass'];

//echo $lu;
//echo $lp;


$q = "SELECT * FROM users WHERE username ='$lu' AND password = '$lp'";

$r = mysqli_query($dbc, $q);

if (  mysqli_num_rows($r) == 1 )
{

    $row =  mysqli_fetch_array($r, MYSQLI_NUM);
 //   echo "Logged in as user: " . $row[1];
    $_SESSION['S_user_id'] = $row[0];
    $_SESSION['S_username'] = $row[1];
    $_SESSION['S_password']   = $row[2];
    $_SESSION['S_firstname']   = $row[3];
    $_SESSION['S_lastname'] = $row[4];
    $_SESSION['S_email'] = $row[5];
    $_SESSION['loggedin'] = true;
}
else
{
  //  echo "no match for email and password combination";

}
