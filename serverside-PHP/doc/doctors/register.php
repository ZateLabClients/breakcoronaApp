<?php
  if($_POST["password"]==$_POST["password1"]){
  session_start();
  require 'connect.php';



  $target_dir = "uploads/";
  $target_file = $target_dir . basename($_FILES["image"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  // Check if image file is a actual image or fake image
  if(isset($_POST["submit"])) {
      $check = getimagesize($_FILES["image"]["tmp_name"]);
      if($check !== false) {
          //echo "File is an image - " . $check["mime"] . ".";
          $uploadOk = 1;
      } else {
          echo "File is not an image.";
          die();
          $uploadOk = 0;
      }
  }
  // Check if file already exists
  if (file_exists($target_file)) {
      echo "Sorry, file already exists.";
      die();
      $uploadOk = 0;
  }


  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif" ) {
      echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";

      $uploadOk = 0;
      die();
  }
  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
  } else {
      $target_file=$target_dir.$_POST["phone"].".".$imageFileType;
      if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
          //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
          $name=$_POST["name"];
          $target_file="http://lets-write.000webhostapp.com/covid/doctors/".$target_file;
          $phone=$_POST["phone"];
          $qual=$_POST["qualification"];
          $pass=$_POST["password"];
          $sql = "INSERT INTO doctors (id, name, phone, password, qualification, status, pic)
          VALUES (NULL, '$name', '$phone', '$pass', '$qual', 'active', '$target_file')";

        if ($conn->query($sql) === TRUE) {
            $_SESSION["id"]=$conn->insert_id;
            header('Location:profile.php');
            echo "Registered successfully";

        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }


        $conn->close();






      } else {
          echo "Sorry, there was an error uploading your file.";

          die("Sorry");
      }
  }
}
else{
  echo "Passwords doesn't match";
}








?>
