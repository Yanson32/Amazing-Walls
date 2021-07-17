<?php

class aw_AdminPanel extends WP_Widget
{
  public $name         = 'AdminPanel';
  public $description  = 'The admin panel provides information for the admin';
  public $title        = 'Admin Panel';
  public $base_id      = 'aw_admin_panel_widget_id';
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

    if(current_user_can( 'manage_options' ) && (is_single() || is_page("upload")))
    {
        echo $args['before_widget'];
        if ( ! empty( $instance['title'] ) )
        {
            echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
        }
        else
        {
            echo $args['before_title'] . apply_filters( 'widget_title', 'Admin Panel' ) . $args['after_title'];
        }

        #get all the photo custom fields   
        $custom_fields_photo = get_post_custom_values('Photo');
          
        #get all the video custom fields   
        $custom_fields_video = get_post_custom_values('Video');
        
        #Get all attachments
        $attachments = get_children( array( 'post_parent' => get_the_ID() ) );
          
        #Get attachemnt count 
        $count = count( $attachments );
        
          

        if(current_user_can(get_option('aw_admin_panel_permissions'))):
          echo '<div class="aw_widget" id="aw_admin_panel">';
          if(is_single())
          {
            echo 'Post ID: '.get_the_ID().'</br>';
            echo 'Photo ID: '.sizeof($custom_fields_photo).'<br>';
            echo 'Video ID: '.sizeof($custom_fields_video).'<br>';
            echo 'Visibility: '.get_post_status().'</br>';
            echo 'Attachments: '.$count.'</br>';
          }   
          
          #Get the php config upload_max_filesize  
          $max_filesize = ini_get('upload_max_filesize');
          
          #Get the php config post_max_size 
          $post_max_size = ini_get('post_max_size');

          #Get the php config memory_limit
          $memory_limit = ini_get('memory_limit');

          #Get the php config max_file_uploads
          $max_file_uploads = ini_get('max_file_uploads');

          #Get the php config file_uploads
          $file_uploads='On'; 
          if(!ini_get('file_uploads'))
            $file_uploads = 'Off';
          if(is_page("upload"))
          {
              echo '<span>Max upload size:'.$max_filesize.'</span></br>';
  	          echo '<span>Post Max Size:'.$post_max_size.'</span></br>';
  	          echo '<span>Memory Limit:'.$memory_limit.'</span></br>';
              echo '<span>Max Uploads:'.$max_file_uploads.'</span></br>';
  	          echo '<span>File Uploads:'.$file_uploads.'</span></br>';
          } 
          echo '</div>';
        endif;
        echo $args['after_widget'];
    }
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
function aw_register_test_admin_panel()
{
    register_widget( 'aw_AdminPanel' );
}
add_action( 'widgets_init', 'aw_register_test_admin_panel' );
