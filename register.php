<?php


require ('config.inc.php');
require ('html/header.html');
require(MYSQL); 

if ($_SERVER['REQUEST_METHOD']  == 'POST')    {

    // echo $_POST['first_name'];
     $un = $_POST['Inputusername'];
     $pw = $_POST['Inputpassword'];
     $fn = $_POST['Inputfirst_name'];
     $ln = $_POST['Inputlast_name'];
     $em = $_POST['Inputemail'];

    
    
    
     $q ="INSERT INTO `users` (`username`, `password`, `first_name`, `last_name`, `email`) VALUES ('$un', '$pw', '$fn', '$ln', '$em')";
     $r = mysqli_query($dbc, $q);

if($r)
{
    echo "<span ></span>";
    
    
    //*****************************************
    //this puts a redirection on the page for the user to see
    //*****************************************
    
   echo" <p id='errormessage'>
   <br />Registration was successful<br /> 
   You will be redirected to login in 
   <span id='counter'>5</span> second(s).
   </p><script type='text/javascript'>
function countdown() {
    var i = document.getElementById('counter');
    if (parseInt(i.innerHTML)<= 1) {
        location.href = 'index.php';
    }
    i.innerHTML = parseInt(i.innerHTML) - 1;
}
    setInterval(function(){ countdown(); },1000);
    </script>

";
}
else
{
$w ="SELECT * FROM users WHERE username= '$un'";
$x = mysqli_query($dbc, $w);   
    if (  mysqli_num_rows($x) == 1)
{
        echo "<span id='errormessage'><br />Your desired USERNAME is already taken</span>";
}
else
{
   //nothing
}
$y ="SELECT * FROM users WHERE email= '$em'";
$z = mysqli_query($dbc, $y);   
    if (  mysqli_num_rows($z) == 1)
{
        echo "<span id='errormessage'><br />Your desired EMAIL ADDRESS is already taken</span>";
}
else
{
    //not issue
}
}
}
?>

    <style>
        <?php include 'html/Styles/RegisterStyle.css';
        ?>

    </style>

    <div id="registerdiv">
        <form id="registerform" action="register.php" method="post">
            <label for="fname">Username</label>
            <input type="text" name="Inputusername" placeholder="Choose your Username..">

            <label for="lname">Password</label>
            <input type="text" id="lname" name="Inputpassword" placeholder="Your Password..">

            <label for="lname">First Name</label>
            <input type="text" id="lname" name="Inputfirst_name" placeholder="Your First Name..">

            <label for="lname">Last Name</label>
            <input type="text" id="lname" name="Inputlast_name" placeholder="Your Last Name..">

            <label for="lname">Email Address</label>
            <input type="text" name="Inputemail" placeholder="Your Email Address..">

            <input type="submit" name="submit_button" />
        </form>
    </div>


    <?php

include ('html/footer.html');

?>
