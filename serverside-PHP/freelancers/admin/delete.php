<?php
  if(isset($_GET["id"])){
    $id=$_GET["id"];
    require '../connect.php';
    $sql="Delete from freelancers Where id=$id";
    if($conn->query($sql)===TRUE){
      echo "deleted succcssfully";
    }
    else{
      echo "error:".$conn->error;
    }
  }
?>
