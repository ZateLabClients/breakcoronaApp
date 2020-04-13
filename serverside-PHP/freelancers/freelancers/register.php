<?php
  if($_POST["password"]==$_POST["password1"]){
  session_start();
  require '../connect.php';

          //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
          $name=$_POST["name"];
          $phone=$_POST["phone"];
          $loc=$_POST["place"];
          $pass=$_POST["password"];
          $wages=$_POST["wages"];
          $job=$_POST["job"];
          $sql = "INSERT INTO freelancers (id, name, password, job, place, phone, status, wages)
          VALUES (NULL, '$name', '$pass', '$job', '$loc', '$phone', 'active', '$wages')";

        if ($conn->query($sql) === TRUE) {
            $_SESSION["id"]=$conn->insert_id;
            header('Location:profile.php');
            echo "Registered successfully";

        } else {

            echo "<script>alert('Error');</script>";
            echo "<script>window.history.go(-1);</script>";
        }


        $conn->close();








}
else{
  echo "<script>alert('Passwords does not match');</script>";
  echo "<script>window.history.go(-1);</script>";
}








?>
