<?php
session_start();



// $_SESSION["snum"]=$_GET['snum'];
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <!-- <meta http-equiv="refresh" content="2"> -->
    <meta charset="utf-8">
    <title></title>

<style media="screen">
  body{
    background-color: white;
    margin: 0px;
  }
  .sub{
    background-color:#f1f1f1;
    padding:15px 22px;
    font-family: Arial, Helvetica, sans-serif;
    line-height: 19px;
    margin-bottom: 8px;
    overflow: auto;
    border-radius: 6px;
  }
  .s0{
    width: 15%;
    background-color: grey;
    float: left;
    border-radius: 50px;
    overflow: hidden;
  }
  .s1{
    width: 77%;
    padding-left: 8px;
    /* background-color: red; */
    float: left;
  }
  .s2{
    float: right;
    font-size: 12px;
    padding: 1px 6px;
    color: white;
    background-color: #16be48;
    border-radius: 3px;
  }
  .t1{
    font-weight: bold;
    font-size: 15px;
    color: #551A8B;
  }
  .t2{
    color: grey;
    font-size: 14px;
    font-family: "Times New Roman", Times, serif;
  }
  #header{
    height:35px;
    background-color:#047bd5;
    text-align: center;
    font-weight: bold;
    font-size: 17px;
    color: white;
    padding: 15px 10px 15px 15px;
    margin-bottom: 8px;
  }
  button{
    border: none;
    border-radius: 3px;
  }
</style>

  </head>
  <body>

    <div id="header">
        ChatApp
      <div style="float:right;font-size: 14px;">
        <button type="button" name="button" onclick="logout()">Logout</button>
      </div>
    </div>

<?php
if ($_SESSION['logedin'] != 'yes') {
  die('<center>Please restart your app</center>');
}
 ?>


    <div style="width:100%;">

      <a href="index.php?admin=MtVlog Official Group&status=Ask Your Doubts&id=grp1">
      <div class="sub">
        <div class="s0">
          <img src="1.jpg" width="100%" alt="">
        </div>
        <div class="s1">
          <div class="t1">MtVlog Official Group <font color="red" > &#10004;</font></div>
          <div class="t2">Ask Your Doubts</div>
        </div>
        <div class="s2"></div>
      </div>
      </a>

<?php

$con = mysqli_connect("Localhost", "mtvlog_in_db", "j44tjx8ycxLaz6pRjanz", "mtvlog_in_db");
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

$sql="SELECT * FROM admins WHERE disabled = 'no' ORDER BY rank ";
$result = mysqli_query($con,$sql);

while($row = mysqli_fetch_array($result)) {
                // <span class=\"message-data-time\">" . $row['time'] . "</span>\n
                echo "<a href=\"index.php?admin=" . $row['name'] . "&status=" . $row['status'] . "&id=" . $row['chatid'] . "\">\n";
                echo "      <div class=\"sub\">\n";
                echo "        <div class=\"s0\">\n";
                echo "          <img src=\"" . $row['pic'] . "\" width=\"100%\" alt=\"\">\n";
                echo "        </div>\n";
                echo "        <div class=\"s1\">\n";
                echo "          <div class=\"t1\">" . $row['name'] . "</div>\n";

// h:
$last=$row['status'];
//
$chat = $row['chatid'];
$numss = $_SESSION["snum"];
$count=0;
$sql2="SELECT mode FROM $chat WHERE num=$numss ORDER BY msgid DESC LIMIT 30";
$result2 = mysqli_query($con,$sql2);
while($row2 = mysqli_fetch_array($result2)) {
  // $last = $row2['msg'];
  $mode = $row2['mode'];

  if ($mode=='to') {
    $count = $count+1;
    $green = $count;
  }
  else {
    break;
  }

}


                echo "          <div class=\"t2\">" . $last . "</div>\n";
                echo "        </div>\n";
                echo "        <div class=\"s2\">" . $green . "</div>\n";
                echo "      </div>\n";
                echo "      </a>\n";
$last="";
$green="";
$mode="";
}


mysqli_close($con);
 ?>


    </div>
<script type="text/javascript">
  function logout(){
    document.cookie = "logname=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    document.cookie = "lognum=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    document.cookie = "pin=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    window.history.go(-2);
  }
</script>
<!-- <div class="" style="padding: 50px 0px 20px 0px;text-align:center;">
  <button type="button" name="button" onclick="logout()">Logout..</button>
</div> -->

    <script>
      document.addEventListener("deviceready", function() {
          let myCustomUniqueUserId = "<?php echo $_SESSION["snum"]; ?>";
          // document.write("Notification turned ON for "+myCustomUniqueUserId);
          window.plugins.OneSignal.setExternalUserId(myCustomUniqueUserId);

          // window.plugins.OneSignal
          //   .startInit("9c6966d4-3692-4435-a3da-5891131b44bb")
          //   .handleNotificationReceived(function(jsonData) {
          //     alert("Notification received:\n" + JSON.stringify(jsonData));
          //   })
          //   .endInit();

// window.plugins.OneSignal
//   .startInit( "9c6966d4-3692-4435-a3da-5891131b44bb")
//   .handleNotificationOpened(function(jsonData) {
//     // alert("Notification opened:\n" + JSON.stringify(jsonData));
//     // alert(jsonData.notification.payload.additionalData.foo);
//     if (jsonData.notification.payload.additionalData.foo != null) {
//       window.location.href = jsonData.notification.payload.additionalData.foo;
//     }
//     // console.log('didOpenRemoteNotificationCallBack: ' + JSON.stringify(jsonData));
//   })
//   .inFocusDisplaying(window.plugins.OneSignal.OSInFocusDisplayOption.Notification)
//   .endInit();

      }, false);
    </script>
  </body>
</html>
