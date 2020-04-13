<html>
<head>
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">


  <meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Chat with Doctors</title>
<style>
.header {
overflow: hidden;
background-color: #f1f1f1;
padding: 20px 10px;
}




@media screen and (max-width: 500px) {
.header a {
  float: none;
  display: block;
  text-align: left;
}


}
</style>
</head>
<body>
  <div style="z-index: 100;background-color:#9a4ef1;height: 55px;text-align:center;padding: 8px;color:white;position: fixed;top: 0;width: 100%;">
      <h4>Doctors</h4>
  </div>
<div style="margin-top:46px;" class="header"><a href="doctors/login.html" style="text-decoration: none !important;">If you are a Doctor please signup/login to add your service by clicking here</a></div>
  <div class="container">
    <!-- <h2>Doctors</h2> -->
  </div>
  <?php
    require 'connect.php';
    $sql="Select id,name,phone,qualification,pic From doc where status='active'";
    $result=$conn->query($sql);
    if($result->num_rows>0){
      while($row=$result->fetch_assoc()){
        ?>
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card">

                <div class="card-body">
                  <div class="text-center">
                    <img class="img-fluid" src="<?php echo $row["pic"];?>" alt="Card image cap">
                  </div>
                    <h4 class="card-title"><?php echo $row["name"]; ?></h4>
                    <p class="card-text"><?php echo $row["qualification"];?></p>
                    <div class="row">
                        <div class="col">
                            <button class="btn btn-success btn-block" onclick="this.blur();location.href='https://wa.me/<?php echo "+91".$row["phone"];?>'">Chat with <?php echo "Dr.".$row["name"];?></button>
                            <!-- <a href="https://wa.me/<?php echo $row["phone"];?>" class="btn btn-success btn-block">Chat with doctor</a> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

      <?php
      // echo "<img src='".$row["pic"]."'><br>";
      // echo "Name:".$row["name"]."<br>";
      // echo "Qualification:".$row["qualification"]."<br>";
      // echo "Phone:".$row["phone"]."<br>";
    }
    }

  ?>


  <!-- <button style="border-radius:40px;bottom: 40;right: 20;position: fixed;z-index: 3000;" class="btn btn-primary btn-floating shadow-sm" onclick="location.href='doctors/login.html'">Login</button> -->



</body>
</html>
