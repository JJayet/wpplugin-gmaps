<?php
/*
Plugin Name: AlviMaps
Plugin URI: http://alvidis.fr/alvimaps/
Description: Plugin Google Maps pour Wordpress
Author: Alvidis
Version: 0.5
Author URI: http://alvidis.fr
*/

class AlviMaps_Plugin {

	public function __construct() {

		include_once plugin_dir_path( __FILE__ ) . 'shortcode.php';
		include_once plugin_dir_path( __FILE__ ) . 'widget.php';
		include_once plugin_dir_path( __FILE__ ) . 'admin.php';

		new AlviMaps_Widget();
		new AlviMaps_ShortCode();
		new AlviMaps_Admin();

		add_action('widgets_init', function(){register_widget('AlviMaps_Widget');});

		add_action('wp_loaded', function() {
			wp_register_script('underscore', 'https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js', array(), '', true);
			wp_register_script('googlemaps', 'https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places', array(), '', true);
			wp_register_script('alvimaps', plugin_dir_url(__FILE__) . 'alvimaps.js', array(), filemtime(plugin_dir_path(__FILE__) . 'alvimaps.js'), true);
		});

		add_action('wp_enqueue_scripts', function() {
			wp_enqueue_script('underscore');
			wp_enqueue_script('googlemaps');
			wp_enqueue_script('alvimaps');
		});

		add_action('admin_enqueue_scripts', function() {
			wp_enqueue_script('underscore');
			wp_enqueue_script('googlemaps');
			wp_enqueue_script('alvimaps');
		});
	}
}

new AlviMaps_Plugin();

?>
