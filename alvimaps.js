var markers = [];
var geocoder;
var map;
var bounds;
var distance;

function initialize() {
  distance = new google.maps.DistanceMatrixService();
  bounds = new google.maps.LatLngBounds(null);
  geocoder = new google.maps.Geocoder();

  var mapOptions = {
    zoom: 18,
    center: new google.maps.LatLng(43.5880681, 7.0410248),
    disableDefaultUI: true
  };
  var mapElement = document.getElementById('map-canvas');
  if(!_.isUndefined(mapElement))
    map = new google.maps.Map(mapElement, mapOptions);

  var input = document.getElementById('alvi_origin');
  var input2 = document.getElementById('alvi_destination');
  var input3 = document.getElementById('alvi_admin');
  var autocomplete = new google.maps.places.Autocomplete(input);
  var autocomplete2 = new google.maps.places.Autocomplete(input2);
  var autocomplete3 = new google.maps.places.Autocomplete(input3);
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
        var price = (parseFloat(response.rows[0].elements[0].distance.value) * 1.5) / 1000;

        document.getElementById('alvi_distance').innerHTML = response.rows[0].elements[0].distance.text + " - " + response.rows[0].elements[0].duration.text + ' - ' + price.toLocaleString('fr-FR', { style: 'currency', currency: 'EUR' });
      }
    }
  });

  clearMarkers();

  getMarker(document.getElementById('alvi_origin').value);
  getMarker(document.getElementById('alvi_destination').value);

  setTimeout(function() { map.fitBounds( bounds ); }, 400);
}

function getMarker(address) {
  geocoder.geocode( { 'address': address}, function(results, status) {
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
