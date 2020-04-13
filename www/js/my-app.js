// Initialize app
var myApp = new Framework7({
	pushState: true,
    swipePanel: 'left'
});
// If we need to use custom DOM library, let's save it to $$ variable:
var $$ = Dom7;
// Add view
var mainView = myApp.addView('.view-main', {
    // Because we want to use dynamic navbar, we need to enable it for this view:
    dynamicNavbar: true
});
// Handle Cordova Device Ready Event
$$(document).on('deviceready', function() {
	// Enable to debug issues.
  // window.plugins.OneSignal.setLogLevel({logLevel: 4, visualLevel: 4});

	  // Enable to debug issues.
	  // window.plugins.OneSignal.setLogLevel({logLevel: 4, visualLevel: 4});

	  var notificationOpenedCallback = function(jsonData) {
	    // console.log('notificationOpenedCallback: ' + JSON.stringify(jsonData));
				if (jsonData.notification.payload.additionalData.foo != null) {
		      window.location.href = jsonData.notification.payload.additionalData.foo;
		    }
	  };

	  window.plugins.OneSignal
	    .startInit("935d6e1a-f55b-4620-a9bf-1f871dd7a11a")
	    .handleNotificationOpened(notificationOpenedCallback)
	    .endInit();
// if(window.localStorage.getItem('v2') == null) {
// 	window.CacheClear();
//     window.localStorage.setItem('v2', 'true');
// }
  // var notificationOpenedCallback = function(jsonData) {
  //   // console.log('notificationOpenedCallback: ' + JSON.stringify(jsonData));
	// 	if (jsonData.notification.payload.additionalData.foo != null) {
  //     window.location.href = jsonData.notification.payload.additionalData.foo;
  //   }
  // };
	//
  // window.plugins.OneSignal
  //   .startInit("9c6966d4-3692-4435-a3da-5891131b44bb")
  //   .handleNotificationOpened(notificationOpenedCallback)
	// 	.inFocusDisplaying(window.plugins.OneSignal.OSInFocusDisplayOption.Notification)
  //   .endInit();

  // Call syncHashedEmail anywhere in your app if you have the user's email.
  // This improves the effectiveness of OneSignal's "best-time" notification scheduling feature.
  // window.plugins.OneSignal.syncHashedEmail(userEmail);
}, false);
