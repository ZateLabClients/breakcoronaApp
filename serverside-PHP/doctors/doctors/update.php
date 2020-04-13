<?php
  session_start();
  require '../connect.php';
  $status=$_GET["q"];
  $id=$_SESSION["id"];
  $sql="Update doc set status='$status' where id=$id";
  if($conn->query($sql)===TRUE){
    echo "done";
  }
  else{
    echo "error";
  }
?>
