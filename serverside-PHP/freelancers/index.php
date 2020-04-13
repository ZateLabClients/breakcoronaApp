<html>
<head>
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">


  <meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Call Freelancers</title>
<style>
.header {
overflow: hidden;
background-color: #f1f1f1;
padding: 20px 10px;
}

.head {
    background-color: #9a4ef1;
    height: 28px;
    text-align: center;
    padding: 8px;
    color: white;
    position: fixed;
    top: 0;
    width: 100%;
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
      <h4>Freelancers</h4>
  </div>
  <!-- <div class="head">Shop Owners</div> -->
  <div style="margin-top:46px;" class="header"><a href="freelancers/login.html" style="text-decoration: none !important;">If you are a Freelancer please signup/login to add your service by clicking here</a></div>
  <form method="get" action="search.php"><div class="input-group mb-4 border rounded-pill p-1">
            <input type="search" name="place" id="search" placeholder="Search by place!!!" aria-describedby="button-addon3" class="form-control bg-none border-0">
            <div class="input-group-append border-0">
              <button id="button-addon3" type="submit" class="btn btn-link text-primary" onclick="search();"><i class="fa fa-search"></i></button>
            </div>
          </div></form>
          <!-- <button type="button" class="btn btn-info" name="button">Click Here to find Nearest Store</button> -->
  <div class="container">
    <h2></h2>
  </div>
  <?php
    require 'connect.php';
    $sql="Select id,name,job,place,phone,wages From freelancers where status='active'";
    $result=$conn->query($sql);
    if($result->num_rows>0){
      while($row=$result->fetch_assoc()){
        ?>
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card">

                <div class="card-body">
                  <div class="text-center">
                    <div class="embed-responsive embed-responsive-16by9">
                      <iframe id="gmap_canvas" src="https://maps.google.com/maps?q=<?php echo $row["place"];?>&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>

                    </div>
                  </div>
                    <h4 class="card-title"><?php echo $row["name"]."(".$row["job"].")"; ?></h4>
                    <div class="card-text"><?php echo "Place:".$row["place"];?></div>
                    <div class="card-text"><?php echo "Min. wages:&#x20b9;".$row["wages"];?></div>
                    <div class="row">
                        <div class="col">
                            <button class="btn btn-success btn-block" onclick="this.blur();location.href='tel:<?php echo "+91".$row["phone"];?>'">Call <?php echo $row["name"];?></button>
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
<!-- <button style="border-radius:40px;bottom: 40;right: 20;position: fixed;z-index: 3000;" class="btn btn-primary btn-floating shadow-sm" onclick="location.href='shop/login.html'">Login</button> -->



</body>
</html>


<script>
  function search(){
    var q=document.getElementById('search').value;
    window.open("search.php?place="+q);
  }
</script>
