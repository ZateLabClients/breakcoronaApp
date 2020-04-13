<?php
session_start();

if(isset($_COOKIE['lognum']) && isset($_COOKIE['pin'])) {
  $num=$_COOKIE['lognum'];
  $pin=$_COOKIE['pin'];

  require('connect1.php');

  // mysql verification for num and pin
  $sql = "SELECT id FROM users WHERE (num='$num' AND pin='$pin')";
  $result = $conn->query($sql);

  if ($result->num_rows == 1) {

    $_SESSION["snum"]=$num;
    $_SESSION["sname"]=$_COOKIE['logname'];
    $_SESSION["pin"]=$pin;
    $_SESSION["logedin"]='yes';


    $namexx =$_COOKIE['logname'];
    header("location: ../index2.php?name=".$namexx."&mob=".$num);

  } else {
       // echo "0 results";
  }
  // end of mysql verification
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<script>
function showHint(str,username) {
  var xhttp;
  str = str.replace(/\+/g,""); //remove + in mobilenumber
  str = str.replace(/\s/g, ""); //remove all white spaces
  if (str.length < 6) { //just named 6
    document.getElementById("txtHint").innerHTML = "Invalid mobile number";
    console.log('empty');
    return;
  }
  if (username.trim().length === 0) {
    document.getElementById("txtHint").innerHTML = "Please enter your name";
    return;
  }
  document.getElementById("overlay").style.display = "block";

  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {

      document.getElementById("overlay").style.display = "none";
      // console.log('done');
      if (this.responseText=="") {
        document.getElementById("datax").style.display = "none";
        document.getElementById("otpbox").style.display = "block";
        document.getElementById("txtHint").innerHTML = "";
        document.getElementById("otphelp").innerHTML = "Please copy & paste the OTP received to your number ("+str+")";
      }
      else {
        document.getElementById("txtHint").innerHTML = this.responseText;
      }

    }
  };
  xhttp.open("GET", "otp/sent.php?q="+str, true);
  xhttp.send();
}
</script>


<script>
function authenticate(str) {
  var xhttp;
  if (str.length == 0) {
    document.getElementById("txtHint").innerHTML = "Please enter your OTP";
    return;
  }
  document.getElementById("overlay").style.display = "block";

  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {

      document.getElementById("overlay").style.display = "none";
      // console.log('done');
      if (this.responseText=="") {
        document.getElementById("txtHint").innerHTML = "";
        document.getElementById("myForm").submit();
      }
      else {
        document.getElementById("txtHint").innerHTML = this.responseText;
        // console.log(this.responseText);
      }

    }
  };
  xhttp.open("GET", "otp/authentication.php?q="+str, true);
  xhttp.send();
}
</script>

<style>
input[type=number],[type=tel],[type=text], select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

input[type=submit],[type=button] {
  width: 100%;
  background-color:  #532488 ;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit],[type=button]:hover {
  background-color: #9a4ef1;
}

#div1 {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}
#header{
  height:35px;
  background-color:#9a4ef1;
  text-align: center;
  font-weight: bold;
  font-size: 17px;
  color: white;
  padding: 15px;
  margin-bottom: 8px;
}
body{
  margin: 0px;
}
#overlay {
   position: fixed;
   display: none;
   width: 100%;
   height: 100%;
   top: 0;
   left: 0;
   right: 0;
   bottom: 0;
   background-image: url(glow.gif);
   background-repeat: no-repeat;
   background-position: center;

   /* background-color: #fff; */
   z-index: 2;
}
</style>
<body>

<div id="header">
      User Login
</div>

<div id="overlay"></div>


<div id="div1">


  <form id="myForm" action="login.php" method="POST">

<div id="datax">
Enter your Name:
    <input type="text" id="fname" name="sname" placeholder="Your name.." required>
Enter your mobile number:
    <input type="tel" id="mob" name="snum" placeholder="Your mobile number.." required>

    <input type="button" onclick="showHint(document.getElementById('mob').value,document.getElementById('fname').value)" value="Submit">

</div>


<div id="otpbox" style="display:none;">
Enter your OTP:
    <input type="number" id="otpvalue" name="otp" value="" placeholder="type your OTP here..">
    <input type="button" onclick="authenticate(document.getElementById('otpvalue').value)" value="Submit OTP" name="submitx">

</div>



  </form>

<span id="txtHint" style="color:red;"></span>
<br><br>
<span id="otphelp" style="color:grey;"></span>



</div>
</body>
</html>
