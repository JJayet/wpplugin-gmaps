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
	public static function install() {
		global $wpdb;
		$wpdb->query("CREATE TABLE IF NOT EXISTS {$wpdb->prefix}alvimaps_preferences (id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(255) NOT NULL, value VARCHAR(255) NOT NULL);");
	}

	public static function uninstall() {
    global $wpdb;
    $wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}alvimaps_preferences;");
	}

	public function __construct() {
		register_activation_hook(__FILE__, array('AlviMaps_Plugin', 'install'));
		register_uninstall_hook(__FILE__, array('AlviMaps_Plugin', 'uninstall'));

		include_once plugin_dir_path( __FILE__ ) . 'shortcode.php';
		include_once plugin_dir_path( __FILE__ ) . 'widget.php';

		new AlviMaps_Widget();
		new AlviMaps_ShortCode();


		add_action('widgets_init', function(){register_widget('AlviMaps_Widget');});
		add_action('admin_menu', array($this, 'add_admin_menu'));
		add_action('wp_loaded', function() {
			wp_register_script('underscore', 'https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js', array(), '1.0', true);
			wp_register_script('googlemaps', 'https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places', array(), '1.0', true);
			wp_register_script('alvimaps', plugin_dir_url(__FILE__) . 'alvimaps.js', array(), '1.1', true);
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
			?>
	    <p>Bienvenue sur la page d'accueil du plugin</p>
			<p>Adresse de départ : <input type="text" id="alvi_admin" /></p>
			<?php
	}
}

new AlviMaps_Plugin();

?>
