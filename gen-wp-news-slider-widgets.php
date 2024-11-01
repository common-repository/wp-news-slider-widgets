<?php if ( ! defined( 'ABSPATH' ) ) exit;
/*
Plugin Name: WP News Slider Widgets
Plugin URI: http://www.upscalethought.com
Description: Wordpress News Slider Widgets plugin is a wordpress plugin to show the wordpress news post with different effect using widget.
Version: 1.1
Author: upscalethought
Author URI: http://www.upscalethought.com
*/
define("GEN_USTS_NSW_BASE_URL", WP_PLUGIN_URL.'/'.plugin_basename(dirname(__FILE__)));

include ('includes/gen-nsw-manager.php');
include ('includes/gen-nsw-widget.php');
include ('includes/gen-nsw-init.php');

function gen_nsw_init(){
  wp_enqueue_style('nsw-style',esc_url(GEN_USTS_NSW_BASE_URL.'/css/gen_nsw_style.css'));
  wp_enqueue_script('jquery');  
  wp_enqueue_script( 'nsw-js', esc_url(plugins_url( '/js/gen_nsw.js', __FILE__ )));
}

add_action('init','gen_nsw_init');
?>