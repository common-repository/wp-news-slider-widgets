<?php if ( ! defined( 'ABSPATH' ) ) exit;

function gen_nsw_init_new(){
	global $table_prefix, $wpdb;
	$table_newsslider = $table_prefix."gen_news_slider_widgets";
	
	$sql = "CREATE TABLE IF NOT EXISTS $table_newsslider (
			  id int(11) NOT NULL auto_increment,
			  `title` mediumtext character set utf8 collate utf8_unicode_ci NOT NULL,
        `description` mediumtext character set utf8 collate utf8_unicode_ci NOT NULL,
        `status` mediumtext character set utf8 collate utf8_unicode_ci NOT NULL,
        `image_name` varchar(150) character set utf8 collate utf8_unicode_ci default NULL,
        `image_url` varchar(350) character set utf8 collate utf8_unicode_ci default NULL,
			  `date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
			  PRIMARY KEY  (id)
			);";			
	$wpdb->query($sql);
}

function gen_add_nsw_admin_page(){
    $iconUrl= GEN_USTS_NSW_BASE_URL . '/images/icon.png';
	add_object_page('News-Slider', 'News-Slider', 8, __FILE__, 'gen_nsw_view_news',$iconUrl);
	add_submenu_page( __FILE__, 'News','News', 8, __FILE__,'gen_nsw_view_news' );
    add_submenu_page(__FILE__, 'News-Slider', 'Add News', 8, 'add-news', 'gen_nsw_add_news');
	add_submenu_page(__FILE__, 'Pro-Version', 'Pro Version', 8, 'pro-version', 'gen_pro_version');
	
}
function gen_pro_version(){
	include_once('gen-news-slider-pro-version.php');
}
function gen_nsw_install(){
	$newoptions = get_option('gen_nsw_add_news');
	add_option('gen_nsw_add_news', $newoptions);
}

function gen_nsw_uninstall(){
	delete_option('scroller_options');
}

add_action('admin_menu', 'gen_add_nsw_admin_page');
register_activation_hook( __FILE__, 'gen_nsw_install' );
register_deactivation_hook( __FILE__, 'gen_nsw_uninstall' );

add_action( 'widgets_init', create_function( '', 'register_widget( "gen_nsw_widget" );' ) );

?>