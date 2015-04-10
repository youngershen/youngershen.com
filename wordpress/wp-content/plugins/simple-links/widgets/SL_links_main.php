<?php

/**
 * Creates the main widget for the simple links plugin
 *
 * @author mat lipe
 * @uses   registerd by init
 * @uses   the output can be filtered by using the 'simple_links_widget_output' filter
 *         *   apply_filters( 'simple_links_widget_output', $output, $args );
 *         the $args can be filtered by using the 'simple_links_widget_args' filter
 *         *   apply_filters( 'simple_links_widget_args', $args );
 *         the Widget Settings Can be filtered using the 'simple_links_widget_settings' filter
 *         *   apply_filters( 'simple_links_widget_settings', $instance );
 *         the Links object directly after get_posts()
 *         *   apply_filters('simple_links_widget_links_object', $links, $instance, $args );
 *         the links meta data one link at a time
 *         *   apply_filters('simple_links_link_meta', get_post_meta($link->ID, false), $link, $instance, $args );
 *         ** All Filters can be specified for a particular widget by ID
 *         * e.g.   add_filter( 'simple_links_widget_settings_simple-links-3')
 *
 *
 *
 */
class SL_links_main extends WP_Widget {


	/**
	 * Defaults
	 *
	 * Default instance args
	 *
	 * @var array
	 *
	 */
	public $defaults = array(
		'title'                       => '',
		'orderby'                     => 'menu_order',
		'order'                       => 'ASC',
		'numberposts'                 => - 1,
		'description'                 => 0,
		'show_description_formatting' => 0,
		'remove_line_break'           => 0,
		'show_image'                  => 0,
		'show_image_only'             => 0,
		'image_size'                  => 'thumbnail',
		'separator'                   => '',
		'category'                    => array(),
		'include_child_categories'    => 0

	);


	/**
	 * Setup the Widget
	 *
	 * @since 8/27/12
	 */
	function __construct(){
		$widget_ops = array(
			'classname'   => 'sl-links-main',
			'description' => __( 'Displays a list of your Simple Links with options.', 'simple-links' )
		);


		$control_ops = array(
			'id_base' => 'simple-links',
			'width'   => 305,
			'height'  => 350,

		);

		$this->WP_Widget( 'simple-links', 'Simple Links', $widget_ops, $control_ops );

	}


	/**
	 * Secret Method when outputing 2 columns and want them ordered alphabetical
	 *
	 * @since 1.7.0
	 *
	 * @uses  add to the filter like so add_filter('simple_links_widget_links_object', array( 'SL_links_main', 'twoColumns'), 1, 4 );
	 * @uses  currently just hanging out for future use
	 *
	 * @TODO  integrate this into core options
	 *
	 */
	public static function twoColumns( $links_object, $args ){
		$per_row = floor( count( $links_object ) / 2 );
		$count   = 0;
		foreach( $links_object as $key => $l ){
			$count ++;
			if( $count > $per_row ){
				$second[ ] = $l;

			} else {
				$first[ ] = $l;

			}
		}
		foreach( $first as $k => $l ){
			$new[ ] = $l;
			if( isset( $second[ $k ] ) ){
				$new[ ] = $second[ $k ];
			}
		}

		return $new;

	}

