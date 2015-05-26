<?php

class AlviMaps_Admin {

  public function __construct() {
    add_action('admin_menu', array($this, 'add_admin_menu'));
    add_action('admin_init', array($this, 'register_settings'));
  }

  public function register_settings()
	{
	    register_setting('alvimaps_settings', 'centralPoint');
			register_setting('alvimaps_settings', 'dailyPrice');
			register_setting('alvimaps_settings', 'nightlyPrice');
			register_setting('alvimaps_settings', 'dayBeginsAt');
			register_setting('alvimaps_settings', 'dayEndsAt');

			add_settings_section('alvimaps_parameters_section', 'Paramètres du plugin', array($this, 'section_html'), 'alvimaps_settings');
			add_settings_field('centralPoint', 'Adresse de départ', array($this, 'centralPointHtml'), 'alvimaps_settings', 'alvimaps_parameters_section');
			add_settings_field('dailyPrice', 'Tarif de jour au kilomètre', array($this, 'dailyPriceHtml'), 'alvimaps_settings', 'alvimaps_parameters_section');
			add_settings_field('nightlyPrice', 'Tarif de nuit au kilomètre', array($this, 'nightlyPriceHtml'), 'alvimaps_settings', 'alvimaps_parameters_section');
			add_settings_field('dayBeginsAt', 'La journée commence à', array($this, 'dayBeginsAtHtml'), 'alvimaps_settings', 'alvimaps_parameters_section');
			add_settings_field('dayEndsAt', 'Et se termine à', array($this, 'dayEndsAtHtml'), 'alvimaps_settings', 'alvimaps_parameters_section');
	}

	public function section_html() {
    echo 'Renseignez les paramètres du plugin';
	}

	public function centralPointHtml() {
		?>
		<input type="text" name="centralPoint" id="alvi_admin" value=<?php echo "\"". get_option('centralPoint') . "\""?> />
		<?php
	}

	public function dailyPriceHtml() {
		?>
		<input type="text" name="dailyPrice" id="dailyPrice" value=<?php echo "\"". get_option('dailyPrice') . "\""?> />
		<?php
	}

	public function nightlyPriceHtml() {
		?>
		<input type="text" name="nightlyPrice" id="nightlyPrice" value=<?php echo "\"". get_option('nightlyPrice') . "\""?> />
		<?php
	}

	public function dayBeginsAtHtml() {
		?>
		<input type="text" name="dayBeginsAt" id="dayBeginsAt" value=<?php echo "\"". get_option('dayBeginsAt') . "\""?> />
		<?php
	}

	public function dayEndsAtHtml() {
		?>
		<input type="text" name="dayEndsAt" id="dayEndsAt" value=<?php echo "\"". get_option('dayEndsAt') . "\""?> />
		<?php
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
			<form method="post" action="options.php">
				<?php
					settings_fields('alvimaps_settings');
					do_settings_sections('alvimaps_settings');
					submit_button();
				?>
			</form>
			<?php
	}
}
?>
