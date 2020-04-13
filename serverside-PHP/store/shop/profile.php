<?php
session_start();
?>
<html>
  <head><meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <title>Profile</title>
  </head>
  <body>
<?php

  if(isset($_SESSION["id"])){
  require '../connect.php';
  $id=$_SESSION["id"];
  $sql="Select id,name,s_name,location,phone,status,w_hrs from stores where id=$id";
  $result=$conn->query($sql);
  $row=$result->fetch_assoc();
  $loc=urlencode($row["location"]);
  $conn->close();

?>

<div class="container">
  <h2>Profile</h2>
  <div class="text-center">
    <div class="embed-responsive embed-responsive-16by9">
      <iframe id="gmap_canvas" src="https://maps.google.com/maps?q=<?php echo $loc;?>&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>

    </div>


<?php
  //echo $row["id"]."\n".$row["name"]."\n".$row["qualification"]."\n".$row["phone"]."\n".$row["status"];
  echo "<h3>".$row["name"]."</h3>";
  ?>
</div>
<h4>About</h4>
  <?php
  echo "Phone:".$row["phone"]."<br>";
  echo "Shop name:".$row["s_name"]."<br>";
  echo "Address:".$row["location"]."<br>";
  echo "Working Hours:".$row["w_hrs"]."<br>";
  echo "Status:".$row["status"]."<br>";
}
  ?>
<div class="text-center">
  <?php
  if($row["status"]=='active'){
    echo "<button onclick=\"update('inactive')\" class='btn btn-danger'>I am not ready</button>";
  }
  else{
    echo "<button onclick=\"update('active')\" class='btn btn-success'>I am ready</button>";
  }
  ?>





</div>
</div>




















</body>
</html>

<script>
function update(str) {
    if (str.length == 0) {
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                location.reload();
            }
        };
        xmlhttp.open("GET", "update.php?q=" + str, true);
        xmlhttp.send();
    }
}
</script>