	/**
	 * Form
	 *
	 * Outputs the Widget form on the /wp-admin/widgets.php Page
	 *
	 * @see WP_Widget::form()
	 *
	 */
	function form( $instance ){
		global $simple_links;

		$instance = $this->migrateOldData( $instance );

		$instance = wp_parse_args( $instance, $this->defaults );

		?>
		<input type="hidden" name="<?php echo $this->get_field_name( 'simple_links_version' ); ?>" value="<?php echo SIMPLE_LINKS_VERSION; ?>"/>

		<em><?php _e( 'Be sure the see the Help Section in the Top Right Corner of the Screen for Questions!', 'simple-links' ); ?></em>
		<br>
		<br>

		<strong><?php _e( 'Links Title', 'simple-links' ); ?>:</strong>
		<input class="simple-links-title widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php

		echo esc_attr( $instance[ 'title' ] ); ?>" class="widefat"/>

		<br>
		<br>

		<strong><?php _e( 'Order Links By', 'simple-links' ); ?></strong>
		<select id="<?php echo $this->get_field_id( 'orderby' ); ?>" name="<?php echo $this->get_field_name( 'orderby' ); ?>">
			<?php
			simple_links::orderby_options( $instance[ 'orderby' ] );
			?>
		</select>

		<br>
		<br>
		<strong><?php _e( 'Order', 'simple-links' ); ?>:</strong>
		<select id="<?php echo $this->get_field_id( 'order' ); ?>" name="<?php echo $this->get_field_name( 'order' ); ?>">
			<option value="ASC" <?php selected( $instance[ 'order' ], 'ASC' ); ?>><?php _e( 'Ascending', 'simple-links' ); ?></option>
			<option value="DESC" <?php selected( $instance[ 'order' ], 'DESC' ); ?>><?php _e( 'Descending', 'simple-links' ); ?></option>
		</select>

		<br>
		<fieldset>
		<p>
			<strong><?php _e( 'Categories (optional)', 'simple-links' ); ?>:</strong>
			<?php
			$cats = Simple_Links_Categories::get_category_names();
			if( !empty( $cats ) ){
				?>
				<ul class="sl-categories">
					<?php

					$term_args = array(
						'walker'        => new Simple_Links_Category_Checklist( $this->get_field_name( 'category' ), $instance[ 'category' ] ),
						'taxonomy'      => Simple_Links_Categories::TAXONOMY,
						'checked_ontop' => false

					);
					wp_terms_checklist( 0, $term_args );
					?>
				</ul>
			<?php
			} else {
				_e( 'No link categories have been created yet.', 'simple-links' );
			}
			?>
		</p>
		<p>
			<strong><?php _e( 'Include Child Categories Of Selected Categories', 'simple-links' ); ?></strong>
			<input type="checkbox" id="<?php echo $this->get_field_id( 'include_child_categories' ); ?>" name="<?php echo $this->get_field_name( 'include_child_categories' ); ?>" <?php checked( $instance[ 'include_child_categories' ] ); ?> value="1"/>
		</p>

		<hr>

		<strong><?php _e( 'Number of Links', 'simple-links' ); ?>:</strong>
		<select id="<?php echo $this->get_field_id( 'numberposts' ); ?>" name="<?php echo $this->get_field_name( 'numberposts' ); ?>">
			<option value="-1">All</option>
			<?php
			for( $i = 1; $i < 50; $i ++ ){
				printf( '<option value="%s" %s>%s</option>', $i, selected( $instance[ 'numberposts' ], $i ), $i );
			}
			?>
		</select>

		<br>
		<br>
		<strong><?php _e( 'Show Description', 'simple-links' ); ?></strong>
		<input type="checkbox" id="<?php echo $this->get_field_id( 'description' ); ?>" name="<?php echo $this->get_field_name( 'description' ); ?>"
			<?php
			checked( $instance[ 'description' ] ); ?> value="1"/>


		<br>

		<p>

			<strong><?php _e( 'Include Description Paragraph Format', 'simple-links' ); ?></strong>
			<input type="checkbox" id="<?php echo $this->get_field_id( 'show_description_formatting' ); ?>" name="<?php echo $this->get_field_name( 'show_description_formatting' ); ?>"
				<?php
				checked( $instance[ 'show_description_formatting' ] ); ?> value="1"/>


		</p>

		<hr>

		<p>

			<strong><?php _e( 'Show Image', 'simple-links' ); ?></strong>
			<input type="checkbox" id="<?php echo $this->get_field_id( 'show_image' ); ?>" name="<?php echo $this->get_field_name( 'show_image' ); ?>"
				<?php
				checked( $instance[ 'show_image' ] ); ?> value="1"/>


		</p>

		<p>

			<strong><?php _e( 'Remove Line Break Between Image and Link', 'simple-links' ); ?></strong>
			<input type="checkbox" id="<?php echo $this->get_field_id( 'remove_line_break' ); ?>" name="<?php echo $this->get_field_name( 'remove_line_break' ); ?>"
				<?php
				checked( $instance[ 'remove_line_break' ] ); ?> value="1"/>


		</p>

		<strong><?php _e( 'Display Image Without Title', 'simple-links' ); ?></strong>
		<input type="checkbox" id="<?php echo $this->get_field_id( 'show_image_only' ); ?>" name="<?php echo $this->get_field_name( 'show_image_only' ); ?>"
			<?php
			checked( $instance[ 'show_image_only' ] ); ?> value="1"/>
		<br>
		<p>
			<strong><?php _e( 'Image Size', 'simple-links' ); ?>:</strong>
			<select id="<?php echo $this->get_field_id( 'image_size' ); ?>" name="<?php echo $this->get_field_name( 'image_size' ); ?>">
				<?php
				foreach( $simple_links->image_sizes() as $size ){
					printf( '<option value="%s" %s>%s</option>', $size, selected( $instance[ 'image_size' ], $size ), $size );
				}
				?>
			</select>

		</p>

		<hr>

		<br>
		<strong>
			<?php _e( 'Include Additional Fields', 'simple-links' ); ?>:
		</strong>
		<br>
		<?php
		$fields = $simple_links->getAdditionalFields();
		if( empty( $fields ) ){
			echo '<em>' . __( 'There have been no additional fields added', 'simple-links' ) . '</em>';

		} else {
			foreach( $fields as $field ){
				if( ! isset( $instance[ 'fields' ][ $field ] ) ){
					$instance[ 'fields' ][ $field ] = 0;
				}

				printf( '&nbsp; &nbsp; <input type="checkbox" style="margin: 3px 0" value="%s" name="%s[%s]" %s/> %s <br>', $field, $this->get_field_name( 'fields' ), $field, checked( $instance[ 'fields' ][ $field ], $field, false ), $field );
			}

		}
		?>

		<br>
		<br>
		<strong><?php _e( 'Field Separator', 'simple-links' ); ?>:</strong>
		<br>
		<em><?php _e( 'HTML is allowed', 'simple-links' ); ?>: - e.g. '&lt;br&gt;'</em>
		<br>
		<input type="text" id="<?php echo $this->get_field_id( 'separator' ); ?>" name="<?php echo $this->get_field_name( 'separator' ); ?>" value="<?php

		echo esc_attr( $instance[ 'separator' ] ); ?>" class="widefat"/>

		<?php

		do_action( 'simple_links_widget_form', $instance, $this );


	}

