<?php
/**
 * Adds Foo_Widget widget.
 */
class People extends WP_Widget
{
  public $name         = 'People';
  public $text_domain  = 'peopel_text_domain';
  public $description  = 'People widget';
  public $title        = 'people';
  public $base_id      = 'people_id';
  public $checkbox     = true;

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
  	//echo esc_html__( 'Hello, People!', 'text_domain' );
    $terms = get_terms('People');
    print_r($instance);
    print_r($args);
    foreach($terms as $object)
    {
      echo $instance[$object->name];

      echo '<input class="sidebar_checkbox" id="'.$object->name.'" type="checkbox" name="'.$object->name.'">';
      echo '<lable for="'.$object->name.'">'.$object->name.'</lable>';
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
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'New title', $this->text_domain );
		?>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', $this->text_domain ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php
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

  public function get_checked_terms()
  {
    $terms = get_terms('People');
    foreach($terms as $object)
    {
      if(isset($_post[esc_attr($this->get_field_name( $object->name ))])):
        echo 'checked';
      else:
        echo 'not checked';
      endif;
    }
  }
} // class Foo_Widget


// register Foo_Widget widget
function register_foo_widget()
{
    register_widget( 'People' );
}
add_action( 'widgets_init', 'register_foo_widget' );
// add_filter( 'posts_where' , 'posts_where' );
//
// function posts_where( $where )
// {
//   // $checked = array();
//   //
//   // $terms = get_terms('People');
//   // foreach($terms as $object)
//   // {
//   //   if(is_checked($object->name))
//   //   {
//   //     echo 'checked';
//   //   }
//   // }
//   //
//   // $where .= " AND wp_posts.ID = '4864'";
//   // echo $where;
//   if(!is_admin() )
//   {
//     global $wpdb;
//     //$where .= " AND wp_posts.ID = '4864'";
//   }
// //}
// 	return $where;
// }

function is_checked($name)
{
  echo 'test = '.$_POST[$name];

    if(isset($_POST[$name]))
    {
      return true;
    }

    return false;
}
