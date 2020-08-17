<div class="panel panel-primary">
    <div class="panel-heading">
    	<i class="glyphicon glyphicon-ok-sign"></i> Absensi <?php echo $absensi; ?>
    </div>
    <div class="panel-body">
    	<div id="map" style="width: 100%; height: 200px;"></div>
    	<form action="app/simpan_absensi" method="POST" enctype="multipart/form-data">
        <div class="form-group">
          <center>
            <img id="previewImg" src="https://img.favpng.com/18/23/24/computer-icons-user-profile-portable-network-graphics-vector-graphics-png-favpng-31THvNXgnrmpMkkCSfpupKPpH.jpg" alt="Placeholder" style="width: 100px;">
          </center>
          <input type="file" accept="image/*" capture="camera" name="photo" onchange="previewFile(this);" required>
        </div>
    		<div class="form-group">
    			<label>LatLng</label>
    			<input type="text" name="latlng" id="latlng" class="form-control" readonly> 
          <input type="hidden" name="jarak" id="jarak">
    		</div>
    		<div class="form-group">
    			<label>Lokasi</label>
    			<input type="hidden" name="absensi" value="<?php echo $absensi ?>">
    			<textarea rows="3" id="lokasi" name="lokasi" class="form-control" readonly></textarea>
    		</div>
    		<div class="form-group">
    			<button type="submit" class="btn btn-block btn-success">ABSEN</button>
    		</div>
    	</form>
    </div>
    <div class="panel-footer"></div>
  </div>

    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script>
        function previewFile(input){
            var file = $("input[type=file]").get(0).files[0];
     
            if(file){
                var reader = new FileReader();
     
                reader.onload = function(){
                    $("#previewImg").attr("src", reader.result);
                }
     
                reader.readAsDataURL(file);
            }
        }
    </script>

    <script>
      // Note: This example requires that you consent to location sharing when
      // prompted by your browser. If you see the error "The Geolocation service
      // failed.", it means you probably did not give permission for the browser to
      // locate you.

      //fungsi jarak 
      var rad = function(x) {
        return x * Math.PI / 180;
      };

      var getDistance = function(p1, p2) {
        var R = 6378137; // Earth’s mean radius in meter
        var dLat = rad(p2.position.lat() - p1.position.lat());
        var dLong = rad(p2.position.lng() - p1.position.lng());
        var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
          Math.cos(rad(p1.position.lat())) * Math.cos(rad(p2.position.lat())) *
          Math.sin(dLong / 2) * Math.sin(dLong / 2);
        var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
        var d = R * c;
        return d; // returns the distance in meter
      };


      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -34.397, lng: 150.644},
          zoom: 18
        });
        var infoWindow = new google.maps.InfoWindow({map: map});
        var geocoder = new google.maps.Geocoder;

        // Try HTML5 geolocation.
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };

            //mendapatkan alamat
            var input = pos.lat+','+pos.lng;
            var latlngStr = input.split(',', 2);
            var latlng = {lat: parseFloat(latlngStr[0]), lng: parseFloat(latlngStr[1])};
            geocoder.geocode({'location': latlng}, function(results, status) {
              if (status === 'OK') {
                if (results[0]) {
                  document.getElementById("latlng").value = pos.lat+','+pos.lng;
                  document.getElementById("lokasi").value = results[0].formatted_address;

                  <?php 
                  $lokasi = $this->db->get('set_lokasi')->row()->latlng;
                  $lokasi = explode(',', $lokasi);
                   ?>

                  const lokasi_absen = {lat: <?php echo $lokasi[0] ?>, lng: <?php echo $lokasi[1] ?>};
                  const lokasi_user = {lat: pos.lat, lng: pos.lng};
                  // The markers for The Dakota and The Frick Collection
                  var mk1 = new google.maps.Marker({position: lokasi_absen, map: map});
                  var mk2 = new google.maps.Marker({position: lokasi_user, map: map});

                   // Draw a line showing the straight distance between the markers
                  var line = new google.maps.Polyline({path: [lokasi_absen, lokasi_user], map: map});
                  // Calculate and display the distance between markers
                  var distance = getDistance(mk1, mk2);
                  // document.getElementById('msg').innerHTML = "Distance between markers: " + distance.toFixed(2) + " M.";
                  document.getElementById("jarak").value = distance.toFixed(2);

                  //alert(pos.lat+','+pos.lng+' '+results[0].formatted_address);
                  //infowindow.open(map, marker);
                } else {
                  window.alert('No results found');
                }
              } else {
                window.alert('Geocoder failed due to: ' + status);
              }
            });
            //////////////////////////////////

            infoWindow.setPosition(pos);
            infoWindow.setContent('Lokasi Kamu.');
            map.setCenter(pos);
          }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
          });
        } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
        }
      }

      function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                              'Error: The Geolocation service failed.' :
                              'Error: Your browser doesn\'t support geolocation.');
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCgy86fkmMmxsZDl5ClSaIHeKQZdztg7G8&callback=initMap">