	/**
	 * Updates the instance of each widget separately
	 *
	 * @uses  to make sure the data is valid
	 * @see   WP_Widget::update()
	 * @since 9.21.13
	 */
	function update( $new_instance, $old_instance ){
		$new_instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );

		$new_instance = apply_filters( 'simple_links_widget_update', $new_instance, $this );

		return $new_instance;

	}

	/**
	 * Widget
	 *
	 * The output of the widget to the site
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args
	 * @param array $instance
	 *
	 * @see See Class Docs for filtering the output,settings,and args
	 *
	 * @see Notice error removed with help from WebEndev
	 * @see nofollow error was remove with help from Heiko Manfrass
	 *
	 */
	function widget( $args, $instance ){

		do_action( 'simple_links_widget_pre_render', $args, $instance );

		extract( $args );

		//Filter for Changing the widget args
		$args = apply_filters( 'simple_links_widget_args', $args );
		$args = apply_filters( 'simple_links_widget_args_' . $widget_id, $args );


		//Call this filter to change the Widgets Settings Pre Compile
		$instance = apply_filters( 'simple_links_widget_settings', $instance );
		$instance = apply_filters( 'simple_links_widget_settings_' . $widget_id, $instance );


		//--------------- Starts the Output --------------------------------------

		$output = $before_widget;
		//Add the title
		if( ! empty( $instance[ 'title' ] ) ){
			$output .= $before_title . $instance[ 'title' ] . $after_title;
		}

		$links = new SimpleLinksFactory( $instance, 'widget' );

		$output .= $links->output();

		//Close the Widget
		$output .= $after_widget;

		//The output can be filtered here
		$output = apply_filters( 'simple_links_widget_output_' . $widget_id, $output, $links->links, $instance, $args );
		echo apply_filters( 'simple_links_widget_output', $output, $links->links, $instance, $args );
	}


	/**
	 * Allows for migration widgets args from an old version of data to a new one
	 *
	 * @uses run and pre widget
	 *
	 * @since 2.7.5
	 */
	function migrateOldData( $instance ){

		if( !empty( $instance[ 'category' ] ) ){
			foreach( $instance[ 'category' ] as $k => $cat ){
				if( !is_numeric( $cat ) ){
					$cat = get_term_by( "name", $cat, Simple_Links_Categories::TAXONOMY );
					if( !empty( $cat->term_id ) ){
						$instance[ 'category' ][ $k ] = $cat->term_id;
					}
				} else {
					break;
				}
			}
		}

		return $instance;
	}

}