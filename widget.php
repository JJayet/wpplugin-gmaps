<?php
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
?>
