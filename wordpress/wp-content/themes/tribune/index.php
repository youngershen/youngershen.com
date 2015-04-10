<?php get_header(); ?>
<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; // gets current page number ?>

<?php
if ( option::get('ad_home_select') == 'on' ) { ?>

<div id="home_ad">
<?php
	if ( option::get('ad_home_code') <> "" ) {
		echo stripslashes(option::get('ad_home_code'));
	} else {
		?><a href="<?php echo option::get('ad_home_imgurl'); ?>"><img src="<?php echo option::get('ad_home_imgpath'); ?>" alt="<?php echo option::get('ad_home_imgalt'); ?>" /></a><?php
	}

?></div><?php
}
?>


<div id="main">

	<?php if ( $paged < 2 && option::get('feat_show') == 'on' ) get_template_part('wpzoom', 'featured'); ?>


	<?php if ( is_home() && $paged < 2) { ?>
		<?php if (function_exists('dynamic_sidebar')) { dynamic_sidebar('Homepage'); } ?>
		<div class="clear"></div>
		<?php if (option::get('recent_posts') == 'on') { ?><div class="section_separator"></div><?php } ?>
	<?php } ?>


	<?php if ( $paged > 1 || option::get('recent_posts') == 'on') { ?>

	 	<div id="posts">

	  		<h3 class="recent_title"><?php echo option::get('recent_title'); ?></h3>

			<?php
				global $query_string; // required

				/* Exclude categories from Recent Posts */
				if (option::get('recent_part_exclude') != 'off') {
					if (count(option::get('recent_part_exclude'))){
						$exclude_cats = implode(",-",option::get('recent_part_exclude'));
						$exclude_cats = '-' . $exclude_cats;
						$args['cat'] = $exclude_cats;
					}
				}

				/* Exclude featured posts from Recent Posts */
				if (option::get('hide_featured') == 'on') {

					$featured_posts = new WP_Query(
						array(
							'post__not_in' => get_option( 'sticky_posts' ),
							'posts_per_page' => option::get('featured_art_number'),
							'meta_key' => 'wpzoom_is_featured',
							'meta_value' => 1
							) );

					while ($featured_posts->have_posts()) {
						$featured_posts->the_post();
						global $post;
						$postIDs[] = $post->ID;
					}
					$args['post__not_in'] = $postIDs;
				}

				$args['paged'] = $paged;
				if (count($args) >= 1) {
					query_posts($args);
				}
				?>

			<?php get_template_part('loop'); ?>

	 	</div> <!-- /#posts -->

	<?php } ?>

</div><!-- /#main -->

<?php get_sidebar(); ?>

<?php
if ( option::get('slider_enable') == 'on' ) get_template_part('wpzoom', 'slider');

get_footer(); ?>