<?php
	class Resolution extends WP_Widget
	{


		/******************************************************************************************************
		*	Purpose: Constructor
		******************************************************************************************************/
		public function Resolution()
		{
			$args = array(
				'classname' => 'widget_categories',
				'description' => __( 'Search photos by resolution' ),
				'customize_selective_refresh' => true,
			);
			parent::__construct( 'Resolution', __( 'Resolution' ), $args );
		}


		/******************************************************************************************************
		*	Purpose: display the widget on website
		******************************************************************************************************/
		public function widget( $args, $instance )
		{
			extract($args);
			static $first_dropdown = true;

			/* This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
			$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Resolution' ) : $instance['title'], $instance, $this->id_base );


			echo $args['before_widget'];
			if ( $title )
			{
				echo $args['before_title'] . $title . $args['after_title'];
			}



			echo $args['after_widget'];
		}


		/******************************************************************************************************
		*	Purpose: Update the values saved in the widget form.
		******************************************************************************************************/
		public function update( $new_instance, $old_instance )
		{
			$instance = $old_instance;
			$instance['title'] = sanitize_text_field( $new_instance['title'] );
			return $instance;
		}


		/******************************************************************************************************
		*	Purpose: define the widget appearance in admin dashboard
		******************************************************************************************************/
		public function form( $instance )
		{

			//Defaults
			$instance = wp_parse_args( (array) $instance, array( 'title' => '') );
			$title = sanitize_text_field( $instance['title'] );
			?>
			<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></p>
			<?php

		}
	}

	add_action('widgets_init', function(){register_widget('Resolution');});
	// //add_filter('posts_where', 'aw_post_where');
  //   function aw_post_where()
  //   {
	//
  //   }
  //   add_action( 'pre_get_posts', 'aw_post_resolution_filter' );
  //   function aw_post_resolution_filter($query)
  //   {
  //       echo $query->have_posts();
  //   }


?>
