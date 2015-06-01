<?php

class AlviMaps_Admin {

  public function __construct() {
    add_action('admin_menu', array($this, 'add_admin_menu'));
    add_action('admin_init', array($this, 'register_settings'));
  }

  public function register_settings()
	{
    register_setting('alvimaps_settings', 'countryLimit');
	    register_setting('alvimaps_settings', 'centralPoint');
			register_setting('alvimaps_settings', 'dailyPrice');
			register_setting('alvimaps_settings', 'nightlyPrice');
			register_setting('alvimaps_settings', 'dayBeginsAt');
			register_setting('alvimaps_settings', 'dayEndsAt');

			add_settings_section('alvimaps_parameters_section', 'Paramètres du plugin', array($this, 'section_html'), 'alvimaps_settings');
      add_settings_field('countryLimit', 'Limiter la recherche à un pays', array($this, 'countryLimitHtml'), 'alvimaps_settings', 'alvimaps_parameters_section');
			add_settings_field('centralPoint', 'Centrage de la carte', array($this, 'centralPointHtml'), 'alvimaps_settings', 'alvimaps_parameters_section');
			add_settings_field('dailyPrice', 'Tarif de jour au kilomètre', array($this, 'dailyPriceHtml'), 'alvimaps_settings', 'alvimaps_parameters_section');
			add_settings_field('nightlyPrice', 'Tarif de nuit au kilomètre', array($this, 'nightlyPriceHtml'), 'alvimaps_settings', 'alvimaps_parameters_section');
			add_settings_field('dayBeginsAt', 'La journée commence à', array($this, 'dayBeginsAtHtml'), 'alvimaps_settings', 'alvimaps_parameters_section');
			add_settings_field('dayEndsAt', 'Et se termine à', array($this, 'dayEndsAtHtml'), 'alvimaps_settings', 'alvimaps_parameters_section');
	}

	public function section_html() {
    echo 'Renseignez les paramètres du plugin';
	}

