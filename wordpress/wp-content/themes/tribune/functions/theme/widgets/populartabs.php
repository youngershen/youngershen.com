<?php

/*------------------------------------------*/
/* WPZOOM: Popular Tabs Widget              */
/*------------------------------------------*/

class Wpzoom_Popular_Tabs extends WP_Widget {

	function Wpzoom_Popular_Tabs() {

		/* Widget settings. */
		$widget_ops = array( 'classname' => 'popular-tabs', 'description' => 'Popular posts tab widget' );

		/* Widget control settings. */
		$control_ops = array( 'id_base' => 'wpzoom-popular-tabs' );

		/* Create the widget. */
		$this->WP_Widget( 'wpzoom-popular-tabs', 'WPZOOM: Popular Tabs', $widget_ops, $control_ops );

	}

	function widget( $args, $instance ) {

		extract( $args );

		/* User-selected settings. */
		$commented = $instance['commented'];
		$viewed = $instance['viewed'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		?><div class="tabs-out">
			<ul class="tabs">
				<li><a href="#"><?php echo "$commented";?></a></li>
				<li><a href="#"><?php echo "$viewed";?></a></li>
			</ul>
			<div class="panes">

				<div><!-- first pane -->
					<ol>
						<?php wpzoom_popular_posts(); ?>
					</ol>
				</div>

				<div><!-- second pane -->
					<?php $loop = new WP_Query( array( 'caller_get_posts' => true, 'showposts' => 5,  'meta_key' => 'Views', 'orderby' => 'meta_value_num', 'order' => 'DESC' ) ); ?>

					<ol>
						<?php if ( $loop->have_posts() ) : ?>
						<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
						<li><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a> <span><?php printf( get_post_meta( get_the_ID(), 'Views', true ) );  ?> views</span></li>
						<?php endwhile; ?>
					</ol>

					<?php endif; ?>
				</div>

			</div>
		</div><?php

		/* After widget (defined by themes). */
		echo $after_widget;

	}

	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		/* Strip tags (if needed) and update the widget settings. */
		$instance['commented'] = $new_instance['commented'];
		$instance['viewed'] = $new_instance['viewed'];

		return $instance;

	}

	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'commented' => 'Most Commented', 'viewed' => 'Most Viewed' );
		$instance = wp_parse_args( (array) $instance, $defaults );

		?><p>
			<label for="<?php echo $this->get_field_id( 'commented' ); ?>"><?php _e('Title for Most Commented tab:', 'wpzoom'); ?></label><br />
			<input id="<?php echo $this->get_field_id( 'commented' ); ?>" name="<?php echo $this->get_field_name( 'commented' ); ?>" value="<?php echo $instance['commented']; ?>" type="text" class="widefat" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'viewed' ); ?>"><?php _e('Title for Most Viewed tab:', 'wpzoom'); ?></label><br />
			<input id="<?php echo $this->get_field_id( 'viewed' ); ?>" name="<?php echo $this->get_field_name( 'viewed' ); ?>" value="<?php echo $instance['viewed']; ?>" type="text" class="widefat" />
		</p><?php

	}

}

function wpzoom_popular_posts ($timeline = null) {

		// Extract widget options
		$options = get_option('Wpzoom_popular_posts');
		$title = $options['title'];
		$maxposts = $options['maxposts'];
		if (!$timeline) {
				$timeline = $options['sincewhen'];
		}


		// Since we're passing a SQL statement, globalise the $wpdb var
		global $wpdb;
		$sql = "SELECT ID, post_title, comment_count FROM $wpdb->posts WHERE post_status = 'publish' AND post_type = 'post' ";

		// What's the chosen timeline?
		switch ($timeline) {
				case "thisday":
						$sql .= "AND DAY(post_date) = DAY(NOW()) AND WEEK(post_date) = WEEK(NOW()) AND MONTH(post_date) = MONTH(NOW()) AND YEAR(post_date) = YEAR(NOW()) ";
						break;
				case "thisweek":
						$sql .= "AND WEEK(post_date) = WEEK(NOW()) AND MONTH(post_date) = MONTH(NOW()) AND YEAR(post_date) = YEAR(NOW())";
						break;
				case "thismonth":
						$sql .= "AND MONTH(post_date) = MONTH(NOW()) AND YEAR(post_date) = YEAR(NOW()) ";
						break;
				case "thisyear":
						$sql .= "AND YEAR(post_date) = YEAR(NOW()) ";
						break;
	default:
			break;

		}

		// Make sure only integers are entered
		if (!ctype_digit($maxposts)) {
				$maxposts = 5;
		} else {
				// Reformat the submitted text value into an integer
				$maxposts = $maxposts + 0;
				// Only accept sane values
				if ($maxposts <= 0 or $maxposts > 5) {
						$maxposts = 5;
				}
		}

		// Complete the SQL statement
		$sql .= "AND comment_count > 0 ORDER BY comment_count DESC LIMIT ". $maxposts;

		$res = $wpdb->get_results($sql);

		if($res) {
				$mcpcounter = 1;
				foreach ($res as $r) {

						echo "<li><a href='".get_permalink($r->ID)."' rel='bookmark'>".htmlspecialchars($r->post_title, ENT_QUOTES)."</a> <span>".htmlspecialchars($r->comment_count, ENT_QUOTES)." " .__('comments', 'wpzoom'). "</span></li>\n";
						 $mcpcounter++;
				}
		} else {
				echo "<li>". __('No commented posts yet', 'wpzoom') . "</li>\n";
		}

}

add_action('widgets_init', create_function('','register_widget("Wpzoom_Popular_Tabs");'));