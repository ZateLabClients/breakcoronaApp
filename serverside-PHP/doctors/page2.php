<style >
#div1{
  border-radius: 8px;
  padding: 20px 15px;
  border: 1px solid #dcd9d9;
    box-shadow: 0 0 7px 2px #bfbbbb;
}
#test {
  width: 100px;
  height: 100px;
  border-radius: 50%;
  border: 4px solid transparent;
  background-size: 100% 100%, 50% 50%, 50% 50%, 50% 50%, 50% 50%;
  background-repeat: no-repeat;
  background-image: linear-gradient(white, white),
                    linear-gradient(#9a4ef1 20%, skyblue 0%),
                    linear-gradient( #9a4ef1,#9a4ef1),
                    linear-gradient( skyblue 70%, white 20%),
                    linear-gradient( #9a4ef1 70%, white 20%);
  background-position: center center, left top, right top, left bottom, right bottom;
  background-origin: content-box, border-box, border-box, border-box, border-box;
  background-clip: content-box, border-box, border-box, border-box, border-box;
  /* transform: rotate(30deg); */
}
#div1_inner{
  margin-top: 15px;
  font-size: 13px;
  color: grey;
}
  a.button4{
      display: inline-block;
      width: 98%;
      padding: 0.5em 1.2em;
      margin: 0.7em 0.1em 0.1em 0;
      border: 0.16em solid rgba(255,255,255,0);
      border-radius: 2em;
      box-sizing: border-box;
      text-decoration: none;
      font-family: 'Roboto',sans-serif;
      font-weight: 300;
      color: #FFFFFF;
      text-shadow: 0 0.04em 0.04em rgba(0,0,0,0.35);
      text-align: center;
      transition: all 0.9s;
      /* border-color: rgba(255,255,255,1); */
  }
  a.button4:hover{
   border-color: rgba(255,255,255,1);
  }
  @media all and (max-width:30em){
   a.button4{
    display:block;
    margin:0.2em auto;
   }
  }

  .swal-modal {
/* position: absolute; */
  }
  /* start table0 */
  .catimg {
   /* border:1px solid black;border-radius: 15px; */
   border: 1px solid #f1f1f1;
       padding-top: 8px;
       box-shadow: 0 0 7px 2px #dad7d7;
  }
  /* end of table */
</style>
<div style="padding:8px;">
<div id="div1">
<div style="float:left">
  <div style="width:50%;float:left;">
    <div id="test">
      <div style="text-align:center;margin-bottom: 0px;height: 100%;margin-top: 38%;  ">
           <b><span id="speed">...</span> <br> Km/hr</b> <br> Speed
      </div>
    </div>
  </div>
  <div style="width:40%;float:left;padding:8px;font-size:12px;">
    Latitude: <br> <span id="lat">loading...</span>   <br>
    Longiitude:<br> <span id="lon">loading...</span> <br>
    Mode of travel: <span id="travel">loading...</span> <br>
  </div>
</div>
<div id="marker" style="width:100%;float: left;display: none;margin-bottom:10px;">
  <center>
  <div class='pin'></div>
  <div class='pulse'></div>
  </center>
</div>
  <center>
    <a class="button4" id="btn" onclick="locsstart()" style="background-color:#9a4ef1">Start Travel</a>
    <div id="div1_inner">
      Currently your geolocation will be changed within 3m* (In production stage we will change this to 100m or more ) <br>
      Also, app will produce beep sound and will show messages while updating geo locations. (It will also changed in production stage)
    </div>
  </center>
</div>
</div>


<div class="">
  <table cellpadding=10px cellspacing=10px >
  <tr width=100%>
  <td class="catimg"><a href="http://zateart.com/covidapp2/store/index.php"><img src="images/icons/store.jpg" style="width:100%;"></a></td>
  <td class="catimg"><a href="http://www.covid19india.org"><img src="images/icons/news.jpg" style="width:100%;"></a></td>
  <td class="catimg"><a href="http://zateart.com/covidapp2/doctors/index.php"><img src="images/icons/doc.jpg" style="width:100%;"></a></td>
  </tr>
</table>
</div>
<div style="padding: 5px 20px;margin-top: 20px; ">
  Upcomming features based on the situations..
</div>
<div class="">
  <table cellpadding=10px cellspacing=10px >
  <tr width=100%>
    <td class="catimg"><a onclick="comeSoon('mobiles.php?brand=samsung');" ><img src="images/icons/chat.jpg" style="width:100%;"></a></td>
    <td class="catimg"><a onclick="comeSoon('mobiles.php?brand=samsung');" ><img src="images/icons/bed.jpg" style="width:100%;"></a></td>
    <td class="catimg"><a onclick="comeSoon('mobiles.php?brand=iphone');"><img src="images/icons/settings.jpg" style="width:100%;"></a></td>
  </tr>
  </table>
</div>
<div class="" style="height:23px;">

</div>
<div class="" style="height:150px;padding:15px;">
Powered By UEC.
</div>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
function locsstart() {
  var temp = document.getElementById('btn');
  var marker = document.getElementById('marker');
  if (temp.innerHTML=='Start Travel') {
    // var user=getCookie("logname");
    function getCookie(cname) {
      var name = cname + "=";
      var decodedCookie = decodeURIComponent(document.cookie);
      var ca = decodedCookie.split(';');
      for(var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
          c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
          return c.substring(name.length, c.length);
        }
      }
      return "";
    }
    var num=getCookie("lognum");
    // alert(num);
    if (num == "") {
      swal({
        title: "Please Login to use this Service?",
        text: "It may protect your,family and society!",
        icon: "info",
        buttons: ["No", "Login"],
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          window.location.href = "http://zateart.com/covidapp2/login/index.php";
        } else {
          return ;
          // swal("Your imaginary file is safe!");
        }
      });
      return ;
    }//end of login

    // swal("Started!", "Your rootmap is started!", "success")
    // .then((value) => {
    //   // swal(`The returned value is: ${value}`);
    // });
    if (typeof BackgroundGeolocation !== 'undefined') {
        BackgroundGeolocation.start();
        BackgroundGeolocation.on('start', function() { //also seted in isRunning
          marker.style.display='block';
          temp.innerHTML='Stop Travel';
          temp.style.backgroundColor='#f14e4e';
        });
    }

  }else {

swal({
  title: "Are you sure want to stop rootmap?",
  text: "It may protect your,family and society!",
  icon: "warning",
  buttons: ["No", "Yes.!"],
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
    swal("Stoped!", "Your rootmap is stoped!", "success");
    if (typeof BackgroundGeolocation !== 'undefined') {
        BackgroundGeolocation.stop();
        BackgroundGeolocation.on('stop', function() {
          marker.style.display='none';
          temp.innerHTML='Start Travel';
          temp.style.backgroundColor='#9a4ef1';
        });
    }
  } else {
    return ;
    // swal("Your imaginary file is safe!");
  }
});



  }
}

