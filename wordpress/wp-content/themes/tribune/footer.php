			<div class="clear"></div>
			
			<?php if ((option::get('bottomside_placement') == 'Homepage only' && is_home()) || option::get('bottomside_placement') == 'On all pages') { get_template_part( 'sidebar-footer' ); } ?>
 
			</div> <!-- /#content -->

		</div> <!-- /#inner-wrap -->

	</div> <!-- /#wrapper -->

	<div id="footer-wrap">

		<div id="footer">

			<div id="left">

				<div class="logo">

 					<?php if (!option::get('misc_footerlogo_path')) { echo "<h1>"; } ?>

						<a href="<?php echo home_url(); ?>" title="<?php bloginfo('description'); ?>">
							<?php if (!option::get('misc_footerlogo_path')) { bloginfo('name'); } else { ?>
								<img src="<?php echo option::get('misc_footerlogo_path'); ?>" alt="<?php bloginfo('name'); ?>" />
							<?php } ?>
						</a><div class="clear"></div>

					<?php if (!option::get('misc_footerlogo_path')) { echo "</h1>"; } ?>

 				</div>

				<?php wp_nav_menu( array('container' => '', 'container_class' => '', 'menu_class' => '', 'sort_column' => 'menu_order', 'theme_location' => 'tertiary', 'depth' => '1' ) ); ?>

			</div>

			<div id="footer_right">

				<?php wp_nav_menu( array( 'sort_column' => 'menu_order', 'container_class' => 'menu-footer', 'theme_location' => 'four', 'depth' => '1' ) ); ?>

				<div id="footer_search">
					<strong><?php _e('search', 'wpzoom'); ?>:</strong>
					<?php get_template_part('searchform'); ?>
				</div>

				<span class="copyright">&copy; <?php _e('Copyright', 'wpzoom') ?> <?php echo date("Y"); ?> &mdash; <a href="<?php echo get_option('home'); ?>/" class="on"><?php bloginfo('name'); ?></a>. <?php _e('All Rights Reserved', 'wpzoom') ?></span>

			</div><!-- /#right -->

		</div> <!-- /#footer -->
		<div class="clear"></div>
	</div> <!-- /#footer_wrap -->

	<?php
	wp_reset_query();

	wp_footer();
	?>

</body>
</html>