<?php get_header(); ?>

<div id="main">

<?php if (have_posts()) :

	while (have_posts()) :

		the_post();

		?><div class="post">
			<h1><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
			<div class="meta"><?php edit_post_link( __('Edit this post', 'wpzoom'), ' ', ''); ?></div>
			<div class="entry"><?php the_content(); ?></div>
			<?php wp_link_pages('before=<div class="nextpage">Pages: &after=</div>'); ?>
		</div> <!-- /.post -->

		</div> <!-- /#main -->

		<?php get_sidebar(); ?>

		<?php

	endwhile;

endif;

wp_reset_query();

get_footer();
?>