  public function countryLimitHtml() {
    ?>
    <select name="countryLimit">
      <optgroup label="A">
      	<option value="AF">AFGHANISTAN</option>
      	<option value="ZA">AFRIQUE DU SUD</option>
      	<option value="AX">ÅLAND, ÎLES</option>
      	<option value="AL">ALBANIE</option>
      	<option value="DZ">ALGERIE</option>
      	<option value="DE">ALLEMAGNE</option>
      	<option value="AD">ANDORRE</option>
      	<option value="AO">ANGOLA</option>
      	<option value="AI">ANGUILLA</option>
      	<option value="AQ">ANTARCTIQUE</option>
      	<option value="AG">ANTIGUA ET BARBUDA</option>
      	<option value="SA">ARABIE SAOUDITE</option>
      	<option value="AR">ARGENTINE</option>
      	<option value="AM">ARMENIE</option>
      	<option value="AW">ARUBA</option>
      	<option value="AU">AUSTRALIE</option>
      	<option value="AT">AUTRICHE</option>
      	<option value="AZ">AZERBAIDJAN</option>
      </optgroup>
      <optgroup label="B">
      	<option value="BS">BAHAMAS</option>
      	<option value="BH">BAHREIN</option>
      	<option value="BD">BANGLADESH</option>
      	<option value="BB">BARBADE</option>
      	<option value="BY">BELARUS</option>
      	<option value="BE">BELGIQUE</option>
      	<option value="BZ">BELIZE</option>
      	<option value="BJ">BENIN</option>
      	<option value="BM">BERMUDES</option>
      	<option value="BT">BHOUTAN</option>
      	<option value="BO">BOLIVIE, l'ETAT PLURINATIONAL DE</option>
      	<option value="BQ">BONAIRE, SAINT-EUSTACHE ET SABA</option>
      	<option value="BA">BOSNIE-HERZEGOVINE</option>
      	<option value="BW">BOTSWANA</option>
      	<option value="BV">BOUVET, ILE</option>
      	<option value="BR">BRESIL</option>
      	<option value="BN">BRUNEI DARUSSALAM</option>
      	<option value="BG">BULGARIE</option>
      	<option value="BF">BURKINA FASO</option>
      	<option value="BI">BURUNDI</option>
      </optgroup>
      <optgroup label="C">
      	<option value="KY">CAIMANES, ILES</option>
      	<option value="KH">CAMBODGE</option>
      	<option value="CM">CAMEROUN</option>
      	<option value="CA">CANADA</option>
      	<option value="CV">CAP-VERT</option>
      	<option value="CF">CENTRAFRICAINE, REPUBLIQUE</option>
      	<option value="CL">CHILI</option>
      	<option value="CN">CHINE</option>
      	<option value="CX">CHRISTMAS, ILE</option>
      	<option value="CY">CHYPRE</option>
      	<option value="CC">COCOS (KEELING), ILES</option>
      	<option value="CO">COLOMBIE</option>
      	<option value="KM">COMORES</option>
      	<option value="CG">CONGO</option>
      	<option value="CD">CONGO, LA REPUBLIQUE DEMOCRATIQUE DU</option>
      	<option value="CK">COOK, ILES</option>
      	<option value="KR">COREE, REPUBLIQUE DE</option>
      	<option value="KP">COREE, REPUBLIQUE POPULAIRE DEMOCRATIQUE DE</option>
      	<option value="CR">COSTA RICA</option>
      	<option value="CI">COTE D'IVOIRE</option>
      	<option value="HR">CROATIE</option>
      	<option value="CU">CUBA</option>
      	<option value="CW">CURACAO</option>
      </optgroup>
      <optgroup label="D">
      	<option value="DK">DANEMARK</option>
      	<option value="DJ">DJIBOUTI</option>
      	<option value="DO">DOMINICAINE, REPUBLIQUE</option>
      	<option value="DM">DOMINIQUE</option>
      </optgroup>
      <optgroup label="E">
      	<option value="EG">EGYPTE</option>
      	<option value="SV">EL SALVADOR</option>
      	<option value="AE">EMIRATS ARABES UNIS</option>
      	<option value="EC">EQUATEUR</option>
      	<option value="ER">ERYTHREE</option>
      	<option value="ES">ESPAGNE</option>
      	<option value="EE">ESTONIE</option>
      	<option value="US">ETATS-UNIS</option>
      	<option value="ET">ETHIOPIE</option>
      </optgroup>
      <optgroup label="F">
      <option value="FK">FALKLAND, ILES (MALVINAS)</option>
      <option value="FO">FEROE, ILES</option>
      <option value="FJ">FIDJI</option>
      <option value="FI">FINLANDE</option>
      <option value="FR">FRANCE</option>
      </optgroup>
      <optgroup label="G">
      	<option value="GA">GABON</option>
      	<option value="GM">GAMBIE</option>
      	<option value="GE">GEORGIE</option>
      	<option value="GS">GEORGIE DU SUD ET LES ILES SANDWICH DU SUD</option>
      	<option value="GH">GHANA</option>
      	<option value="GI">GIBRALTAR</option>
      	<option value="GR">GRECE</option>
      	<option value="GD">GRENADE</option>
      	<option value="GL">GROENLAND</option>
      	<option value="GP">GUADELOUPE</option>
      	<option value="GU">GUAM</option>
      	<option value="GT">GUATEMALA</option>
      	<option value="GG">GUERNESEY</option>
      	<option value="GN">GUINEE</option>
      	<option value="GW">GUINEE-BISSAU</option>
      	<option value="GQ">GUINEE EQUATORIALE</option>
      	<option value="GY">GUYANA</option>
      	<option value="GF">GUYANE FRANCAISE</option>
      </optgroup>
      <optgroup label="H">
      	<option value="HT">HAITI</option>
      	<option value="HM">HEARD, ILE ET MCDONALD, ILES</option>
      	<option value="HN">HONDURAS</option>
      	<option value="HK">HONG KONG</option>
      	<option value="HU">HONGRIE</option>
      </optgroup>
      <optgroup label="I">
      	<option value="IM">ILE DE MAN</option>
      	<option value="UM">ILES MINEURES ELOIGNEES DES ETATS-UNIS</option>
      	<option value="VG">ILES VIERGES BRITANNIQUES</option>
      	<option value="VI">ILES VIERGES DES ETATS-UNIS</option>
      	<option value="IN">INDE</option>
      	<option value="ID">INDONESIE</option>
      	<option value="IR">IRAN, REPUBLIQUE ISLAMIQUE D'</option>
      	<option value="IQ">IRAQ</option>
      	<option value="IE">IRLANDE</option>
      	<option value="IS">ISLANDE</option>
      	<option value="IL">ISRAEL</option>
      	<option value="IT">ITALIE</option>
      </optgroup>
      <optgroup label="J">
      	<option value="JM">JAMAIQUE</option>
      	<option value="JP">JAPON</option>
      	<option value="JE">JERSEY</option>
      	<option value="JO">JORDANIE</option>
      </optgroup>
      <optgroup label="K">
      	<option value="KZ">KAZAKHSTAN</option>
      	<option value="KE">KENYA</option>
      	<option value="KG">KIRGHIZISTAN</option>
      	<option value="KI">KIRIBATI</option>
      	<option value="KW">KOWEIT</option>
      </optgroup>
      <optgroup label="L">
      	<option value="LA">LAO, REPUBLIQUE DEMOCRATIQUE POPULAIRE</option>
      	<option value="LS">LESOTHO</option>
      	<option value="LV">LETTONIE</option>
      	<option value="LB">LIBAN</option>
      	<option value="LR">LIBERIA</option>
      	<option value="LY">LIBYENNE, JAMAHIRIYA ARABE</option>
      	<option value="LI">LIECHTENSTEIN</option>
      	<option value="LT">LITUANIE</option>
      	<option value="LU">LUXEMBOURG</option>
      </optgroup>
      <optgroup label="M">
      	<option value="MO">MACAO</option>
      	<option value="MK">MACEDOINE, L'EX-REPUBLIQUE YOUGOSLAVE DE</option>
      	<option value="MG">MADAGASCAR</option>
      	<option value="MY">MALAISIE</option>
      	<option value="MW">MALAWI</option>
      	<option value="MV">MALDIVES</option>
      	<option value="ML">MALI</option>
      	<option value="MT">MALTE</option>
      	<option value="MP">MARIANNES DU NORD, ILES</option>
      	<option value="MA">MAROC</option>
      	<option value="MH">MARSHALL, ILES</option>
      	<option value="MQ">MARTINIQUE</option>
      	<option value="MU">MAURICE</option>
      	<option value="MR">MAURITANIE</option>
      	<option value="YT">MAYOTTE</option>
      	<option value="MX">MEXIQUE</option>
      	<option value="FM">MICRONESIE, ETATS FEDERES DE</option>
      	<option value="MD">MOLDOVA, REPUBLIQUE DE</option>
      	<option value="MC">MONACO</option>
      	<option value="MN">MONGOLIE</option>
      	<option value="ME">MONTENEGRO</option>
      	<option value="MS">MONTSERRAT</option>
      	<option value="MZ">MOZAMBIQUE</option>
      	<option value="MM">MYANMAR</option>
      </optgroup>
      <optgroup label="N">
      	<option value="NA">NAMIBIE</option>
      	<option value="NR">NAURU</option>
      	<option value="NP">NEPAL</option>
      	<option value="NI">NICARAGUA</option>
      	<option value="NE">NIGER</option>
      	<option value="NG">NIGERIA</option>
      	<option value="NU">NIUE</option>
      	<option value="NF">NORFOLK, ILE</option>
      	<option value="NO">NORVEGE</option>
      	<option value="NC">NOUVELLE-CALEDONIE</option>
      	<option value="NZ">NOUVELLE-ZELANDE</option>
      </optgroup>
      <optgroup label="O">
      	<option value="IO">OCEAN INDIEN, TERRITOIRE BRITANNIQUE DE L'</option>
      	<option value="OM">OMAN</option>
      	<option value="UG">OUGANDA</option>
      	<option value="UZ">OUZBEKISTAN</option>
      </optgroup>
      <optgroup label="P">
      	<option value="PK">PAKISTAN</option>
      	<option value="PW">PALAOS</option>
      	<option value="PS">PALESTINIEN OCCUPE, TERRITOIRE</option>
      	<option value="PA">PANAMA</option>
      	<option value="PG">PAPOUASIE-NOUVELLE-GUINEE</option>
      	<option value="PY">PARAGUAY</option>
      	<option value="NL">PAYS-BAS</option>
      	<option value="PE">PEROU</option>
      	<option value="PH">PHILIPPINES</option>
      	<option value="PN">PITCAIRN</option>
      	<option value="PL">POLOGNE</option>
      	<option value="PF">POLYNESIE FRANCAISE</option>
      	<option value="PR">PORTO RICO</option>
      	<option value="PT">PORTUGAL</option>
      </optgroup>
      <optgroup label="Q">
      	<option value="QA">QATAR</option>
      </optgroup>
      <optgroup label="R">
      	<option value="RE">REUNION</option>
      	<option value="RO">ROUMANIE</option>
      	<option value="GB">ROYAUME-UNI</option>
      	<option value="RU">RUSSIE, FEDERATION DE</option>
      	<option value="RW">RWANDA</option>
      </optgroup>
      <optgroup label="S">
      	<option value="EH">SAHARA OCCIDENTAL</option>
      	<option value="BL">SAINT-BARTHELEMY</option>
      	<option value="SH">SAINTE-HELENE, ASCENSION ET TRISTAN DA CUNHA</option>
      	<option value="LC">SAINTE-LUCIE</option>
      	<option value="KN">SAINT-KITTS-ET-NEVIS</option>
      	<option value="SM">SAINT-MARIN</option>
      	<option value="MF">SAINT-MARTIN (PARTIE FRANCAISE)</option>
      	<option value="SX">SAINT-MARTIN (PARTIE NEERLANDAISE)</option>
      	<option value="PM">SAINT-PIERRE-ET-MIQUELON</option>
      	<option value="VA">SAINT-SIEGE (ETAT DE LA CITE DU VATICAN)</option>
      	<option value="VC">SAINT-VINCENT-ET-LES GRENADINES</option>
      	<option value="SB">SALOMON, ILES</option>
      	<option value="WS">SAMOA</option>
      	<option value="AS">SAMOA AMERICAINES</option>
      	<option value="ST">SAO TOME-ET-PRINCIPE</option>
      	<option value="SN">SENEGAL</option>
      	<option value="RS">SERBIE</option>
      	<option value="SC">SEYCHELLES</option>
      	<option value="SL">SIERRA LEONE</option>
      	<option value="SG">SINGAPOUR</option>
      	<option value="SK">SLOVAQUIE</option>
      	<option value="SI">SLOVENIE</option>
      	<option value="SO">SOMALIE</option>
      	<option value="SD">SOUDAN</option>
      	<option value="LK">SRI LANKA</option>
      	<option value="SE">SUEDE</option>
      	<option value="CH">SUISSE</option>
      	<option value="SR">SURINAME</option>
      	<option value="SJ">SVALBARD ET ILE JAN MAYEN</option>
      	<option value="SZ">SWAZILAND</option>
      	<option value="SY">SYRIENNE, REPUBLIQUE ARABE</option>
      </optgroup>
      <optgroup label="T">
      	<option value="TJ">TADJIKISTAN</option>
      	<option value="TW">TAIWAN, PROVINCE DE CHINE</option>
      	<option value="TZ">TANZANIE, REPUBLIQUE-UNIE DE</option>
      	<option value="TD">TCHAD</option>
      	<option value="CZ">TCHEQUE, REPUBLIQUE</option>
      	<option value="TF">TERRES AUSTRALES FRANCAISES</option>
      	<option value="TH">THAILANDE</option>
      	<option value="TL">TIMOR-LESTE</option>
      	<option value="TG">TOGO</option>
      	<option value="TK">TOKELAU</option>
      	<option value="TO">TONGA</option>
      	<option value="TT">TRINITE-ET-TOBAGO</option>
      	<option value="TN">TUNISIE</option>
      	<option value="TM">TURKMENISTAN</option>
      	<option value="TC">TURKS ET CAIQUES, ILES</option>
      	<option value="TR">TURQUIE</option>
      	<option value="TV">TUVALU</option>
      </optgroup>
      <optgroup label="U">
      	<option value="UA">UKRAINE</option>
      	<option value="UY">URUGUAY</option>
      </optgroup>
      <optgroup label="V">
      	<option value="VU">VANUATU</option>
      	<option value="VA">VATICAN, ETAT DE LA CITE DU</option>
      	<option value="VE">VENEZUELA, REPUBLIQUE BOLIVARIENNE DU</option>
      	<option value="VN">VIET NAM</option>
      </optgroup>
      <optgroup label="W">
      	<option value="WF">WALLIS ET FUTUNA</option>
      </optgroup>
      <optgroup label="Y">
      	<option value="YE">YEMEN</option>
      </optgroup>
      <optgroup label="Z">
      	<option value="ZM">ZAMBIE</option>
      	<option value="ZW">ZIMBABWE</option>
      </optgroup>
    </select>
		<?php
  }

	public function centralPointHtml() {
		?>
		<input type="text" name="centralPoint" id="alvi_admin" style="width:500px;" value="<?php echo get_option('centralPoint') ?>" />
		<?php
	}

	public function dailyPriceHtml() {
		?>
		<input type="text" name="dailyPrice" id="dailyPrice" value="<?php echo get_option('dailyPrice') ?>" />
		<?php
	}

	public function nightlyPriceHtml() {
		?>
		<input type="text" name="nightlyPrice" id="nightlyPrice" value="<?php echo get_option('nightlyPrice') ?>" />
		<?php
	}

	public function dayBeginsAtHtml() {
		?>
		<input type="text" name="dayBeginsAt" id="dayBeginsAt" value="<?php echo get_option('dayBeginsAt') ?>" />
		<?php
	}

	public function dayEndsAtHtml() {
		?>
		<input type="text" name="dayEndsAt" id="dayEndsAt" value="<?php echo get_option('dayEndsAt') ?>" />
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
