<?php get_header();
	if (is_author()) {
		$curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
	}
?>

<div id="main">

	<div id="posts">

		<h3 class="recent_title">
			<?php /* category archive */ if (is_category()) { ?><?php single_cat_title(); ?>
			<?php /* tag archive */ } elseif( is_tag() ) { ?><?php _e('Post Tagged with:', 'wpzoom'); ?> <strong>"<?php single_tag_title(); ?>"</strong>
			<?php /* daily archive */ } elseif (is_day()) { ?><?php _e('Archive for', 'wpzoom'); ?> <strong><?php the_time('F jS, Y'); ?></strong>
			<?php /* monthly archive */ } elseif (is_month()) { ?><?php _e('Archive for', 'wpzoom'); ?> <strong><?php the_time('F, Y'); ?></strong>
			<?php /* yearly archive */ } elseif (is_year()) { ?><?php _e('Archive for', 'wpzoom'); ?> <strong><?php the_time('Y'); ?></strong>
			<?php /* author archive */ } elseif (is_author()) { ?><?php _e( 'Articles by: ', 'wpzoom' ); echo $curauth->display_name; ?><?php  echo get_avatar( $curauth->ID , 60 ); ?><br /><small><?php echo $curauth->description; ?></small><div class="clear"></div>
 			<?php /* paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
			<?php _e('Archives', 'wpzoom'); ?><?php } ?>
			 
		</h3>

		<?php get_template_part('loop'); ?>

	</div> <!-- /#posts -->

</div> <!-- /#main -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>