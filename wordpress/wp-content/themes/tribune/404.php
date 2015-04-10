<?php get_header(); ?>

<div id="main">

	<h3 class="catname"><?php _e('Error 404 - Nothing Found', 'wpzoom'); ?></h3>

	<?php if ( have_posts() ) : $count = 0; while ( have_posts() ) : the_post(); $count++; endwhile; else: ?>

		<div class="post">
			<div class="entry">
				<h3><?php _e('The page you are looking for could not be found.', 'wpzoom'); ?></h3>
			</div>
		</div>

	<?php endif; ?>

</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>