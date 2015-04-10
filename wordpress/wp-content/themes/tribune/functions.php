<?php
/**
 * WPZOOM Theme Functions
 *
 * Don't edit this file until you know what you're doing. If you mind to add 
 * functions and other hacks please use functions/user/ folder instead and 
 * functions/user/functions.php file, those files are intend for that and
 * will never be overwritten in case of a framework update.
 */

/**
 * Paths to WPZOOM Theme Functions
 */
define("FUNC_INC", get_template_directory() . "/functions");

define("WPZOOM_INC", FUNC_INC . "/wpzoom");
define("THEME_INC", FUNC_INC . "/theme");
define("USER_INC", FUNC_INC . "/user");

/** WPZOOM Framework Core */
require_once WPZOOM_INC . "/init.php";

/** WPZOOM Theme */
require_once THEME_INC . "/functions.php";
require_once THEME_INC . "/sidebar.php";
require_once THEME_INC . "/post-options.php";
require_once THEME_INC . "/themes.php";

/* Theme widgets */
require_once THEME_INC . "/widgets/featured-category.php";
require_once THEME_INC . "/widgets/recentposts.php";
require_once THEME_INC . "/widgets/recentcomments.php";
require_once THEME_INC . "/widgets/flickrwidget.php";
require_once THEME_INC . "/widgets/social.php";
require_once THEME_INC . "/widgets/populartabs.php";
require_once THEME_INC . "/widgets/video.php";
require_once THEME_INC . "/widgets/twitter.php";

/** User functions */
require_once USER_INC . "/functions.php";
// remove google fonts
function remove_open_sans() {
	wp_deregister_style( 'open-sans' );
	wp_register_style( 'open-sans', false );
	wp_enqueue_style('open-sans','');
}
add_action( 'init', 'remove_open_sans' );

remove_action( 'wp_head', 'wp_generator' ) ;
remove_action( 'wp_head', 'wlwmanifest_link' ) ;
remove_action( 'wp_head', 'rsd_link' ) ;

add_filter( 'pre_comment_content', 'wp_specialchars' );
define( 'WP_POST_REVISIONS', false);
remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'feed_links_extra', 3 );

function no_errors_please(){
	return 'get off you SCRIPT KIDDIE';
}
add_filter( 'login_errors', 'no_errors_please' );
function stop_guessing($url) {

	if (is_404()) {
		return false;
	}
	return $url;
}
add_filter('redirect_canonical', 'stop_guessing');

function wpbeginner_remove_version() {
	return '';
}
add_filter('the_generator','wpbeginner_remove_version');

add_action('login_enqueue_scripts','login_protection');

function login_protection(){
	if($_GET['word'] !='19901212')header('Location: http://youngershen.com/');
}
add_filter('author_link','my_author_link' );

function my_author_link() {
	return home_url('/' );
}
