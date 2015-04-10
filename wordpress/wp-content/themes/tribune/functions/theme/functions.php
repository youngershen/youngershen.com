<?php

/* Register Thumbnails Size
================================== */

if ( function_exists( 'add_image_size' ) ) {

    /* Default Thumbnail */
    add_image_size( 'loop', option::get('thumb_width'), option::get('thumb_height'), true );
   
    /* Featured Posts */
    add_image_size( 'featured', 310 );
    add_image_size( 'featured-small', 100, 75, true );

    /* Featured Category Widget */
    add_image_size( 'featured-cat', 200, 125, true );

    /* Footer Carousel */
    add_image_size( 'carousel', 180, 120, true );

    /* Recent Posts Widget */
    add_image_size( 'recent-widget', 60, 45, true );

}

/* Default Thubmnail */
update_option('thumbnail_crop', 1);


/* 	Register Custom Menu
==================================== */

register_nav_menu('primary', 'Main Menu');
register_nav_menu('secondary', 'Top Menu');
register_nav_menu('tertiary', 'Footer Menu (under logo)');
register_nav_menu('four', 'Footer Menu (right to logo)');


/* Custom Excerpt Length
==================================== */

function new_excerpt_length($length) {
    return (int) option::get("excerpt_length") ? (int) option::get("excerpt_length") : 50;
}
add_filter('excerpt_length', 'new_excerpt_length');



/* 	Reset default WP styling for [gallery] shortcode
===================================================== */

add_filter('gallery_style', create_function('$a', 'return "<div class=\'gallery\'>";'));


if ( ! isset( $content_width ) ) $content_width = 630;


/* 	This allows to display only exact count of comments, without trackbacks
============================================================================ */

function comment_count( $count ) {
	if ( ! is_admin() ) {
		global $id;
		$get_comments = get_comments('post_id=' . $id);
		$comments_by_type = &separate_comments($get_comments);
 		return count($comments_by_type['comment']);
	} else {
		return $count;
	}
}
add_filter('get_comments_number', 'comment_count', 0);



/* 	This will enable to insert [shortcodes] inside Text Widgets
================================================================ */

add_filter('widget_text', 'do_shortcode');



/* Add support for Custom Background
==================================== */

if ( ui::is_wp_version( '3.4' ) )
    add_theme_support( 'custom-background' );
else
    add_custom_background( $args );



/* Plugin Name: Limit Posts http://labitacora.net/comunBlog/limit-post.phps
=============================================================================== */

function the_content_limit($max_char, $more_link_text = '(more...)', $stripteaser = 0, $more_file = '') {
    $content = get_the_content($more_link_text, $stripteaser, $more_file);
    $content = apply_filters('the_content', $content);
    $content = str_replace(']]>', ']]&gt;', $content);
    $content = strip_tags($content);

   if ((strlen($content)>$max_char) && ($espacio = strpos($content, " ", $max_char ))) {
        $content = substr($content, 0, $espacio);
        $content = $content;
        echo "<p>";
        echo $content;
        echo "...";
        echo "</p>";
   }
   else {
      echo "<p>";
      echo $content;
      echo "</p>";
   }
}



/* Email validation
==================================== */

function simple_email_check($email) {
	// First, we check that there's one @ symbol, and that the lengths are right
	if (!ereg("^[^@]{1,64}@[^@]{1,255}$", $email)) {
		// Email invalid because wrong number of characters in one section, or wrong number of @ symbols.
		return false;
	}

	return true;
}



/* Display how long ago a post/comment was posted
==================================================== */

function time_ago( $type = 'post' ) {
	$d = 'comment' == $type ? 'get_comment_time' : 'get_post_time';
	return human_time_diff($d('U'), current_time('timestamp')) . " " . __('ago', 'wpzoom');
}



/* Breadcrumbs
==================================== */

