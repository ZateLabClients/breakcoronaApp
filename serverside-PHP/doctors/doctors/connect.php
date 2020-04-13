<?php
$servername = "localhost";
$username = "id9345893_doc";
$password = "docdoc";
$dbname = "id9345893_doc";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

 ?>
