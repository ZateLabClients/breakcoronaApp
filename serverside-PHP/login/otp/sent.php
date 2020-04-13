<?php
session_start();
$mob= $_GET['q'];
// sms

require('textlocal.class.php');
define("API_KEY",'..........');

$textlocal = new Textlocal(false, false, API_KEY);

$numbers = array($mob);
$sender = '......';
$otp = rand(1000, 9999);
$_SESSION["otpxx"]=$otp;
$_SESSION["snum"]=$mob;

$message = 'Thank you for using BreakTheChain App. Your verification code is ' . $otp;

try {
    $result = $textlocal->sendSms($numbers, $message, $sender);
		// $otp = "1234";
} catch (Exception $e) {
		echo "Error: Please check the mobile number you entered (".$mob.")";
    die('');
}
 ?>
