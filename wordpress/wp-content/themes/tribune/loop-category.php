<?php 
	global $do_not_duplicate;
	if ( have_posts() ) :

	while ( have_posts() ) : the_post(); 
	if ($do_not_duplicate && in_array($post->ID,$do_not_duplicate)) { continue; } ?>

		<div class="post" id="post-<?php the_ID(); ?>">

			<h2 class="title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>	</h2>

			<div class="meta">
				<?php
				if ( option::get('display_date') == 'on' ) { ?><span class="date"><?php the_date(); ?> <?php the_time(); ?></span><?php }
				if ( option::get('display_comm_count') == 'on' ) { ?><span class="comments"><?php comments_popup_link(__('0 comments', 'wpzoom'), __('1 comment', 'wpzoom'), __('% comments', 'wpzoom')); ?></span><?php }
				edit_post_link( __('Edit this post', 'wpzoom'), ' ', '');
				?>
			</div>

			<?php if (option::get('index_thumb') == 'on') {
	 			get_the_image( array( 'width' => option::get('thumb_width'), 'height' => option::get('thumb_height'), 'before' => '<div class="post-thumb">', 'after' => '</div>' ) );
	 		} ?>

			<div class="entry">
				<?php if ( option::get('display_content') == 'Post Excerpts' ) the_excerpt(); else the_content(); ?>

				<?php if (option::get('display_readmore') == 'on' && option::get('display_content') == 'Post Excerpts') { ?><a class="more-link" href="<?php the_permalink() ?>"><span><?php _e('Read more', 'wpzoom'); ?> &#8250;</span></a><?php } ?>

			</div>

		</div> <!-- /.post -->

	<?php endwhile;

	get_template_part('pagination');

endif; ?>