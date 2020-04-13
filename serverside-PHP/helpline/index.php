<?php
    require 'connect.php';
    $sql="SELECT * FROM helpline";
    $result=$conn->query($sql);
?>

<html>
    <head>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="style.css">
  <!-- Font Awesome File -->

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/1.7.3/socket.io.min.js"></script>
  <!-- <script src="/socket.io/socket.io.js"></script> -->
    <script src="https://code.jquery.com/jquery-1.11.1.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js"></script>
        <title>Helplines</title>
    </head>
    <body style="margin-top:58px;">
      <div style="z-index: 100;background-color:#9a4ef1;height: 55px;text-align:center;padding: 8px;color:white;position: fixed;top: 0;width: 100%;">
            <h4>Helplines</h4>
        </div>
    <div class="container app">
    <div class="row app-one">

      <div class="col-sm-4 side">
        <div class="side-one">

            <div class="row sideBar" id="chatlist" style="height:100%">
                <?php
                    if($result->num_rows>0){
                        while($row=$result->fetch_assoc()){
                            echo "<a href=\"tel:".$row["phone"]."\"><div class=\"row sideBar-body\"><div class=\"col-sm-3 col-xs-3 sideBar-avatar\"><div class=\"avatar-icon\"><img src=\"phone.png\" style=\"width:55;height:55\"></div></div><div class=\"col-sm-9 col-xs-9 sideBar-main\"><div class=\"row\"><div class=\"col-sm-8 col-xs-8 sideBar-name\"><span>".$row["name"]."(".$row["state"].")</span><br></div></div></div></div></a>";
                        }
                    }
                    else{
                        echo "<div style=\"margin-top:45%;\" class=\"centered\"><center>No records</center></div>";
                    }
                    $conn->close();
                ?>

                <!-- <div class="row sideBar-body"><div class="col-sm-3 col-xs-3 sideBar-avatar"><div class="avatar-icon"><img src="https://www.apkmirror.com/wp-content/uploads/2016/12/584748d9e286d.png" style="width:55;height:55"></div></div><div class="col-sm-9 col-xs-9 sideBar-main"><div class="row"><div class="col-sm-8 col-xs-8 sideBar-name"><span class="name-meta">Disha helpline</span><br></div></div></div></div> -->

            </div>

        </div>


      </div>



    </div>


    </div>
    </body>
</html>
