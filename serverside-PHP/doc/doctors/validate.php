<?php
  session_start();
  require 'connect.php';
  $phone=$_POST["phone"];
  $pass=$_POST["password"];
  $sql="Select id from doctors Where phone='$phone' And password='$pass'";
  $result=$conn->query($sql);
  if($result->num_rows>0){
    $row=$result->fetch_assoc();
    $_SESSION["id"]=$row["id"];
    header('Location:profile.php');
    echo "Please wait....";
  }
  else{
    echo "<script>window.history.go(-1);</script>";
  }
  $conn->close();

?>
