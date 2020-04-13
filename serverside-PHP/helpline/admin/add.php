<?php

        $name=$_GET["name"];
        $phone=$_GET["phone"];
        $state=$_GET["state"];
        require 'connect.php';
        $sql="Insert Into helpline (name,phone,state) Values('".$name."','".$phone."','".$state."')";
        if($conn->query($sql)===TRUE){
            echo "<script>alert('Added successfully');</script>";
            echo "<script>window.history.go(-1);</script>";
        }
        else{
            echo "<script>alert('Error adding helpline');</script>";
            echo "<script>window.history.go(-1);</script>";
        }
        $conn->close();
  
?>