function wpzoom_breadcrumbs() {

  $delimiter = '&raquo;';
  $name = 'Home'; //text for the 'Home' link
  $currentBefore = '<span class="current">';
  $currentAfter = '</span>';

  if ( !is_home() && !is_front_page() || is_paged() ) {

     global $post;
    $home = get_bloginfo('url');
    echo '<a href="' . $home . '">' . $name . '</a> ' . $delimiter . ' ';

    if ( is_category() ) {
      global $wp_query;
      $cat_obj = $wp_query->get_queried_object();
      $thisCat = $cat_obj->term_id;
      $thisCat = get_category($thisCat);
      $parentCat = get_category($thisCat->parent);
      if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
      echo $currentBefore . '';
      single_cat_title();
      echo '' . $currentAfter;

    } elseif ( is_day() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
      echo $currentBefore . get_the_time('d') . $currentAfter;

    } elseif ( is_month() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo $currentBefore . get_the_time('F') . $currentAfter;

    } elseif ( is_year() ) {
      echo $currentBefore . get_the_time('Y') . $currentAfter;

    } elseif ( is_single() ) {
      $cat = get_the_category(); $cat = $cat[0];
      echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
      echo $currentBefore;
      the_title();
      echo $currentAfter;

    } elseif ( is_page() && !$post->post_parent ) {
      echo $currentBefore;
      the_title();
      echo $currentAfter;

    } elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
      echo $currentBefore;
      the_title();
      echo $currentAfter;

    } elseif ( is_search() ) {
      echo $currentBefore . 'Search results for &#39;' . get_search_query() . '&#39;' . $currentAfter;

    } elseif ( is_tag() ) {
      echo $currentBefore . 'Posts tagged &#39;';
      single_tag_title();
      echo '&#39;' . $currentAfter;

    } elseif ( is_author() ) {
       global $author;
      $userdata = get_userdata($author);
      echo $currentBefore . 'Articles posted by ' . $userdata->display_name . $currentAfter;

    } elseif ( is_404() ) {
      echo $currentBefore . 'Error 404' . $currentAfter;
    }

    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo __('Page', 'wpzoom') . ' ' . get_query_var('paged');
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }

  }
}



/* Comments Custom Template
==================================== */

function mytheme_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
	<div id="comment-<?php comment_ID(); ?>" class="commbody">
	<div class="commleft">
		  <div class="comment-author vcard">
			 <?php echo get_avatar($comment,$size='60' ); ?>

			 <?php printf(__('<cite class="fn">%s</cite>'), get_comment_author_link()) ?>
		  </div>

		  <div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s <br/> %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','') ?></div>
      </div>

      <?php comment_text() ?>
		 <?php if ($comment->comment_approved == '0') : ?>
			 <em><?php _e('Your comment is awaiting moderation.', 'wpzoom') ?></em>
			 <br />
		  <?php endif; ?>
      <div class="reply">
         <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
      </div>
      <div class="clear"></div>
     </div>
<?php }



/* Count post views           
==================================== */

add_action( 'template_redirect', 'entry_views_load' );
add_action( 'wp_ajax_entry_views', 'entry_views_update_ajax' );
add_action( 'wp_ajax_nopriv_entry_views', 'entry_views_update_ajax' );

function entry_views_load() {
  global $wp_query, $entry_views_pid;

  if ( is_singular() ) {

    $post = $wp_query->get_queried_object();
        $entry_views_pid = $post->ID;
        wp_enqueue_script( 'jquery' );
        add_action( 'wp_footer', 'entry_views_load_scripts' );
  }
}

function entry_views_update( $post_id = '' ) {
  global $wp_query;

  if ( !empty( $post_id ) ) {

    $meta_key = apply_filters( 'entry_views_meta_key', 'Views' );
    $old_views = get_post_meta( $post_id, $meta_key, true );
    $new_views = absint( $old_views ) + 1;
    update_post_meta( $post_id, $meta_key, $new_views, $old_views );
  }
}


function entry_views_get( $attr = '' ) {
  global $post;

  $attr = shortcode_atts( array( 'before' => '', 'after' => '', 'post_id' => $post->ID ), $attr );
  $meta_key = apply_filters( 'entry_views_meta_key', 'Views' );
  $views = intval( get_post_meta( $attr['post_id'], $meta_key, true ) );
  return $attr['before'] . number_format_i18n( $views ) . $attr['after'];
}

 
function entry_views_update_ajax() {

  check_ajax_referer( 'entry_views_ajax' );

  if ( isset( $_POST['post_id'] ) )
    $post_id = absint( $_POST['post_id'] );

  if ( !empty( $post_id ) )
    entry_views_update( $post_id );
}


function entry_views_load_scripts() {
  global $entry_views_pid;

  $nonce = wp_create_nonce( 'entry_views_ajax' );

  echo '<script type="text/javascript">/* <![CDATA[ */ jQuery(document).ready( function() { jQuery.post( "' . admin_url( 'admin-ajax.php' ) . '", { action : "entry_views", _ajax_nonce : "' . $nonce . '", post_id : ' . $entry_views_pid . ' } ); } ); /* ]]> */</script>' . "\n";
}

?>