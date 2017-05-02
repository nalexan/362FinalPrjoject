<?php

define ('BASE_URI','/wamp64/www/its362/projectSample/');
define ('BASE_URL', 'localhost');
define ('MYSQL', BASE_URI . 'mysql.inc.php');


//start the session
session_start();

function redirect_invalid_user()
{
//check the session item
	if (!isset($_SESSION['loggedin']))
	{
		$url="http://localhost/its362/projectSample/index.php";
		header("Location: $url");
       // echo "<p>Please Log in<p>";
		exit();
	}
}
		


// helper function
