
<html>
<head>
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">


  <meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Chat with Doctors</title>
</head>
<body>
  <div style="background-color:#9a4ef1;height: 44px;text-align:center;padding: 8px;color:white;">
      Doctors
  </div>
  <div class="container">
    <h2></h2> <br>
    Hello users.. Doctor consultation service is not started now.. <br>
    You will be notified when this service starts... <br><br>
  </div>
  <?php
    require 'connect.php';
    $sql="Select id,name,phone,qualification,pic From doctors where status='active'";
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
                          <!-- location.href='https://wa.me/<?php echo "+91".$row["phone"];?>' -->
                            <button class="btn btn-success btn-block" onclick="this.blur();">Chat with <?php echo "Dr.".$row["name"];?></button>
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




</body>
</html>
