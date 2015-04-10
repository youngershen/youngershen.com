<div id="featured">

	<?php
	$featured = new WP_Query( array(
		'showposts' => option::get('featured_art_number'),
		'post__not_in' => get_option('sticky_posts'),
		'meta_key' => 'wpzoom_is_featured',
		'meta_value' => 1
	) );

	if ($featured->post_count > 0) : $i = 0;

	while( $featured->have_posts() ) { $featured->the_post(); global $post; $i++;

	if ($i == 1)
		{ ?>

		<div class="main_feat">

			<?php get_the_image( array( 'size' => 'featured',  'width' => 310, 'before' => '<div class="thumb">', 'after' => '</div>' ) );  ?>

 			<h2><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a> </h2>
			<div class="date"><?php if (option::get('featured_date_format') == 'time ago') { echo time_ago(); } else { printf('%s, %s', get_the_date(), get_the_time()); } ?></div>

 			<div class="content">

 				<div class="entry">

					<?php the_excerpt(); ?>

					<div class="meta">
						<a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>" class="nextActions"><?php _e('Read full story', 'wpzoom'); ?> &rarr;</a>
						<span class="comments"><?php comments_popup_link('0', '1', '%'); ?></span><div class="clear"></div>
					</div>

				</div><!-- /.entry -->

			</div><!-- /.content -->
		</div>

		<div class="headings">

			<ul>

	<?php } else { ?>

				<li>

 					<h2><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>


 				 	<?php get_the_image( array( 'size' => 'featured-small', 'width' => 90, 'height' => 70, 'before' => '<div class="post-thumb">', 'after' => '</div>' ) ); ?>

					<?php the_content_limit(option::get('featured_excerpt')); ?>
					<div class="clear"></div>

					<div class="meta">
						<?php printf('%s, %s', get_the_date(), get_the_time()); ?>
						<span class="comments"><?php comments_popup_link('0', '1', '%'); ?></span>
					</div>

				</li>

				<?php }
				$i ++; } ?>

			</ul>

		</div>
	<?php endif; ?>
	<?php wp_reset_query(); ?>

	<div class="clear"></div>

</div> <!-- /#featured -->
<div class="clear"></div>