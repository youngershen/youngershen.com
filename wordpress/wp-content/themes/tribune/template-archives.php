<?php
/*
Template Name: Archives Page
*/

get_header();

?>

<div id="main">

<?php
if (have_posts()) :

	while (have_posts()) :

		the_post();

		?><div class="post">

			<h1><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>

			<div class="col_arch">
				<div class="left"><?php _e('By Months:', 'wpzoom'); ?></div>
				<div class="right"><ul><?php wp_get_archives('type=monthly&show_post_count=1'); ?></ul></div>
			</div>

			<div class="col_arch">
				<div class="left"><?php _e('By Categories:', 'wpzoom'); ?></div>
				<div class="right"><ul><?php wp_list_categories('title_li=&hierarchical=0&show_count=1'); ?></ul></div>
			</div>

			<div class="col_arch">
				<div class="left"><?php _e('By Tags:', 'wpzoom'); ?></div>
				<div class="right"><ul><?php wp_tag_cloud('format=list&smallest=12&largest=12&unit=px'); ?></ul></div>
			</div>

			<div class="meta"><?php edit_post_link( __('Edit', 'wpzoom'), ' ', ''); ?> </div>

		</div> <!-- /.post -->

		</div> <!-- /#main -->
		<?php get_sidebar(); ?>

		<?php

	endwhile;

endif;

wp_reset_query();

get_footer();
?>