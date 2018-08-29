<?php
/***************************************************************//**
* @brief  Create TagFilterWidget.
*******************************************************************/
class TagFilterWidget extends WP_Widget
{
  public $text_domain   = "text";
  public $base_id       = "tag_filter_widget";
  public $title         = "Tag Filter Widget";
  public $description   = "Allow posts to be filtered by tags";

  /***************************************************************//**
	*  @brief  Register widget with WordPress.
	*******************************************************************/
	function __construct()
  {
		parent::__construct(
			$this->base_id, // Base ID
			esc_html__( $this->title, $this->text_domain ), // Name
			array( 'description' => esc_html__( $this->description, $this->text_domain ), ) // Args
    );
	}

	/***************************************************************//**
	*  Front-end display of widget.
	*
	*  @see WP_Widget::widget()
	*
	*  @param array $args     Widget arguments.
	*  @param array $instance Saved values from database.
	*******************************************************************/
	public function widget( $args, $instance )
  {
		echo $args['before_widget'];

    //Title
		if(!empty( $instance['title']))
    {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}

    //Add tag
    echo '<form id="echo esc_attr( $this->get_field_id( "tag-form" ) );" >';
      echo '<label for="tf_tag_input">Input Tag</label>';
      echo '<input style="width:100%" id="tf_tag_input" type="text" name="echo esc_attr( $this->get_field_id( "tf_tag" ) );">';
      echo '<input style="width:100%" type="submit" value="+">';
    echo '</form>';

		echo $args['after_widget'];
	}

	/***************************************************************//**
	* Back-end widget form.
	*
	* @see WP_Widget::form()
	*
	* @param array $instance Previously saved values from database.
	*******************************************************************/
	public function form( $instance )
  {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'Tag Filter', 'text_domain' );
		?>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'text_domain' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php
	}

	/***************************************************************//**
	* Sanitize widget form values as they are saved.
	*
	* @see WP_Widget::update()
	*
	* @param array $new_instance Values just sent to be saved.
	* @param array $old_instance Previously saved values from database.
	*
	* @return array Updated safe values to be saved.
	*******************************************************************/
	public function update( $new_instance, $old_instance )
  {
		$instance = $old_instance;
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';

		return $instance;
	}

}

// register Foo_Widget widget
function register_tag_filter_widget()
{
    register_widget( 'TagFilterWidget' );
}
add_action( 'widgets_init', 'register_tag_filter_widget' );
