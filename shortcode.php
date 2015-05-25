<?php

  class AlviMaps_ShortCode
  {
      public function __construct()
      {
          add_shortcode('alvi_fullmap', array($this, 'alvi_fullmap'));
      }

      public function alvi_fullmap($atts, $content) {
      	?>
  	    <div id="map-canvas" style="height:300px;border-style:solid;border-width:5px;"></div>
      	<?php
  	}
  }
?>
