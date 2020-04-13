<?php
session_start(); // Starting Session

if ( ($_POST['otp']==$_SESSION["otpxx"]) AND isset($_SESSION['otpxx']) AND !empty($_SESSION['otpxx']) ) {

$username=$_POST['sname'];
$num=$_SESSION["snum"];
$pin = rand(10000, 999999);  // create random pin

                              // num already sessioned on sent.php
$_SESSION["sname"]=$username; // Initializing Session
$_SESSION["pin"]=$pin; // Initializing Session
$_SESSION["logedin"]='yes';


// To protect MySQL injection for Security purpose
$username = stripslashes($username);
$num = stripslashes($num);


// insert into Database
$link = mysqli_connect("localhost", "breakthechainUser", "Y3dYJ86LCZ5hrGhL", "breakthechainDB");
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
$sql = "INSERT INTO users (name,num,pin) VALUES ('$username', '$num', '$pin')
        ON DUPLICATE KEY UPDATE pin='$pin' ";

if(mysqli_query($link, $sql)){
// echo "<h4>Data Updated succesfully</h4>";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}


        setcookie('logname', $username, time() + (86400 * 365), "/"); // 86400 = 1 day
        setcookie('lognum', $num, time() + (86400 * 365), "/"); // 86400 = 1 day
        setcookie('pin', $pin, time() + (86400 * 365), "/"); // 86400 = 1 day
        header("location: ../index2.php?name=".$username."&mob=".$num); // Redirecting To Other Page


} //end of main if
else {
  echo "invalid otp";
}
?>
