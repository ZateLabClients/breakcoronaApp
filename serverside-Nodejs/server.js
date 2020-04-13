console.log("..............server.js started............");
// var mv = require(gpath+'mv');

// const ImageDataURI = require(gpath+'image-data-uri');
var gpath='';
var express = require(gpath+"express");
var app = express();

var bodyParser = require(gpath+"body-parser");
// app.use(bodyParser.urlencoded());
app.use(bodyParser.urlencoded({ limit: "50mb", extended: true, parameterLimit: 50000 }))
// app.use(bodyParser.json({ limit: "50mb" }));
app.use(bodyParser.json());

var http = require("http").createServer(app);
var io = require(gpath+"socket.io")(http);

var mysql = require(gpath+"mysql");
var connection = mysql.createConnection({
  "host": "localhost",
	// "user": "breakthechainUser",
	// "password": "Y3dYJ86LCZ5hrGhL",
	"user": "breakthechainUser",
	"password": "Y3dYJ86LCZ5hrGhL",
	"database": "breakthechainDB"

});

// function movefile(oldpath,newpath) {
// 	mv(oldpath, newpath, function (err) {
// 			if (err) {throw err;}
// 	});
// }

function getRndInteger() {
	var min = 10000000000000; var max =100000000000000000;
	return Math.floor(Math.random() * (max - min + 1) ) + min;
}

//..........image uri
// const dataURI = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAMAAAACCAIAAAFlEcHbAAAAB3RJTUUH1gMWFjk7nUWcXQAAAAlwSFlzAABOIAAATiABFn2Z3gAAAARnQU1BAACxjwv8YQUAAAAeSURBVHjaY7h79y7DhAkTGIA04/Tp0xkYGJ49ewYAgYwLV/R7bDQAAAAASUVORK5CYII=';
// const fileName = 'decoded-image.png';
// var ccc = ImageDataURI.outputFile(dataURI, fileName);
//...........image iri
var NodeGeocoder = require(gpath+'node-geocoder');
var options = {
  provider: 'openstreetmap',
  // Optional depending on the providers
  httpAdapter: 'https', // Default
  apiKey: 'YOUR_API_KEY', // for Mapquest, OpenCage, Google Premier
  formatter: null         // 'gpx', 'string', ...
};
var geocoder = NodeGeocoder(options);


// geolig
const geolib = require(gpath+'geolib');
// checks if 51.525/7.4575 is within a radius of 5 km from 51.5175/7.4678
// if (geolib.isPointWithinRadius({ latitude: 51.525, longitude: 7.4575 },{ latitude: 51.5175, longitude: 7.4678 },  5000)) {
// 	console.log('yess')
// } else {
// 	console.log('nooo')
// }
// end.....geolig


