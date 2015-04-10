<?php get_header(); ?>

 	<div id="main">

		<div id="featured">

			<h3 class="catname"><?php single_cat_title(); ?></h3>

			<?php wp_reset_query(); $m = 0;

				$posts_page = get_option('posts_per_page'); // gets the default posts per page value from Settings > Reading

				global $query_string; // required
				$paged = (get_query_var('paged')) ? get_query_var('paged') : 1; // gets current page number

				if ($paged > 1) {
					query_posts($query_string .'&posts_per_page='.$posts_page.'&paged=' . $paged);
				}

 				if (have_posts()) :

				if ($paged == 1) { ?>

					<?php while (have_posts()) : the_post();  $m++; 

						if ($m == 1) {
						$do_not_duplicate[] = $post->ID; // add the post's ID to an array, later to be excluded

						?>

						<div class="main_feat">

							<?php get_the_image( array( 'size' => 'featured',  'width' => 310, 'before' => '<div class="thumb">', 'after' => '</div>' ) );  ?>

							<h2><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a> </h2>
							<div class="date"><?php echo time_ago(); ?></div>

 							<div class="content">

								<div class="entry">

 									<?php the_excerpt(); ?>

									<div class="meta">
										<a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>" class="nextActions"><?php _e('Read full story', 'wpzoom'); ?> &rarr;</a>
										<span class="comments"><?php comments_popup_link('0', '1', '%'); ?></span><div class="clear"></div>
									</div>

								</div><!-- /.entry -->

							</div><!-- /.content -->
						</div><!-- /.main_feat -->

					<div class="headings">

						<ul>

						<?php } elseif ($m > 1 && $m < 5) { 
						$do_not_duplicate[] = $post->ID; // add the post's ID to an array, later to be excluded
						?>

							<li>

								<h2><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>


								<?php get_the_image( array( 'size' => 'featured-cat', 'width' => 90, 'height' => 70, 'before' => '<div class="post-thumb">', 'after' => '</div>' ) ); ?>

								<?php the_content_limit(115); ?>
								<div class="clear"></div>

								<div class="meta">
									<?php printf('%s, %s', get_the_date(), get_the_time()); ?>
									<span class="comments"><?php comments_popup_link('0', '1', '%'); ?></span>
								</div>

							</li>

							<?php } elseif ($m > 4) { ?>
							
							<?php } ?>

							<?php endwhile; ?>

						</ul>

					</div>

					<?php }  // if is first page of the category archive ?>

 					 
					<?php endif; ?>

 			<div class="clear"></div>

		</div> <!-- /#featured -->
		<div class="clear"></div>

		<div id="posts">

			<?php get_template_part('loop','category'); ?>
		
		</div>


	</div><!-- /#main -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>