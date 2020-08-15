
	<div id="map" style="width: 100%; height: 200px;"></div>
    	<form action="app/update_lokasi" method="POST">
    		<div class="form-group">
    			<label>LatLng</label>
    			<input type="text" name="latlng" id="latlng" class="form-control" readonly> 
    		</div>
    		<div class="form-group">
    			<label>Lokasi</label>
    			<textarea rows="3" id="lokasi" name="lokasi" class="form-control" readonly></textarea>
    		</div>
    		<div class="form-group">
    			<button type="submit" class="btn btn-block btn-success">UPDATE</button>
    		</div>
    	</form>

<script>
      // Note: This example requires that you consent to location sharing when
      // prompted by your browser. If you see the error "The Geolocation service
      // failed.", it means you probably did not give permission for the browser to
      // locate you.

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
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCgy86fkmMmxsZDl5ClSaIHeKQZdztg7G8&callback=initMap"></script>