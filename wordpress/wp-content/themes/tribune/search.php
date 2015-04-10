<?php get_header(); ?>

<div id="main">

	<div id="posts">

		<h3 class="recent_title"><?php _e('Search Results for:', 'wpzoom'); ?> <strong>"<?php the_search_query(); ?>"</strong></h3>

		<?php if ( have_posts() ) :

			$post = $posts[0]; // Hack. Set $post so that the_date() works.

			get_template_part('loop');

				 

		else :

			?><div class="archive">
				<div class="entry">
					<h2><?php _e('No results', 'wpzoom'); ?></h2>
					<?php get_template_part('searchform'); ?>
				</div>
			</div><?php

		endif; ?>

	</div> <!-- /#posts -->
	
</div> <!-- /#main -->
 
<?php get_sidebar(); ?>

<?php get_footer(); ?>