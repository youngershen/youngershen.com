<?php
/*
Plugin Name: Simple Links
Plugin URI: http://matlipe.com/simple-links-docs/
Description: Replacement for WordPress Links Manager with many added features.
Version: 3.1.2
Author: Mat Lipe
Author URI: http://matlipe.com/
Contributors: Mat Lipe
*/


define( 'SIMPLE_LINKS_VERSION', '3.1.2' );

define( 'SIMPLE_LINKS_DIR', plugin_dir_path( __FILE__ ) );
define( 'SIMPLE_LINKS_URL', plugin_dir_url( __FILE__ ) );
define( 'SIMPLE_LINKS_ASSETS_URL', SIMPLE_LINKS_URL . 'assets/' );
define( 'SIMPLE_LINKS_IMG_DIR', SIMPLE_LINKS_ASSETS_URL . 'img/' );
define( 'SIMPLE_LINKS_JS_DIR', SIMPLE_LINKS_ASSETS_URL . 'js/' );
define( 'SIMPLE_LINKS_JS_PATH', SIMPLE_LINKS_DIR . 'assets/js/' );
define( 'SIMPLE_LINKS_CSS_DIR', SIMPLE_LINKS_ASSETS_URL . 'css/' );

require( 'template-tags.php' );
require( 'widgets/SL_links_main.php' );

function simple_links_autoload( $class ){
	if( file_exists( SIMPLE_LINKS_DIR . 'classes/' . $class . '.php' ) ){
		require( SIMPLE_LINKS_DIR . 'classes/' . $class . '.php' );
	}
	if( file_exists( SIMPLE_LINKS_DIR . 'includes/' . $class . '.php' ) ){
		require( SIMPLE_LINKS_DIR . 'includes/' . $class . '.php' );
	}
}
spl_autoload_register( 'simple_links_autoload' );


/** @var simple_links $simple_links */
$simple_links = simple_links();
if( is_admin() ){
	/** @var simple_links_admin $simple_links_admin_func */
	$simple_links_admin_func = simple_links_admin();
}

function simple_links_load(){
	Simple_Links_Categories::get_instance();
	add_action( 'init', array( 'Simple_Link', 'register_sl_post_type' ) );

	if( is_admin() ){
		Simple_Links_Settings::init();
	}
}
add_action( 'plugins_loaded', 'simple_links_load' );



#-- Let know about Pro Version
add_action( 'simple_links_widget_form', 'simple_links_pro_notice' );
add_action( 'simple_links_shortcode_form', 'simple_links_pro_notice' );
function simple_links_pro_notice(){
	if( defined( 'SIMPLE_LINKS_DISPLAY_BY_CATEGORY_VERSION' ) || defined( 'SIMPLE_LINKS_CSV_IMPORT_VERSION' ) || defined( 'SIMPLE_LINKS_SEARCH_VERSION' ) ){
		return;
	}
	require( SIMPLE_LINKS_DIR . 'admin-views/pro-notice.php' );
}



