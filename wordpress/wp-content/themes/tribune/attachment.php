<?php get_header(); ?>
 		
	<div id="main" class="fullwidth">
	
<?php 
  wp_reset_query(); 
  if (have_posts()) : while (have_posts()) : the_post(); ?>

		<div class="post">
			 
 			 
 			 <h1><a href="<?php echo get_permalink( $post->post_parent ); ?>" ><?php echo get_the_title( $post->post_parent ); ?></a></h1> 
			
			 
 			<div class="meta">
 				<?php previous_image_link( false, __('&larr; Previous', 'wpzoom')); ?> | <?php next_image_link( false, __('Next &rarr;', 'wpzoom')); ?>
			</div> 
			
 			<div class="entry">
 				 <?php if ( wp_attachment_is_image() ) : ?>
				
				
				<p class="attachment" style="padding-top:20px; text-align:center; "><a href="<?php echo wp_get_attachment_url(); ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="attachment"><?php
							echo wp_get_attachment_image( $post->ID, $size='fullsize' ); // max $content_width wide or high.
						?></a></p>
						
						<center><strong><a href="<?php echo wp_get_attachment_url(); ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="attachment"> <?php if ( !empty( $post->post_excerpt ) ) the_excerpt(); ?> [<?php _e('View full size', 'wpzoom'); ?>]</a></strong></center>
				
				
				<?php else : ?>
					<a href="<?php echo wp_get_attachment_url(); ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="attachment"><?php echo basename( get_permalink() ); ?></a>
<?php endif; ?>
   			</div>
 			
			 
 			
		</div> <!-- /.post -->
 
	</div> <!-- /#main -->
		
		
   	<?php endwhile; endif; ?>
   	<?php wp_reset_query(); ?>
 
 
<?php get_footer(); ?>