<?php
$servername = "localhost";
$username = "breakthechainUser";
$password = "Y3dYJ86LCZ5hrGhL";
$dbname = "breakthechainDB";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

 ?>
