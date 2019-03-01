
<?php

class Login extends WP_Widget
{
  public $name         = 'Login';
  public $description  = 'User login widget';
  public $title        = 'Login';
  public $base_id      = 'login_widget_id';
  public $text_domain = '';
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

    //add_action( 'pre_get_posts', array( $this, 'taxonomy_filter_callback' ));
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

    if (is_user_logged_in()) :
        $permalink = wp_logout_url(get_permalink());
        echo'<a href="'.$permalink.'">Logout</a>';
    else :
        $permalink = wp_login_url(get_permalink());
        $registration = wp_registration_url(get_permalink());
        echo '<a href="'.$permalink.'">Login</a><br>';
        echo '<a href="'.$registration.'">Register</a>';
    endif;

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
}

// register Foo_Widget widget
function aw_register_Login()
{
    register_widget( 'Login' );
}
add_action( 'widgets_init', 'aw_register_Login' );
