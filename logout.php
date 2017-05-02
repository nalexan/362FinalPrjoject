<?php
//logout.php
require ('config.inc.php');

//destroy the session
$_SESSION = array();
session_destroy();
redirect_invalid_user();
include('/html/header.html');
echo '<h3> Logged out successfully </h3>';
include('/html/footer.html');
?>
