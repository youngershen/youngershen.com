<?php

/*------------------------------------------*/
/* WPZOOM: Featured Category widget			*/
/*------------------------------------------*/


$wpzoomColors = array();
$wpzoomColors['blue'] = 'Blue';
$wpzoomColors['red'] = 'Red';
$wpzoomColors['black'] = 'Black';


class wpzoom_widget_category extends WP_Widget {

	/* Widget setup. */
	function wpzoom_widget_category() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'wpzoom', 'description' => __('Featured Category Widget for Homepage', 'wpzoom') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'wpzoom-widget-cat' );

		/* Create the widget. */
		$this->WP_Widget( 'wpzoom-widget-cat', __('WPZOOM: Featured Category', 'wpzoom'), $widget_ops, $control_ops );
	}

	/* How to display the widget on the screen. */
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title1 = apply_filters('widget_title', $instance['title1'] );
 		$color1 = $instance['color1'];
 		$posts1 = $instance['posts1'];
 		$category1 = get_category($instance['category1']);
		if ($category1) {
		$categoryLink1 = get_category_link($category1);
    }

		/* Before widget (defined by themes). */
		//echo $before_widget;

  		$z = 0;
		while ($z < 1)
		{
		  $z++;

		  $color = "color$z";
		  $categoryLink = "categoryLink$z";
		  $title = "title$z";
		  $posts = "posts$z";
		  $category = $instance["category$z"];
?>
	    <?php

            echo '<div class="homecat '.$$color.'">';

            if ( $$title ) {	echo '<h4><a href="'.$$categoryLink.'">'.$$title.'</a></h4>'; } ?>

        	<ul>

			<?php
            $second_query = new WP_Query( array( 'cat' => $category, 'showposts' => $$posts, 'orderby' => 'date', 'order' => 'DESC' ) );

              $i = 0;
              if ( $second_query->have_posts() ) : while( $second_query->have_posts() ) : $second_query->the_post();
			  unset($image,$cropLocation);
              $i++;
              global $post;

           	?>
            <li>

				<div class="thumb">

					<?php

					$permalink = get_permalink();
					$comments = get_comments_number();
					$comment_write = '<span class="meta">'.get_the_date().'<strong>'.$comments.'</strong></span>';

					get_the_image( array( 'size' => 'featured-cat', 'width' => 200, 'height' => 125, 'before' => '<a href="'.$permalink.'">', 'after' => $comment_write.'</a>', 'link_to_post' => false ) ); ?>

				</div>

					<h3><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>

					<p><?php the_content_limit(95); ?></p>

 			</li>


 			<?php endwhile; ?>
 			<?php endif; ?>

		</ul>


 		<ul class="stories">

			<?php
			$slidepost = new WP_Query( array( 'cat' => $category, 'showposts' => 3, 'offset' => $$posts, 'orderby' => 'date', 'order' => 'DESC' ) );

			while ( $slidepost->have_posts() ) {
				$slidepost->the_post();
				?><li><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></li><?php
			}
			?>

		</ul>


		<?php echo '<a href="'.$$categoryLink.'" class="nextActions">'; _e('More in this category &rarr;', 'wpzoom'); echo '</a>'; ?>


		</div>

<?php

    } // while
    echo ' <!-- end .featCategory -->';
		/* After widget (defined by themes). */
		//echo $after_widget;
		wp_reset_query();
	}

	/* Update the widget settings.*/
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title1'] = strip_tags( $new_instance['title1'] );
 		$instance['category1'] = $new_instance['category1'];
		$instance['color1'] = $new_instance['color1'];
		$instance['posts1'] = $new_instance['posts1'];

		return $instance;
	}

	/** Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function when creating your form elements. This handles the confusing stuff. */
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title1' => __('Category Name', 'wpzoom'), 'category1' => '0', 'color1' => 'blue', 'posts1' => '3' );
		$instance = wp_parse_args( (array) $instance, $defaults );
		global $wpzoomColors;
    ?>

 		<p>
			<label for="<?php echo $this->get_field_id( 'title1' ); ?>"><?php _e('Category Title:', 'wpzoom'); ?></label>
			<input  type="text" class="widefat" id="<?php echo $this->get_field_id( 'title1' ); ?>" name="<?php echo $this->get_field_name( 'title1' ); ?>" value="<?php echo $instance['title1']; ?>"   />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('color1'); ?>"><?php _e('Title Background Color:', 'wpzoom'); ?></label>
			<select id="<?php echo $this->get_field_id('color1'); ?>" name="<?php echo $this->get_field_name('color1'); ?>" style="width:90%;">
			<?php
				foreach ($wpzoomColors as $key => $value) {
				$option = '<option value="'.$key;
				if ($key == $instance['color1']) { $option .='" selected="selected';}
				$option .= '">';
				$option .= $value;
				$option .= '</option>';
				echo $option;
				}
			?>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('category1'); ?>"><?php _e('Category:', 'wpzoom'); ?></label>
			<select id="<?php echo $this->get_field_id('category1'); ?>" name="<?php echo $this->get_field_name('category1'); ?>" style="width:90%;">
				<option value="0">Choose category:</option>
				<?php
				$cats = get_categories('hide_empty=0');

				foreach ($cats as $cat) {
				$option = '<option value="'.$cat->term_id;
				if ($cat->term_id == $instance['category1']) { $option .='" selected="selected';}
				$option .= '">';
				$option .= $cat->cat_name;
				$option .= ' ('.$cat->category_count.')';
				$option .= '</option>';
				echo $option;
				}
			?>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('posts1'); ?>"><?php _e('Posts to show:', 'wpzoom'); ?></label>
			<select id="<?php echo $this->get_field_id('posts1'); ?>" name="<?php echo $this->get_field_name('posts1'); ?>" style="width:90%;">
			<?php
				$m = 0;
				while ($m < 11) {
				$m++;
				$option = '<option value="'.$m;
				if ($m == $instance['posts1']) { $option .='" selected="selected';}
				$option .= '">';
				$option .= $m;
				$option .= '</option>';
				echo $option;
				}
			?>
			</select>
		</p>

	<?php
	}
}

function wpzoom_register_category_widget() {
	register_widget('wpzoom_widget_category');
}
add_action('widgets_init', 'wpzoom_register_category_widget');
?>