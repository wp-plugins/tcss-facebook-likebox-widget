<?php
//The following function will retrieve all the avaialable 
//options from the wordpress database

function tcss_retrieve_options(){
	global $wpdb;
	
	$opt_val = array( 
			'fb_border_color' => '#E9E9E9',
			'width' => 350,
			'height' => 296,
			'color_scheme' => 'light',
			'show_faces' => 'true',
			'stream' => 'false',
			'header' => 'false',
	); 
	return $opt_val;
}

class TCSS_Facebook_Likebox_Widget extends WP_Widget {

	// construct the widget
	public function __construct() {
		parent::__construct(
 		'tcss_facebook_widget', // Base ID
		'TCSS Facebook likebox', // Name
		array( 'description' => __( 'TCSS Facebook likebox widget', 'gsjha_tcss' ), ) // Args
	);
	}

	public function widget( $args, $instance ){
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		$url = isset($instance['url'])? $instance['url'] : '';
		$fbwidth = $instance['fbwidth'];
		$fbheight = $instance['fbheight'];

		$iframe = 'iframe';
		$option_value = tcss_retrieve_options();
		$option_value['fb_url'] = str_replace(":", "%3A", $url);
		$option_value['fb_url'] = str_replace("/", "%2F", $option_value['fb_url']);
		$option_value['width'] = $fbwidth;
		$option_value['height'] = $fbheight;
		extract($args);
	        
		echo $before_widget;
		if (!empty($title))
		echo $before_title . $title . $after_title;

		?><div class="facebook-wrap"><div class="facebook-container" style="width:<?php echo $option_value['width'];?>px;height:<?php echo $option_value['height'];?>px">
		<<?php echo $iframe; ?> 
		src="//www.facebook.com/plugins/likebox.php?href=<?php echo $option_value['fb_url'];?>&amp;width=<?php echo $option_value['width'];?>&amp;height=<?php echo $option_value['height'];?>&amp;colorscheme=<?php echo $option_value['color_scheme'];?>&amp;show_faces=<?php echo $option_value['show_faces'];?>&amp;stream=<?php echo $option_value['stream'];?>&amp;header=<?php echo $option_value['header'];?>&amp;border_color=%23<?php echo str_replace("#","",$option_value['fb_border_color']);?>" 
	        style="border:1px solid <?php echo $option_value['fb_border_color'];?>; overflow:hidden; width:<?php echo $option_value['width'];?>px; height:<?php echo $option_value['height'];?>px;">
		</<?php echo $iframe; ?>>
		</div></div>
	<?php		
		echo $after_widget;
	}

	public function form( $instance ) {
		
		if ( isset( $instance[ 'title' ] ) ) {
		
			$title = $instance[ 'title' ];
		} else {
		
		$title = __( 'Facebook Likes', 'gsjha_tcss' );
		}

		

		$url = isset($instance['url'])? esc_url( $instance['url'] ) : 'https://www.facebook.com/tcsspvtltd';

		$fbwidth = isset($instance['fbwidth'])? $instance['fbwidth'] : 350;
		$fbheight = isset($instance['fbheight'])? $instance['fbheight'] : 290;
	
		# Title
		echo '<p><label for="' . $this->get_field_id('title') . '">' . 'Title:' . '</label><input class="widefat" id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . $title . '" /></p>';
		# URL
		echo '<p><label for="' . $this->get_field_id('url') . '">' . 'Facebook:' . '</label><input class="widefat" id="' . $this->get_field_id('url') . '" name="' . $this->get_field_name('url') . '" type="text" value="' . $url . '" /></p>';
		# Width
		echo '<p><label for="' . $this->get_field_id('fbwidth') . '">' . 'Width:' . '</label><input class="widefat" id="' . $this->get_field_id('fbwidth') . '" type="number" value="' . $fbwidth . '" name="' . $this->get_field_name('fbwidth') . '"/></p>';
		# height
		echo '<p><label for="' . $this->get_field_id('fbheight') . '">' . 'Height:' . '</label><input class="widefat" id="' . $this->get_field_id('fbheight') . '" type="number" value="' . $fbheight . '" name="' . $this->get_field_name('fbheight') . '"/></p>';
		
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['url'] = strip_tags( $new_instance['url'] );
		$instance['fbwidth'] = ( !empty( $new_instance['fbwidth'])) ? strip_tags( $new_instance['fbwidth']) : '';
		$instance['fbheight'] = strip_tags( $new_instance['fbheight'] );

		return $instance;
	}
}