function comeSoon(x) {
swal("Hii User...", "This option will be started soon..based on the situation");
}
</script>
<style media="screen">
.pin {
 width: 30px;
 height: 30px;
 border-radius: 50% 50% 50% 0;
 background: red;
 /* position: absolute; */
 -webkit-transform: rotate(-45deg);
 -moz-transform: rotate(-45deg);
 -o-transform: rotate(-45deg);
 -ms-transform: rotate(-45deg);
 transform: rotate(-45deg);
 /* left: 50%; */
 /* top: 50%; */
 /* margin: -20px 0 0 -20px; */
 -webkit-animation-name: bounce;
 -moz-animation-name: bounce;
 -o-animation-name: bounce;
 -ms-animation-name: bounce;
 animation-name: bounce;
 -webkit-animation-fill-mode: both;
 -moz-animation-fill-mode: both;
 -o-animation-fill-mode: both;
 -ms-animation-fill-mode: both;
 animation-fill-mode: both;
 -webkit-animation-duration: 1s;
 -moz-animation-duration: 1s;
 -o-animation-duration: 1s;
 -ms-animation-duration: 1s;
 animation-duration: 1s;
}
.pin:after {
 content: '';
 width: 14px;
 height: 14px;
 /* margin: 8px 0 0 8px; */
 /* margin: 10px 15px 5px 3px; */
 margin-top: 8px;
 margin-left: -6px;
 background: #ffffff;
 position: absolute;
 border-radius: 50%;
}
.pulse {
 background: rgba(0,0,0,0.2);
 border-radius: 50%;
 height: 14px;
 width: 14px;
 /* position: absolute; */
 /* left: 50%; */
 /* top: 50%; */
 /* margin: 11px 0px 0px -12px; */
 -webkit-transform: rotateX(55deg);
 -moz-transform: rotateX(55deg);
 -o-transform: rotateX(55deg);
 -ms-transform: rotateX(55deg);
 transform: rotateX(55deg);
 z-index: -2;
}
.pulse:after {
 content: "";
 border-radius: 50%;
 height: 50px;
 width: 50px;
 position: absolute;
 margin: -14px 0px 0px -24px;
 -webkit-animation: pulsate 1s ease-out;
 -moz-animation: pulsate 1s ease-out;
 -o-animation: pulsate 1s ease-out;
 -ms-animation: pulsate 1s ease-out;
 animation: pulsate 1s ease-out;
 -webkit-animation-iteration-count: infinite;
 -moz-animation-iteration-count: infinite;
 -o-animation-iteration-count: infinite;
 -ms-animation-iteration-count: infinite;
 animation-iteration-count: infinite;
 opacity: 0;
 -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
 filter: alpha(opacity=0);
 -webkit-box-shadow: 0 0 1px 2px #89849b;
 box-shadow: 0 0 1px 2px #89849b;
 -webkit-animation-delay: 1.1s;
 -moz-animation-delay: 1.1s;
 -o-animation-delay: 1.1s;
 -ms-animation-delay: 1.1s;
 animation-delay: 1.1s;
}
</style>
