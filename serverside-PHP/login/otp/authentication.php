<?php
session_start();
if ( !( ($_GET['q']==$_SESSION["otpxx"]) AND isset($_SESSION['otpxx']) AND !empty($_SESSION['otpxx']) ) ) { // not if
  echo "invalid OTP"; //its not if
}
 ?>
