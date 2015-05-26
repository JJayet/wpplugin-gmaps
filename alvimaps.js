var markers = [];
var geocoder;
var map;
var bounds;
var distance;

function initialize() {
  distance = new google.maps.DistanceMatrixService();
  bounds = new google.maps.LatLngBounds(null);
  geocoder = new google.maps.Geocoder();

  var centralPointElem = document.getElementById('centralPoint');

  if(centralPointElem !== null)
  {
    getLocation(centralPointElem.value, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
          var mapElement = document.getElementById('map-canvas');
          if(mapElement !== null && location !== null)
          {
            var mapOptions = {
              zoom: 15,
              center: results[0].geometry.location,
              disableDefaultUI: true
            };
            map = new google.maps.Map(mapElement, mapOptions);
          }
        }
      });
  }

  var input = document.getElementById('alvi_origin');
  var input2 = document.getElementById('alvi_destination');
  var input3 = document.getElementById('alvi_admin');

  if(input !== null)
    new google.maps.places.Autocomplete(input);
  if(input2 !== null)
    new google.maps.places.Autocomplete(input2);
  if(input3 !== null)
    new google.maps.places.Autocomplete(input3);
}

google.maps.event.addDomListener(window, 'load', initialize);

function codeAddress() {
  distance.getDistanceMatrix(
    {
      origins: [document.getElementById('alvi_origin').value],
      destinations: [document.getElementById('alvi_destination').value],
      travelMode: google.maps.TravelMode.DRIVING
  }, function(response, status) {
    if (status != google.maps.DistanceMatrixStatus.OK)
      document.getElementById('alvi_distance').innerHTML = "Aucun itinéraire trouvé entre ces deux destinations";
    else {
      document.getElementById('alvi_origin').value = response.originAddresses[0];
        document.getElementById('alvi_destination').value = response.destinationAddresses[0];
         if (response.rows[0].elements[0].status != "OK")
        document.getElementById('alvi_distance').innerHTML = "Aucun itinéraire trouvé entre ces deux destinations";
      else {
        var multiplifier = parseFloat(document.getElementById('multiplifier').value);
        var price = (parseFloat(response.rows[0].elements[0].distance.value) * multiplifier) / 1000;

        document.getElementById('alvi_distance').innerHTML = response.rows[0].elements[0].distance.text + " - " + response.rows[0].elements[0].duration.text + ' - ' + price.toLocaleString('fr-FR', { style: 'currency', currency: 'EUR' });
      }
    }
  });

  clearMarkers();

  getMarker(document.getElementById('alvi_origin').value);
  getMarker(document.getElementById('alvi_destination').value);

  setTimeout(function() { map.fitBounds( bounds ); }, 400);
}

function getLocation(address, callback) {
  geocoder.geocode({ 'address': address}, callback);
}

function getMarker(address) {
  getLocation(address, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        var marker = new google.maps.Marker({
            map: map,
            position: results[0].geometry.location
        });

        markers.push(marker);
        bounds.extend(marker.position);
      }
    });
}

function clearMarkers() {
  setAllMap(null);
}

function setAllMap(map) {
    for (var i = 0; i < markers.length; i++) {
      markers[i].setMap(map);
    }
}

function deleteMarkers() {
  clearMarkers();
  markers = [];
}
