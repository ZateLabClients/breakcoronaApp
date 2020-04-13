<?php
  if(isset($_GET["id"])){
    $id=$_GET["id"];
    require '../connect.php';
    $sql="Delete from helpline Where id=$id";
    if($conn->query($sql)===TRUE){
      echo "<script>alert('Deleted succcssfully')</script>";
      echo "<script>window.history.go(-1)</script>";
    }
    else{
      //echo "error:".$conn->error;
      echo "<script>alert('Error')</script>";
      echo "<script>window.history.go(-1)</script>";
    }
  }
?>