connection.connect(function (error) {

  app.use(function (req, res, next) {
	    res.setHeader('Access-Control-Allow-Origin', '*');
	    next();
	});

  var message = {
	  app_id: "935d6e1a-f55b-4620-a9bf-1f871dd7a11a",
	  contents: {"en": "Wash your hands regularly"},
	  data: {"foo": "bar"},
		android_group: "111",
		android_group_message: {"en": "Wash your hands with soap"},
	  included_segments: ["All"]
		// include_external_user_ids: ["chat20"]
	};

  setInterval(function(){ sendNotification(message); }, 60000*20);

  // app.post("/location", function (request, result) {
  //   console.log(request.body);
  //   request=request.body[0];
  //   console.log(request.name);
  //   connection.query("INSERT INTO locations (name,playerId,lat,lon) VALUES(?,?,?,?)",[request.name,request.num,request.lat,request.lon], function (error, result) {
  //     if (error) {console.log(error);return;}
  //   });
  //   result.end("Hello world loccc !");
	// });
  app.post("/location",async function (request, responce) {
    requestx=request.body[0];

    const res = await geocoder.reverse({ lat: requestx.lat, lon: requestx.lon });
    // console.log(res);
    resx = res[0];

    connection.query("INSERT INTO locations (name,playerId,lat,lon,addr,city,pin,state,streetname,streetnum,neib) VALUES(?,?,?,?,?,?,?,?,?,?,?)",[requestx.name,requestx.num,requestx.lat,requestx.lon,resx.formattedAddress,resx.city,resx.zipcode,resx.state,resx.streetName,resx.streetNumber,resx.neighbourhood], function (error, result) {
      if (error) {console.log(error);return;}
    });
    responce.end('success');
	});

	app.get("/", function (request, result) {
		result.end("Hello world !...");
	});
	app.get("/xx", async function (request, responce) {
    const res = await geocoder.reverse({ lat: 45.767, lon: 4.833 });
    // console.log(res);
    resx = res[0];

    connection.query("INSERT INTO locations (name,playerId,lat,lon,addr,city,pin,state,streetname,streetnum,neib) VALUES('ss','ss','ss','ss',?,?,?,?,?,?,?)",[resx.formattedAddress,resx.city,resx.zipcode,resx.state,resx.streetName,resx.streetNumber,resx.neighbourhood], function (error, result) {
      if (error) {console.log(error);return;}
    });
    responce.end(JSON.stringify(resx));

	});
  app.get("/reverse_code", function (request, result) {
    // http://localhost:3007/reverse_code?playerid=456
    var query = request.query;
		connection.query("SELECT * from locations where playerId=?",[query.playerId], function (error, messages) {
			if (error) {throw error; return;}
          result.end(JSON.stringify(messages));
		});
	});

  app.get("/distinct", function (request, result) {
    if (request.query.para1=='all') {
      var sqltemp ="SELECT id, playerId,name from locations group by playerId order by id";
    }
    if (request.query.para1=='quarant') {
      var sqltemp ="SELECT id, playerId,name from locations group by playerId";
    }
    // http://localhost:3007/distinct
		connection.query(sqltemp,function (error, messages) {
			if (error) {throw error; return;}
      result.end(JSON.stringify(messages));
		});
	});


var users = [];

	io.on("connection", function (socket) {

		socket.on("get_nearby", function (data) {
      console.log(data);
      socket.emit("log_recieved", "Proccess started....<br>");
      connection.query("SELECT * from locations where playerId=?",[data.num], function (error, result) {
  			if (error) {throw error; return;}
        socket.emit("log_recieved", result.length+" results for user "+data.num+" Time depends on this count<br>");
        if (true) {
// return all null values
        }
// checking each locations..
        var count1 = 0;
        var totalCount = 0;
        for (var i = 0; i < result.length; i++) {

          connection.query("SELECT * from locations where city = ? AND playerId != ? AND id > ? AND city is not NULL",[result[i].city,data.num,result[i].id], function (error2, result2) {
      			if (error2) {throw error2; count1++; return;}
              // socket.emit("log_recieved", result2.length);


            for (var j = 0; j < result2.length; j++) {
              totalCount++;
              // socket.emit("log_recieved", count1+"......i...<br>");

              // isPointWithinRadius(point, centerPoint, radius)
                  if (geolib.isPointWithinRadius({ latitude: result2[j].lat, longitude: result2[j].lon },{ latitude: result[count1].lat, longitude: result[count1].lon },  3000)) {
                    socket.emit("log_recieved", "Result: "+count1+" => <font color=red>Interacted Person</font> Name= <font color=red>"+result2[j].name+"<font> City="+result2[j].city+"<br>");
                  } else {
                    // socket.emit("log_recieved", JSON.stringify(result));
                    socket.emit("log_recieved", "Result: "+count1+" => <font>Not-Interacted Person</font> Name="+result2[j].name+" City="+result2[j].city+"<br>");
                  }
                  if (j==result2.length-1) {
                    socket.emit("log_recieved", "<font color=blue>"+totalCount+"<font> Location anaylised...<br>");
                  }
            }
            count1++;
            if (count1==result.length) {
              socket.emit("log_recieved", "<font color=skyblue>Proccess Completed Succesfully With 0 Errors<font> <br>");
            }
            // socket.emit("log_recieved", i+".. "+result[i].name+" found in "+data.place+"...Checking his diststance<br>");
// socket.emit("log_recieved", result.length+" results for user "+data.place+"<br>");
      		});
        }

  		});

      // if (data.lat.length!=0 || data.lon.length!=0) {
      //   geocoder.reverse({lat:data.lon, lon:data.lat}, function(err, res) {
      //     if (err) {console.log(err);return;throw err; } //sent notification
      //     res =res[0];
      //     console.log(res);
      //     socket.emit("recieved_one_location", res.city);
      //     // io.emit("recieved_one_location", [{"city":res.city,}]);
      //   });
      // }
		})
		socket.on("get_location", function (data) {  //not usedddd
      if (data.lat.length!=0 || data.lon.length!=0) {
        geocoder.reverse({lat:data.lat, lon:data.lon}, function(err, res) {
          if (err) {return;throw err; } //sent notification
          res =res[0];
          io.emit("Recieved_location", [{"id":data.id,
          "addr":res.formattedAddress,
          "city":res.city,
          "pin":res.zipcode,
          "state":res.state,
          "stname":res.streetName,
          "stnum":res.streetNumber,
          "neib":res.neighbourhood,
          }]);
        });
      }
		})

	});
});

http.listen(4001, function () {
	console.log("Listening :4001");
});

var sendNotification = function(data) {
	var headers = {
		"Content-Type": "application/json; charset=utf-8",
		"Authorization": "Basic MzVjNzZlZGYtNDcwOS00YTAwLWJjYWEtMjU2N2Q1MjAwYTli"
	};

	var options = {
		host: "onesignal.com",
		port: 443,
		path: "/api/v1/notifications",
		method: "POST",
		headers: headers
	};

	var https = require('https');
	var req = https.request(options, function(res) {
		res.on('data', function(data) {
			// console.log("Response:");
			// console.log(JSON.parse(data));
		});
	});

	req.on('error', function(e) {
		// console.log("ERROR:");
		// console.log(e);
	});

	req.write(JSON.stringify(data));
	req.end();
};
