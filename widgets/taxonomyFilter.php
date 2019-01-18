
<?php
/**
 * Adds Foo_Widget widget.
 */
class TaxonomyFilter extends WP_Widget
{
  public $name         = 'Taxonomy Filter';
  public $text_domain  = 'taxonomy_filter_text_domain';
  public $description  = 'Filter taxonomie entries from post results';
  public $title        = 'Taxonomy Filter';
  public $base_id      = 'taxonomy_filter_id';
  public $checkbox     = true;
  public $taxonomy     = 'tag';
  public $terms         = array();
  /*********************************************************************************//**
  * Register widget with WordPress.
  ************************************************************************************/
  function __construct()
  {
  	parent::__construct(
  		$this->base_id, // Base ID
  		esc_html__( $this->title, $this->text_domain), // Name
  		array( 'description' => esc_html__( $this->description, $this->text_domain), ) // Args
  	);

    add_action( 'pre_get_posts', array( $this, 'taxonomy_filter_callback' ));
  }


  /*********************************************************************************//**
  * Front-end display of widget.
  *
  * @see WP_Widget::widget()
  *
  * @param array $args     Widget arguments.
  * @param array $instance Saved values from database.
  ************************************************************************************/
  public function widget( $args, $instance )
  {
  	echo $args['before_widget'];
  	if ( ! empty( $instance['title'] ) )
    {
  		echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
  	}


    // print_r($instance);
    // print_r($args);
    // foreach($terms as $object)
    // {
    //   echo $instance[$object->name];
    //
    //   echo '<input class="sidebar_checkbox" id="'.$object->name.'" type="checkbox" name="'.$object->name.'">';
    //   echo '<lable for="'.$object->name.'">'.$object->name.'</lable>';
    //   echo '<br>';
    // }

    echo "Taxonomy = ".$taxonomy;
    echo '<br>';
    foreach(get_terms($taxonomy) as $tempterm)
    {
      echo '<input class="sidebar_checkbox" id="'.$tempterm->name.'" type="checkbox" name="'.$tempterm->name.'" checked>';
      echo '<lable for="'.$tempterm->name.'">'.$tempterm->name.'</lable>';
      echo '<br>';
    }
  	echo $args['after_widget'];
  }


	/*********************************************************************************//**
	* Back-end widget form.
	*
	* @see WP_Widget::form()
	*
	* @param array $instance Previously saved values from database.
	************************************************************************************/
	public function form( $instance )
  {

    //Sanitize title
		$instance['title'] = ! empty( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';

    //Create title text field
    echo '<p><label for="' . $title_id .'">' . __( 'Title:' ) . '</label>
			<input type="text" class="widefat" id="' . $title_id .'" name="' . $this->get_field_name( 'title' ) .'" value="' . $instance['title'] .'" />
		</p>';


    $taxonomies = get_taxonomies( array( 'show_tagcloud' => true ), 'object' );
    switch (count($taxonomies))
    {

  		// No tag cloud supporting taxonomies found, display error message
  		case 0:
        $id = $this->get_field_id( 'taxonomy' );
        $name = $this->get_field_name( 'taxonomy' );
        $input = '<input type="hidden" id="' . $id . '" name="' . $name . '" value="%s" />';
        echo '<p>' . __( 'The tag cloud will not be displayed since there are no taxonomies that support the tag cloud widget.' ) . '</p>';
  			printf( $input, '' );
  			break;


  		// Display texonomy as select tag
  		default:
  			printf(
  				'<p><label for="%1$s">%2$s</label>' .
  				'<select class="widefat" id="%1$s" name="%3$s">',
  				$id,
  				__( 'Taxonomy:' ),
  				$name
  			);

  			foreach ( $taxonomies as $taxonomy => $tax ) {
  				printf(
  					'<option value="%s"%s>%s</option>',
  					esc_attr( $taxonomy ),
  					selected( $taxonomy, $current_taxonomy, false ),
  					$tax->labels->name
  				);
  			}

  			echo '</select></p>';

        //Create checkbox to display as select statement
        $aw_tax_display_checkbox_id = $this->get_field_id("aw_tax_display_checkbox");
        $aw_tax_display_checkbox_name = $this->get_field_name("aw_tax_display_checkbox");
        echo '<input name="'.$name.'" class="checkbox" type="checkbox" id="'.$aw_tax_display_checkbox_id.'"></input>';
        echo '<lable for="'.$aw_tax_display_checkbox_id.'">Display as dropdown list </lable>';


        //Create show tag count checkbox
        $count = isset( $instance['count'] ) ? (bool) $instance['count'] : false;

    		$count_checkbox = sprintf(
    			'<p><input type="checkbox" class="checkbox" id="%1$s" name="%2$s"%3$s /> <label for="%1$s">%4$s</label></p>',
    			$this->get_field_id( 'count' ),
    			$this->get_field_name( 'count' ),
    			checked( $count, true, false ),
    			__( 'Show tag counts' )
    		);

        //Display tag count checkbox
        echo $count_checkbox;
		}

	}


	/*********************************************************************************//**
	* Sanitize widget form values as they are saved.
	*
	* @see WP_Widget::update()
	*
	* @param array $new_instance Values just sent to be saved.
	* @param array $old_instance Previously saved values from database.
	*
	* @return array Updated safe values to be saved.
	************************************************************************************/
	public function update( $new_instance, $old_instance )
  {
		$instance = $new_instance;
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';

		return $instance;
	}


  /**
	 * Retrieves the taxonomy for the current Tag cloud widget instance.
	 *
	 * @since 4.4.0
	 * @access public
	 *
	 * @param array $instance Current settings.
	 * @return string Name of the current taxonomy if set, otherwise 'post_tag'.
	 */
	public function _get_current_taxonomy($instance)
  {
		if ( !empty($instance['taxonomy']) && taxonomy_exists($instance['taxonomy']) )
			return $instance['taxonomy'];

		return 'post_tag';
	}
  // public function get_checked_terms()
  // {
  //   $terms = get_terms($taxonomy);
  //   foreach($terms as $object)
  //   {
  //     if(isset($_post[esc_attr($this->get_field_name( $object->name ))])):
  //       echo 'checked';
  //     else:
  //       echo 'not checked';
  //     endif;
  //   }
  // }

  function taxonomy_filter_callback($query)
  {
    if($query->is_main_query())
      $query->set( $this->taxonomy, $this->terms );
  }
} // class Foo_Widget


// register Foo_Widget widget
function aw_register_Taxonomy_Filter()
{
    register_widget( 'TaxonomyFilter' );
}
add_action( 'widgets_init', 'aw_register_Taxonomy_Filter' );
