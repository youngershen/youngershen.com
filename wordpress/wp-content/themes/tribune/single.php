<?php get_header(); ?>
<?php $template = get_post_meta($post->ID, 'wpzoom_post_template', true); ?>

<?php 
	if ($template == 'side-left') {echo "<div class=\"side-left\">";}
	if ($template == 'full') {echo "<div class=\"full-width\">";} 
?> 

<div id="main">
 
<?php
if (have_posts()) :

	while (have_posts()) :

		the_post();

		?><div class="post">

			<?php if (option::get('post_bread') == 'on') { ?><div class="breadcrumbs"><?php _e('You are here:', 'wpzoom'); ?> <?php wpzoom_breadcrumbs(); ?></div><?php } ?>

			<h1><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>

			<div class="meta">

				<?php
				if (option::get('post_date') == 'on') { ?><span class="date"><?php the_date(); ?> <?php the_time(); ?></span><?php }
				if (option::get('post_comm_count') == 'on') { ?><span class="comments"><?php comments_popup_link(__('0 comments', 'wpzoom'), __('1 comment', 'wpzoom'), __('% comments', 'wpzoom')); ?></span><?php }
				edit_post_link( __('Edit this post', 'wpzoom'), ' ', '');
				if (option::get('post_views') == 'on') { ?><span class="views"><?php _e('Views', 'wpzoom'); ?>: <?php printf( get_post_meta( get_the_ID(), 'Views', true ) );  ?></span><?php }
				?>

			</div>

	 
			<div class="entry"><?php the_content(); ?></div>

			<?php wp_link_pages('before=<div class="nextpage">Pages: &after=</div>'); ?>
			<div class="clear"></div>

			<?php if (option::get('post_tags') == 'on') {  the_tags( __( '<span class="tag-links">Tags: ', 'wpzoom' ), " ", "</span>\n" ); } ?>
 			 
			<div class="clear"></div>

			<?php if ( option::get('post_share') == 'on' ) {

				?><div id="socialicons">

					<ul class="wpzoomSocial">
						<li><a href="http://twitter.com/share" data-url="<?php the_permalink(); ?>" class="twitter-share-button" data-count="horizontal">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script></li>
						<li><iframe src="http://www.facebook.com/plugins/like.php?href=<?php echo urlencode(get_permalink($post->ID)); ?>&amp;layout=button_count&amp;show_faces=false&amp;width=110&amp;action=like&amp;font=arial&amp;colorscheme=light&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:110px; height:21px;" allowTransparency="true"></iframe></li>
						<li><g:plusone size="medium"></g:plusone></li>

					</ul>

				</div><div class="clear"></div><?php

			} ?>

			<?php if (option::get('post_authorbio') == 'on') { ?>		
				<div class="post_author">
					<?php echo get_avatar( get_the_author_meta('ID') , 70 ); ?>
					<span><?php _e('Author:', 'wpzoom'); ?> <?php the_author_posts_link(); ?></span>
					<?php the_author_meta('description'); ?><div class="clear"></div>
				</div>
			<?php } ?>


		</div> <!-- /.post -->

		<?php if (option::get('post_comments') == 'on') { ?>
	 		<div id="comments">
				<?php comments_template(); ?>
			</div> <!-- / #comments -->
		<?php } ?>

		<?php

	endwhile;

endif;

wp_reset_query();
?>
</div> <!-- /#main -->

<?php if ($template != 'full') { 
	get_sidebar(); 
} ?>

<?php 
	if ($template == 'side-left' || $template == 'full') { echo "</div>";} 
?> 

<?php get_footer(); ?>