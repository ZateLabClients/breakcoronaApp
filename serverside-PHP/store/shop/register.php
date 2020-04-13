<?php
  if($_POST["password"]==$_POST["password1"]){
  session_start();
  require '../connect.php';

          //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
          $name=$_POST["name"];
          $phone=$_POST["phone"];
          $loc=$_POST["location"];
          $pass=$_POST["password"];
          $working=$_POST["working"];
          $s_name=$_POST["s_name"];
          $sql = "INSERT INTO stores (id, name, password, s_name, location, phone, status, w_hrs)
          VALUES (NULL, '$name', '$pass', '$s_name', '$loc', '$phone', 'active', '$working')";

        if ($conn->query($sql) === TRUE) {
            $_SESSION["id"]=$conn->insert_id;
            header('Location:profile.php');
            echo "Registered successfully";

        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }


        $conn->close();








}
else{
  echo "Passwords doesn't match";
}








?>
