<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
<style media="screen">
  body{
    margin:0;
  }
  ul {
      margin-top:90px;
      width: 100%;
      height: auto;
      padding: 0;
      background: #f1f1f1;
      list-style-type: none;
  }

  li {
      padding: 15px 0 15px 15px;
      line-height: 25px;
      color: #113945;
      display: block;
      cursor: pointer;
      border-bottom:7px solid white;
  }

      li:hover {
          background: #f4f4f4;
          color: #9a4ef1;
      }
      #locs{
        /* background: #f1f1f1; */
        /* hover: none; */
      }
      a {
        text-decoration: none;text-decoration: none;
      }

  li .fa {
      margin: 0 20px 0 0;
      color:#9a4ef1;
  }
</style>
  <body>
    <div style="z-index: 100;background-color:#9a4ef1;height: 55px;text-align:center;padding: 8px;color:white;position: fixed;top: 0;width: 100%;">
          <h4>Settings</h4>
      </div>
      <div style="padding:7px; ">
        <ul>
            <li onclick="BackgroundGeolocation.showAppSettings()"><i class="fa fa-gears"></i>Open app settings</li>
            <li onclick="BackgroundGeolocation.showLocationSettings()"><i class="fa fa-map-marker"></i>&nbsp GPS settings</li>
            <div id="locDisplay" style="display:none">
              <li  ><i class="fa fa-map"></i>Your recent locations
                <div style="font-size:11px; ">
                (click your locations to view on google map)
                </div>
                <div class="" id="locs">
                  <a href="http://www.google.com/maps/place/10.388718,76.2178857/@10.388718,76.2178857,17z" target="_blank">lat: 76.2178857 lon: 10.388718 <br></a>
                </div>

              </li>
              <!-- <li><i class="fa fa-gears"></i> Settings</li> -->
              <li onclick="BackgroundGeolocation.deleteAllLocations(success, fail)"><i class="fa fa-location-arrow"></i> Clear your saved locations
                <div style="font-size:11px; ">
                (It will clear your saved location on your mobile. Your locations(rootmap) on our server will not be deleted )
                </div>
              </li>
            </div>

        </ul>
      </div>
  </body>
<script type="text/javascript">
function success(x) {
alert('Deleted Succesfully. Please refresh the page');
}
function fail(x) {
  alert('faasil');
}
document.addEventListener('deviceready', onDeviceReady, false);
function onDeviceReady() {
  BackgroundGeolocation.getLocations(
    function (locations) {
      // alert(JSON.stringify(locations[0]));
      var text="";
      if (locations.length>=1) {
        document.getElementById('locDisplay').style.display='block';
      }
      for (var i = 0; i < locations.length; i++) {
        text = text+'<a href="http://www.google.com/maps/place/'+locations[i].latitude+','+locations[i].longitude+'/@'+locations[i].latitude+','+locations[i].longitude+',17z" target="_blank">'+(i+1)+'. lat: '+locations[i].latitude+' lon: '+locations[i].longitude+' <br><br></a>'
        // locations[i]
        document.getElementById('locs').innerHTML=text;
      }
    }
  );

}
</script>
</html>
