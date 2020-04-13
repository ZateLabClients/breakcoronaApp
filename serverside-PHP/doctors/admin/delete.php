<?php
  if(isset($_GET["id"])){
    $id=$_GET["id"];
    $pic=$_GET["pic"];
    $target= str_replace("http://zateart.com/covidapp2/doctors/", '', $pic);
    $target="../".$target;
    echo $target;

    require '../connect.php';
    $sql="Delete from doc Where id=$id";
    if($conn->query($sql)===TRUE){
      echo "deleted succcssfully";
      if(file_exists($target)){
        unlink($target);
      }
    }
    else{
      echo "error:".$conn->error;
    }
  }
?>
