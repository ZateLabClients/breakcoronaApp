

<html>
  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Helplines</title>
  </head>
  <body>

<div class="container">
<h1>Helplines</h1>
<div class="text-center">
<table class="table table-hover">
  <thead><tr><th>Id</th><th>Name</th><th>Phone</th><th>State</th></tr></thead>
  <tbody>
<?php
  require '../connect.php';
  $sql="Select * From helpline";
  $result=$conn->query($sql);
  if($result->num_rows>0){
    while($row=$result->fetch_assoc()){
      echo "<tr><td>".$row["id"]."</td><td>".$row["name"]."</td><td>".$row["phone"]."</td><td>".$row["state"]."</td><td><button onclick=location.href='delete.php?id=".$row["id"]."' class='btn btn-danger'>delete</button></td></tr>";
    }
  }

  $conn->close();
?>
</tbody>
</table>
</div>
</div>
  </body>
</html>
