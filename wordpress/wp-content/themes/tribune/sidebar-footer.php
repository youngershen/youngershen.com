 <?php if ( is_active_sidebar( 'footer_1'  ) ||  is_active_sidebar( 'footer_2'  )  ||  is_active_sidebar( 'footer_3'  ) ) : ?>
	<div id="bottomside">
<?php endif; ?>

	<?php if ( is_active_sidebar( 'footer_1'  ) ) : ?>
		<div class="column">
			<?php if (function_exists('dynamic_sidebar')) { dynamic_sidebar('Footer (column 1)'); } ?>
		</div><!-- / .column -->
		<?php endif; ?>

	<?php if ( is_active_sidebar( 'footer_2'  ) ) : ?>
			<div class="column">
			<?php if (function_exists('dynamic_sidebar')) { dynamic_sidebar('Footer (column 2)'); } ?>
		</div><!-- / .column -->
	<?php endif; ?>

	<?php if ( is_active_sidebar( 'footer_3'  ) ) : ?>		
		<div class="column last">
			<?php if (function_exists('dynamic_sidebar')) { dynamic_sidebar('Footer (column 3)'); } ?>
		</div><!-- / .column -->
	<?php endif; ?>

<?php if ( is_active_sidebar( 'footer_1'  ) ||  is_active_sidebar( 'footer_2'  )  ||  is_active_sidebar( 'footer_3'  ) ) : ?>
	<div class="clear"></div>
	</div><!-- /#bottomside -->		
	<div class="clear"></div>
<?php endif; ?>