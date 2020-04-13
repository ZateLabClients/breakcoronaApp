<?php
// setcookie('lognum', '4444', time() + (86400 * 100), "/");
// setcookie('logname', 'nameee', time() + (86400 * 100), "/");
if(isset($_GET['name']) && isset($_GET['mob'])) {
      $name=$_GET['name'];
      $num=$_GET['mob'];
      setcookie('lognum', $num, time() + (86400 * 100), "/");
      setcookie('logname', $name, time() + (86400 * 100), "/");
}else {
       $name=$_COOKIE['logname'];
       $num=$_COOKIE['lognum'];
}
// if(isset($_COOKIE['lognum']) && isset($_COOKIE['logname'])) {
//      // header("Location: login/index.php");
//      $name=$_COOKIE['logname'];
//      $num=$_COOKIE['lognum'];
// }else {
//   $name='nologin';
//   $num='nologin';
// }
  ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="./style.css">
  </head>
  <body style="margin:0px;">
    <div style="background-color:#9a4ef1;height: 28px;text-align:center;padding: 8px;color:white;position: fixed;top: 0;width: 100%;">
        Break The Chain
    </div>
<div class="" style="margin-top:46px;">
  <?php require 'page2.php'; ?>

</div>
  </body>
<!-- Your Name : <?php echo $name ?> <br>
Your Number :<?php echo $num ?> <br><br><br><br><br><br><br> -->
<?php
if ($num=="9961789975") {
echo " <a href=\"testing.php\">Testing....</a>\n";
}
 ?>
  <!-- readdyyyyyyyyyyyyyyyyyyyyyyyyyyyyy      ebveeeeeeeeeeeeeeeeeeennnnnnnnnnnnnnnnnttttttttttt -->
<!-- <button type="button" name="button" onclick="BackgroundGeolocation.start()">start</button> -->
<!-- <button type="button" name="button" onclick="BackgroundGeolocation.stop()">stop</button> -->
<!-- <button type="button" name="button" onclick="BackgroundGeolocation.showAppSettings()">showAppSettings</button> -->
<!-- <button type="button" name="button" onclick="BackgroundGeolocation.showLocationSettings()">showLocationSettings</button> -->
<!-- <button type="button" name="button" onclick="BackgroundGeolocation.forceSync()">uploaded offline location</button> -->
<!-- nofitication enable -->
<script type="text/javascript">
function onDeviceReady() {
  BackgroundGeolocation.configure({
    maxLocations:20,
    locationProvider: BackgroundGeolocation.ACTIVITY_PROVIDER,
    desiredAccuracy: BackgroundGeolocation.HIGH_ACCURACY,
    stationaryRadius: 4,
    distanceFilter: 150,
    notificationTitle: 'BreaKCorona RootMap Running',
    notificationText: 'Rootmap is running success',
    debug: true,
    startOnBoot: true,
    interval: 60000,
    fastestInterval: 10000,
    activitiesInterval: 10000,
    url: 'http://134.122.125.172:4001/location',
    httpHeaders: {
      'X-FOO': 'bar'
    },
    postTemplate: {
      lat: '@latitude',
      lon: '@longitude',
      name: '<?php echo $name ?>',
      num: '<?php echo $num ?>'
    }
  });

  BackgroundGeolocation.on('location', function(location) {
    // alert(JSON.stringify(location));
    document.getElementById('lat').innerHTML=location.latitude;
    document.getElementById('lon').innerHTML=location.longitude;
    if (typeof location.speed == 'undefined') {
      var speedx = '...';
      // alert('not a number '+location.speed);
    }else {
      var speedx = (location.speed*3.6).toFixed(2);
    }
    document.getElementById('speed').innerHTML=speedx;
    BackgroundGeolocation.startTask(function(taskKey) {
      //bg task
      // execute long running task
      // eg. ajax post location
      // IMPORTANT: task has to be ended by endTask
      BackgroundGeolocation.endTask(taskKey);
    });
  });
  BackgroundGeolocation.on('activity', function(activity) {
    document.getElementById('travel').innerHTML=activity.type;
    // alert(JSON.stringify(activity))
  });

  BackgroundGeolocation.on('stationary', function(stationaryLocation) {
    // alert(JSON.stringify(stationaryLocation));
  });

  BackgroundGeolocation.on('error', function(error) {
    console.log('[ERROR] BackgroundGeolocation error:', error.code, error.message);
  });

  BackgroundGeolocation.on('start', function() {
    console.log('[INFO] BackgroundGeolocation service has been started');
  });

  BackgroundGeolocation.on('stop', function() {
    console.log('[INFO] BackgroundGeolocation service has been stopped');
  });

  BackgroundGeolocation.on('authorization', function(status) {
    // alert(status);
    console.log('[INFO] BackgroundGeolocation authorization status: ' + status);
    if (status !== BackgroundGeolocation.AUTHORIZED) {
      // we need to set delay or otherwise alert may not be shown
      setTimeout(function() {
        var showSettings = confirm('App requires location tracking permission. Would you like to open app settings?');
        if (showSetting) {
          return BackgroundGeolocation.showAppSettings();
        }
      }, 2000);
    }
  });

  BackgroundGeolocation.on('background', function() {
    BackgroundGeolocation.configure({ debug: true });
  });

  BackgroundGeolocation.on('foreground', function() {
    BackgroundGeolocation.configure({ debug: false });
  });

  // BackgroundGeolocation.on('abort_requested', function() {
  //   console.log('[INFO] Server responded with 285 Updates Not Required');
  //
  //   // Here we can decide whether we want stop the updates or not.
  //   // If you've configured the server to return 285, then it means the server does not require further update.
  //   // So the normal thing to do here would be to `BackgroundGeolocation.stop()`.
  //   // But you might be counting on it to receive location updates in the UI, so you could just reconfigure and set `url` to null.
  // });

  // BackgroundGeolocation.on('http_authorization', () => {
  //   console.log('[INFO] App needs to authorize the http requests');
  // });

  BackgroundGeolocation.checkStatus(function(status) {
    // console.log('[INFO] BackgroundGeolocation service is running', status.isRunning);
    // console.log('[INFO] BackgroundGeolocation services enabled', status.locationServicesEnabled);
    // console.log('[INFO] BackgroundGeolocation auth status: ' + status.authorization);
    if (!status.locationServicesEnabled) {
      setTimeout(function() {
        var showSettingsx = confirm('App requires GPS location. Would you like to open app settings?');
        if (showSettingsx) {
          return BackgroundGeolocation.showLocationSettings();
        }
      }, 1000);
    }

    // you don't need to check status before start (this is just the example)
    if (status.isRunning) {
      var temp = document.getElementById('btn');
      marker.style.display='block';
      temp.innerHTML='Stop Travel';
      temp.style.backgroundColor='#f14e4e';
    }
  });

  	document.addEventListener("backbutton", onBackKeyDown, false);
  	function onBackKeyDown() {
      window.plugins.appMinimize.minimize();
      // var modelx = document.getElementById("myModal").style.display;
      // if (modelx == "block") {
      //   document.getElementById("myModal").style.display="none";
      //   return;
      // }
  		// if (areaSwapped == true) {
  		// 	showChatList();
      //   showInterstitialAd();
  		// }
  		// else {
  		// 	window.history.back();
  		// }
  	}


}

document.addEventListener('deviceready', onDeviceReady, false);
</script>
</html>
