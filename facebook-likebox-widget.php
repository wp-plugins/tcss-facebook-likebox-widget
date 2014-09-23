<?php
/**
 * Plugin Name: TCSS Facebook Likebox Widget
 * Plugin URI: http://tcss.co.in/facebook-likebox-widget
 * Description: This widget can be used in your wordpress site to show fanbox and users will be able to like your facebook page
 * Version: 0.1.0
 * Author: gsjha
 * Author URI: http://gsjha.com
 * License: GPL2
 */

function add_facebookscripts(){
	wp_enqueue_style('tcssfblbcss', plugins_url().'/tcss-facebook-likebox-widget/css/facebook.css');
}
add_action('wp_enqueue_scripts','add_facebookscripts');

include('class.facebook-likebox-widget.php');

function register_tcss_facebook_fanbox_widget() {
	register_widget('TCSS_Facebook_Likebox_Widget');
}
add_action('widgets_init','register_tcss_facebook_fanbox_widget');

?>