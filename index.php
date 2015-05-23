<?php
/*
Plugin Name: AlviMaps
Plugin URI: http://alvidis.fr/alvimaps/
Description: Blablabla
Author: Alvidis
Version: 0.1
Author URI: http://alvidis.fr
*/

class AlviMaps_Plugin {
	public function __construct() {
		new AlviMaps_Widget();
		new AlviMaps_ShortCode();
		add_action('widgets_init', function(){register_widget('AlviMaps_Widget');});
		add_action('admin_menu', array($this, 'add_admin_menu'));
	}

	public function add_admin_menu()
	{
	    add_menu_page('AlviAdmin', 'AlviMaps', 'manage_options', 'zero', array($this, 'menu_html'));

	    /*ar	Arabic
	    ja	Japanese
		bg	Bulgarian
		kn	Kannada
		bn	Bengali
		ko	Korean
		ca	Catalan
		lt	Lithuanian
		cs	Czech
		lv	Latvian
		da	Danish
		ml	Malayalam
		de	German
		mr	Marathi
		el	Greek
		nl	Dutch
		en	English
		no	Norwegian
		en-AU	English (Australian)
		pl	Polish
		en-GB	English (Great Britain)
		pt	Portuguese
		es	Spanish
		pt-BR	Portuguese (Brazil)
		pt-PT	Portuguese (Portugal)
		eu	Basque
		ro	Romanian
		fa	Farsi
		ru	Russian
		fi	Finnish
		sk	Slovak
		fil	Filipino
		sl	Slovenian
		fr	French
		sr	Serbian
		gl	Galician
		sv	Swedish
		gu	Gujarati
		ta	Tamil
		hi	Hindi
		te	Telugu
		hr	Croatian
		th	Thai
		hu	Hungarian
		tl	Tagalog
		id	Indonesian
		tr	Turkish
		it	Italian
		uk	Ukrainian
		iw	Hebrew
		vi	Vietnamese
		*/
	}

	public function menu_html()
	{
	    echo '<h1>'.get_admin_page_title().'</h1>';
	    echo '<p>Bienvenue sur la page d\'accueil du plugin</p>';
	}
}

class AlviMaps_Widget extends WP_Widget
{
    public function __construct() {
        parent::__construct('alvi_maps', 'AlviMaps', array('description' => 'Google maps facilement, pour vous.'));
    }

    public function get_datas_from_google($origin, $destination) {
		$request = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$origin."&destinations=".$destination."&language=fr";
		$response = file_get_contents($request);
	    return json_decode($response);
	}

    public function widget($args, $instance) {
      echo $args['before_widget'];
	    echo $args['before_title'];
	    echo apply_filters('widget_title', $instance['title']);
	    echo $args['after_title'];
	    $distance = "";
	    $origin = "";
	    $destination = "";
	    if (isset($_POST['alvi_origin']) && isset($_POST['alvi_destination'])) {
	    	$datas = $this->get_datas_from_google($_POST['alvi_origin'], $_POST['alvi_destination']);
	    	$origin = $datas->origin_addresses[0];
			$destination = $datas->destination_addresses[0];
	    	if ($datas->rows[0]->elements[0]->status != "OK")
	    		$distance = "Aucun itinéraire possible";
	    	else
				$distance = $datas->rows[0]->elements[0]->distance->text . " - " . $datas->rows[0]->elements[0]->duration->text;
		}
	    ?>
	        <p>
	            <label for="alvi_origin">Départ :</label>
	            <input id="alvi_origin" name="alvi_origin" type="text" placeholder="Provenance" value="<?php echo $origin; ?>" onkeypress="if(event.keyCode==13) {codeAddress(); event.preventDefault()}"/>
	            <label for="alvi_destination">Arrivée :</label>
	            <input id="alvi_destination" name="alvi_destination" type="text" placeholder="Destination" value="<?php echo $destination; ?>" onkeypress="if(event.keyCode==13) {codeAddress(); event.preventDefault()}" />
	            <label id="alvi_distance"></label>
	            <?php
	            	if ($distance != "")
	            		echo '<label>' . $distance .'</label>';
				?>
	        </p>
	        <input type="Submit" value="Calculer" onclick="codeAddress()" />
	    <?php
	    echo $args['after_widget'];
    }

    public function form($instance)
	{
	    $title = isset($instance['title']) ? $instance['title'] : '';
	    ?>
	    <p>
	        <label for="<?php echo $this->get_field_name( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
	        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
	    </p>
	    <?php
	}
}

class AlviMaps_ShortCode
{
    public function __construct()
    {
        add_shortcode('alvi_fullmap', array($this, 'alvi_fullmap'));
    }

    public function alvi_fullmap($atts, $content) {
    	?>
			<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>
    	<script>
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
			  	map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

					var input = document.getElementById('alvi_origin');
					var input2 = document.getElementById('alvi_destination');
					var autocomplete = new google.maps.places.Autocomplete(input);
					var autocomplete2 = new google.maps.places.Autocomplete(input2);
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
							   //  for (var i = 0; i < origins.length; i++) {
							      // var results = response.rows[i].elements;
							      // addMarker(origins[i], false);
							      // for (var j = 0; j < results.length; j++) {
							      //   addMarker(destinations[j], true);
							    //     outputDiv.innerHTML += origins[i] + ' to ' + destinations[j]
							    //         + ': ' + results[j].distance.text + ' in '
							    //         + results[j].duration.text + '<br>';
							    //   }
							    // }

						}
					});

					clearMarkers();

					getMarker(document.getElementById('alvi_origin').value);
					getMarker(document.getElementById('alvi_destination').value);

					setTimeout( function() {

							var location = _.reduce(markers, function(memo, marker) {
								memo[0] += marker.position.A;
								memo[1] += marker.position.F;
								return memo;
							}, [0, 0]);

							var zoom = findZoomLevel(location[0], location[1]);
							console.info(zoom);
							map.setZoom(zoom);
							map.fitBounds( bounds );
						}, 400
					);
				}

				function findZoomLevel(sw, ne) {
					var GLOBE_WIDTH = 256;
					var angle = sw - ne;
					if (angle < 0) {
					  angle += 360;
					}
					var pixelWidth = document.getElementById('map-canvas').clientWidth;
					var zoom = Math.round(Math.log(pixelWidth * 360 / angle / GLOBE_WIDTH) / Math.LN2);
					return zoom;
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
	    </script>
	    <div id="map-canvas" style="height:300px;border-style:solid;border-width:5px;"></div>
    	<?php
	}
}

new AlviMaps_Plugin();

?>
