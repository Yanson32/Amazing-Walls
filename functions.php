<?php

    //require_once('Admin/Admin.php');
    require_once('widgets/widgets.php');
   	require_once('includes/helpers.php');
    require_once('includes/AWPlugins/AWPlugins.php');
    require('includes/config.php');
	
	function aw_get_cat_id($arr)
	{

		$cat_array = array();

		foreach($arr as $var)
		{   
            $term = get_term_by('name', $var, 'category');

            if($term)
			    $cat_array[] = $term->term_id;
						
		}
        

		return $cat_array;
	}
	
	function aw_to_tax($arr, $tax)
	{
		$tax_array = array();
			
		foreach( $arr as $value ) 
		{
			$tax_array[$tax] = sanitize_text_field($value);
		}
		return $tax_array;	
	}
	

    /***********************************************************************************//**
    *   @brief  This method inserts a post into the database baised on information
    *           provided in the upload form page template.
    **************************************************************************************/
	function aw_insert_post()
	{
		if(current_user_can('publish_posts'))
		{	
			//Parse people taxonomy
			$tax_array = aw_to_tax($_POST['people_upload'], 'People');
			

			//Get an array of category id's
			$cat_id = aw_get_cat_id(explode(',', $_POST['category_upload']));

			//Create post
			$post_arr = array(	'post_title' => sanitize_text_field($_POST['upload_title']), 
			'post_type' => sanitize_text_field( $_POST['upload_post_type']),
			'post_status' => sanitize_text_field( $_POST['aw_upload_visibility']),
			'tags_input' => sanitize_text_field($_POST['upload_tags']),
			'tax_input' => $tax_array,
			'post_category' => $cat_id);
								
			$return_val = wp_insert_post($post_arr);
            
            return $return_val;
		}
		
		return WP_Error('Error' , 'Unable to create post');
	}
	 
	function aw_create_photo_album() 
	{
		if ( $_FILES ) 
		{ 
            $count = 0;
			$post_id = aw_insert_post();

			$files = $_FILES["aw_photo_upload"];
            $featured_image;

            if(isset($_FILES['aw_featured_image_upload']))
            {
                $featured_image = aw_handle_attachment('aw_featured_image_upload', $post_id);
            }


			foreach ($files['name'] as $key => $value) 
			{ 			
					if ($files['name'][$key]) 
					{ 
						$file_array = array( 
							'name' => $files['name'][$key],
							'type' => $files['type'][$key], 
							'tmp_name' => $files['tmp_name'][$key], 
							'error' => $files['error'][$key],
							'size' => $files['size'][$key]
						); 

                        //The wordpress function media_upload_file cannot handle multi file uploads
                        //So we have to set $_FILES to a single file.
						$_FILES = array ("aw_photo_upload" => $file_array); 
						foreach ($_FILES as $file => $array) 
						{	

                                $attachment_id = aw_handle_attachment($file,$post_id, true); 		                    

							    if ( !is_wp_error( $attachment_id )) 
							    {
								    if($count == 0)
								    {
									    //Set featured image. 
									    set_post_thumbnail($post_id, $attachment_id);
									    
									    $count += 1;
								    }

								    
								    //Add custom field entry
								    add_post_meta($post_id, 'Photo', $attachment_id);
							    
								    //Set alt text 
								    update_post_meta($attachment_id, '_wp_attachment_image_alt', $_POST['alt_text_upload']);
							    } 
							
                            }
							
						}
					} 

                    if($featured_image)
                    {
                        set_post_thumbnail($post_id, $featured_image);
                    }
				} 
			
	}


	function aw_create_photo_mobile(string $type) 
	{
		if ( $_FILES ) 
		{ 
			$files = $_FILES["aw_photo_upload"];  
			foreach ($files['name'] as $key => $value) 
			{ 			
					if ($files['name'][$key]) 
					{ 
						$file = array( 
							'name' => $files['name'][$key],
							'type' => $files['type'][$key], 
							'tmp_name' => $files['tmp_name'][$key], 
							'error' => $files['error'][$key],
							'size' => $files['size'][$key]
						); 

                        //The wordpress function media_upload_file cannot handle multi file uploads
                        //So we have to set $_FILES to a single file.
						$_FILES = array ("aw_photo_upload" => $file); 
						foreach ($_FILES as $file => $array) 
						{	
							$post_id = aw_insert_post();
							$attachment_id = aw_handle_attachment($file,$post_id, true); 
							if ( !is_wp_error( $attachment_id ) ) 
							{
								//Set featured image. 
								set_post_thumbnail($post_id, $attachment_id);
								
								//Set alt text 
								update_post_meta($attachment_id, '_wp_attachment_image_alt', $_POST['alt_text_upload']);
								
								//Add custom field entry
								add_post_meta($post_id, $type, $attachment_id);

                                #Get width and height of the thumbnail
                                $image = wp_get_attachment_image_src($attachment_id, 'full');
                                $width = $image[1];
                                $height = $image[2];


                               //Set the resolution of the post thumbnail. We erase any previous entries resolution entries
                                wp_set_object_terms( $post_id, $width.'x'.$height, 'Resolution', false);

                                $cd = array_reduce(array($width, $height), 'gcd');
                                $width /= $cd;
                                $height /= $cd;

			                    //Set the AspectRatio of the post thumbnail. We erase any previous AspectRatio entries
                                wp_set_object_terms( $post_id, $width.'x'.$height, 'AspectRatio', false);
							}
							
						}
					} 
				} 
			}
	}

    function aw_create_video()
    {
		if ( $_FILES ) 
		{ 

			$post_id = aw_insert_post();
            $featured_image;

            if(isset($_FILES['aw_featured_image_upload']))
            {
                $featured_image = aw_handle_attachment('aw_featured_image_upload', $post_id);
            }

            $file = array( 
                'name' => $_FILES['aw_photo_upload']['name'][0],
				'type' => $_FILES['aw_photo_upload']['type'][0], 
				'tmp_name' => $_FILES['aw_photo_upload']['tmp_name'][0], 
			    'error' => $_FILES['aw_photo_upload']['error'][0],
				'size' => $_FILES['aw_photo_upload']['size'][0]
			); 
            $_FILES = array ("aw_photo_upload" => $file); 

			$attachment_id = aw_handle_attachment('aw_photo_upload',$post_id, true); 
			if ( !is_wp_error( $attachment_id ) ) 
			{
				//Set featured image. 
				set_post_thumbnail($post_id, $attachment_id);
								
				//Set alt text 
				update_post_meta($attachment_id, '_wp_attachment_image_alt', $_POST['alt_text_upload']);
								
				//Add custom field entry
				add_post_meta($post_id, 'Video', $attachment_id);
			}

            if($featured_image)
            {
                set_post_thumbnail($post_id, $featured_image);
            }
							
	    }
					
    }

	function aw_handle_attachment($file_handler,$post_id,$set_thu=true) 
	{
		// Check that the nonce is valid, and the user can edit this post.
		if ( 	isset( $_POST['aw_image_upload_nonce'] ) 
				&& wp_verify_nonce( $_POST['aw_image_upload_nonce'], 'aw_image_upload' )
				&& current_user_can( 'edit_post', $post_id )) 
		{
			
			// check to make sure its a successful upload
			if ($_FILES[$file_handler]['error'] !== UPLOAD_ERR_OK) 
				__return_false();

			require_once(ABSPATH . "wp-admin" . '/includes/image.php');
			require_once(ABSPATH . "wp-admin" . '/includes/file.php');
			require_once(ABSPATH . "wp-admin" . '/includes/media.php');

			return media_handle_upload( $file_handler, $post_id );

		}
	}
    function aw_post_serchform_filter_options()
    {
      if(empty(get_option('aw_default_post_types')))
      {
        update_option('aw_default_post_types', array('post', 'photo', 'photoalbum', 'mobile', 'video'));
      }
    }
    add_action('after_setup_theme', 'aw_post_serchform_filter_options');


    /********************************************************************************************//**
    * @brief  Add selected post types to search query
    ************************************************************************************************/
    function aw_serchform_filter($query)
    {
      //Make sure filters are not being suppressed
      if ( empty( $query->query_vars['suppress_filters'] ))
      {

        //Make sure this is a search query and the aw_post_search_filter option is set
        if ($query->is_search && isset($_GET['aw_post_search_filter']))
        {
          $post_type = $_GET['aw_post_search_filter'];

          //Exit if the ALL option is selected
          if(strtoupper($post_type) == 'ALL')
            return $query;

          //Otherwise set post_type query variable
          $query->set('post_type', $post_type);
        }
      }

      return $query;
    }
    add_filter('pre_get_posts', 'aw_serchform_filter');
    // function aw_serchform_filter( $query )
    // {
    //    if ( $query->is_search ):
    //            $post_type = $_GET['aw_post_search_filter'];
    //            if(strtoupper($post_type) == 'ALL')
    //              return $query;
    //       $query->set( 'post_type', $post_type  );
    //    endif;
    //
    //    return $query;
    // }
    // add_filter( 'pre_get_posts', 'aw_serchform_filter' );


    /********************************************************************************************//**
    * @brief  Display taxonomy in wordpress template page
    ************************************************************************************************/
    function aw_show_taxonomy($args)
    {
      $taxonomy = $args['tax'];
      $lable = $args['lable'];
    	$terms = get_the_terms(get_the_ID(), $taxonomy);
      if(!empty($terms) && taxonomy_exists($taxonomy)):
        echo '<div>';
          echo '<div class="tax_lable">';
            echo $lable;
          echo '</div>';
          echo '<div class="tax_list">';
            echo '<ul class="Tag">';
            foreach($terms as $term)
            {
              $link = get_term_link($term, $taxonomy);
              echo '<li class="Button ButtonColor Tag"><a href="'.$link.'">'.$term->name.'</a></li>';
            }

            echo '</ul>';
          echo '</div>';
        echo '</div>';
      endif;
    }


    /*************************************************************************************//**
    * @brief Add custom post types to tag and category results
    *****************************************************************************************/
    function aw_add_custom_types_to_tax( $query )
    {
      if( is_category() || is_tag() && empty( $query->query_vars['suppress_filters'] ) )
      {
        // Get all your post types
        $post_types = get_post_types();

        $query->set( 'post_type', $post_types );
        return $query;
      }
    }
    add_filter( 'pre_get_posts', 'aw_add_custom_types_to_tax' );



   function get_featured_image_url($size)
   {
   	$thumb_id = get_post_thumbnail_id();
   	$thumb_url_array = wp_get_attachment_image_src($thumb_id, $size, true);
   	return $thumb_url_array[0];
   }



/******************************************************************************************************************
*	Enqueue scripts
******************************************************************************************************************/
if ( ! function_exists( 'amazing_walls_enqued' ) )
{
	function amazing_walls_enqued()
   	{
		wp_enqueue_style('desktop-style', get_template_directory_uri().'/css/style.css', array(), '1.0.0', 'all');
		wp_enqueue_style('format-style', get_template_directory_uri().'/css/format.css', array(), '1.0.0', 'all');
		wp_enqueue_style('tablet-style', get_template_directory_uri().'/css/tablet.css', array(), '1.0.0', 'all and (max-width: 640px)');
    wp_enqueue_style('phone-style', get_template_directory_uri().'/css/phone.css', array(), '1.0.0', 'all and (max-width: 320px)');
		wp_enqueue_script('customjs', get_template_directory_uri().'/js/amazing.js', array(), '1.0.0', true);
wp_enqueue_script('jquery');

		$style = get_option('aw_theme');

		if($style === 'Light')
			wp_enqueue_style('colorstyle', get_template_directory_uri().'/css/light.css', array(), '1.0.0', 'all');
		else if($style === 'Dark')
			wp_enqueue_style('colorstyle', get_template_directory_uri().'/css/dark.css', array(), '1.0.0', 'all');

   	}

	add_action('wp_enqueue_scripts', 'amazing_walls_enqued');
}


/******************************************************************************************************************
*	Basic theme setup
******************************************************************************************************************/
if ( ! function_exists( 'aw_setup' ) )
{
  function aw_setup()
  {

      //adds featuered image support
      set_post_thumbnail_size( 300, 169, get_option('aw_pt_crop') );

      //add featured image support
      add_theme_support( 'post-thumbnails' );

      add_image_size('aw_thumbnail', 150, 150, true);
      add_image_size( 'photo-thumbnail', 300, 169, true);
      add_image_size( 'mobile-thumbnail', 169, 300, true);
      add_image_size( 'photoalbum-thumbnail', 300, 169, true);
      add_image_size( 'video-thumbnail', 169, 300, true);

   		//add support for coment rss feed
   		add_theme_support( 'automatic-feed-links' );

   		add_theme_support( 'custom-background' );

      add_theme_support( 'custom-logo',
       array(
        'height'      => 100,
        'width'       => 400,
        'flex-width' => true,
      ) );

   		/*add menu support*/
   		register_nav_menus( array(
       		'main-menu'   => __( 'main-menu', 'Amazing_Walls_Domain'),
       		'footer-menu' => __( 'footer-menu', 'Amazing_Walls_Domain' ),
          'header-menu' => __( 'header-menu', 'Amazing_Walls_Domain' )
   		) );
   	}
   	add_action('after_setup_theme', 'aw_setup');
}


/******************************************************************************************************************
* @brief  Custom image size filter
******************************************************************************************************************/
function aw_custom_sizes( $sizes )
{
    return array_merge( $sizes, array(
      'photo-thumbnail' => __( 'Photo Thumbnail' ),
      'photoalbum-thumbnail' => __( 'Album Thumbnail' ),
      'mobile-thumbnail' => __( 'Mobile Thumbnail' ),
      'video-thumbnail' => __( 'Video Thumbnail' ),
    ) );
}
add_filter( 'image_size_names_choose', 'aw_custom_sizes' );


/******************************************************************************************************************
*	Register sidebars
******************************************************************************************************************/
if ( ! function_exists( 'aw_register_sidebars' ) )
{
	function aw_register_sidebars()
	{
		/* Register the 'primary' sidebar. */
		register_sidebar(
			array(
               		'id'            => 'primary',
               		'name'          => __( 'Primary Sidebar', 'Amazing_Walls_Domain'),
               		'description'   => __( 'A short description of the sidebar.', 'Amazing_Walls_Domain'),
               		'before_widget' => '<div id="%1$s" class="widget %2$s">',
               		'after_widget'  => '</div>',
               		'before_title'  => '<h3 class="widget-title">',
               		'after_title'   => '</h3>',
           	));
   	}

   	add_action( 'widgets_init', 'aw_register_sidebars' );
}

/******************************************************************************************************************
*	Customizer options
******************************************************************************************************************/
function mytheme_customize_register( $wp_customize ) {
   //All our sections, settings, and controls will be added here
$wp_customize->add_setting( 'header_textcolor' , array(
    'default'   => 'white',
    'transport' => 'refresh',
) );
}
add_action( 'customize_register', 'mytheme_customize_register' );

/*****************************************************************************//**
* @Brief  Get the featured image url.
* @param  $width of the featured image .
* @param  $height of the featured image.
*********************************************************************************/
function aw_the_featured_image_url($id, $width, $height)
{

  //Set the default featured image
  $featured_image_url = get_template_directory_uri()."/assets/images/default-featured-image.jpg";

  $image_size = 'post-thumbnail';

  if(get_post_type() == 'mobile' ):
    $image_size = 'mobile-thumb';
  endif;

  if(get_post_type() == 'video' ):
    $image_size = 'video-thumb';
  endif;

  if(is_search() || is_tax() || is_singular() || is_tag() || is_category()):
    $image_size = 'thumbnail';
  endif;

  //If has a thumbnail
  if(has_post_thumbnail($id)):
    $featured_image_url = get_the_post_thumbnail_url($id, $image_size);
  endif;

  //If post is Locked
  if(post_password_required()):
    $featured_image_url = get_template_directory_uri()."/assets/images/default-password-protected-image.jpg";
  endif;

  return $featured_image_url;
}


/*****************************************************************************//**
* @Brief Create a zip file of images
*********************************************************************************/
function aw_createZipFile($filename)
{

	if(extension_loaded('zip'))
	{

        //Create file if it does not already exist
        if(!file_exists($filename))
        {
		    $server_root = get_site_url();
		    $tempZip = new ZipArchive;
		    if($tempZip->open($filename, ZipArchive::CREATE) === True)
		    {
			    foreach(aw_get_images() as $image)
			    {
                        echo "Has Images";
					    $tempZip->addFile($image, basename(($image)));
			    }
                $tempZip->close();
		    }
		    
        }
	}
}

/*****************************************************************************//**
* @Brief  Determine if the download button is enabled.
* @return true when the download button is enabled.
*********************************************************************************/
function aw_download_enabled()
{
  return get_option('aw_ct_download');
}


/*****************************************************************************//**
* @Brief  Get all attached images.
* @return array of attached images.
*********************************************************************************/
function aw_get_images()
{
  $images = get_children( array (
    'post_parent' => get_the_ID(),
    'post_type' => 'attachment',
    'post_mime_type' => 'image'
  ));

  $array = [];
  if ( !empty($images) )
  {
    foreach ( $images as $attachment_id => $attachment )
    {
      $url = wp_get_attachment_image_src( $attachment_id, 'full' )[0];
      array_push($array, aw_to_path($url));
    }

  }
  return $array;
}


/***********************************************************************//**
* @brief  Convert a url to a full path
***************************************************************************/
function aw_to_path($url)
{
  $server_root = 'http://';
  if(isset($_SERVER['HTTPS']))
    $server_root = 'https://';

  $server_root = $server_root.$_SERVER['HTTP_HOST'];

  $url = substr($url, strlen($server_root));
  $url = $_SERVER['DOCUMENT_ROOT'].$url;

  return $url;
}


/***********************************************************************//**
* @brief  Check the theme's options to see if the queue button should
*         be allowed.
***************************************************************************/
function aw_queue_enabled()
{
  return get_option('aw_ct_queue');
}


/***********************************************************************//**
* @brief  filter to add css class to navigation menus.
***************************************************************************/
function aw_add_main_menu_class( $classes, $item, $args )
{
    $classes[] = 'Button ButtonColor';
    return $classes;
}
add_filter( 'nav_menu_css_class', 'aw_add_main_menu_class', 10, 3 );


/***********************************************************************//**
* @brief  This function creates a button for downloading files and
*         galleries. The button will only be displayed if the option
*         in the themes settings page is checked. When downloading
*         a gallery an appropriate zip file will be created.
* @pre    The download button uses the custom field 'Photo' to
*         determine what should be downloaded. Make sure this value is
*         set in the post.
***************************************************************************/
function aw_the_download_button()
{

  //Only create the download button if the appropriate
  //setting in the theme's settings page is set
  if(aw_download_enabled()):

    $zip_url = '#';

    //When downloading an album we need to create a zip file
    if(get_post_type() == 'photoalbum' && is_single()):
      $title = sanitize_title(get_the_title(get_the_ID()));
      $file = (($title)? $title: get_the_ID()).".zip";
      $permissions = 0744;
      $downloads_folder = ABSPATH."Downloads/";
      if(!file_exists($downloads_folder) && is_dir($downloads_folder))
      {
        mkdir($downloads_folder);
        chmod($downloads_folder, $permissions);
      }
      $zip_server_path = $downloads_folder.$file;
      if(!file_exists($zip_server_path)):
          
          aw_createZipFile($zip_server_path);

          if(file_exists($zip_server_path)):
            chmod($zip_server_path, $permissions);
            $zip_url = get_site_url()."/Downloads/".$file;
          endif;
      else:
        $zip_url = get_site_url()."/Downloads/".$file;
      endif;
    elseif(get_post_type() == 'video' && is_single()):
      $custom_fields = get_post_custom_values('Video');

      
      if($custom_fields):
        $zip_url = wp_get_attachment_url($custom_fields[0]);
        //When downloading a non album type we just need to download the file itself.
      else:
        $custom_fields = get_post_custom_values('Photo');
      endif;

      if($custom_fields)
        $zip_url = wp_get_attachment_url($custom_fields[0]);
    endif;

    if($zip_url != '#')
     echo '<a class="Button ButtonColor" href="'.$zip_url.'" download>Download</a>';
  endif;
}

/***********************************************************************//**
* @brief  Create a Queue button. If the appropriate settings in the
*         theme's admin settings page is set.
***************************************************************************/
function aw_the_queue_button()
{
  if(aw_queue_enabled()):
    echo '<a class="Button ButtonColor" href="">Queue</a>';
  endif;
}


/***********************************************************************//**
* @brief  This hook removes "Private:" from private post titles.
***************************************************************************/
function aw_post_title_filter($title)
{
  return str_replace("Private:","",$title);
}
add_filter('the_title', 'aw_post_title_filter');


/***********************************************************************//**
* @Brief  This function adds a section of posts associated with a custom
*         field.
* @param $args An array of values to customize post section
***************************************************************************/
function aw_posts_section($args = array('title' <= 'none', 'custom_field' <= 'Releated'))
{
  $title = (!empty($args['title']))? $args['title']: 'Related';


  $custom_field = (!empty($args['custom_field']))? $args['custom_field']: 'Related';

  //Get  the custom field "Related"
	$custom_fields = get_post_custom_values($custom_field);

  //If there are no custom fields for the Related custom field we exit the function.
  if(empty($custom_fields)):
    return;
  endif;

  echo '<h2>'.$title.'</h2>';
  echo '<div class="clearfix">';
    $query = new WP_Query( array('post_type' => 'any', 'post__in' => $custom_fields));
    if ( $query->have_posts() ) :
      while ( $query->have_posts() ) :
        $query->the_post();
        //get_template_part('/Templates/Parts/post');
        $permalink = get_permalink();
        echo '<div id="'.$title.'" class="thumbnail related_posts">';
        if(has_post_thumbnail()):
        echo '<a href="'.$permalink.'" >';
          the_post_thumbnail("aw_thumbnail");
        echo '</a>';
        else:
          $image = get_bloginfo('template_directory').'/assets/images/default image thumbnail.png';
          echo '<a href="'.$permalink.'" >';
            echo '<img src="'.$image.'">';
          echo '</a>';
        endif;
        echo '</div>';
      endwhile;
    endif;
  echo '</div>';
}


/******************************************************************//**
* @Brief  Create an admin panel to display additional content
*         when the admin views a single post. The capabilities
*         needed to view the admin panel can be changed in the
*         themes admin menu.
**********************************************************************/
function aw_admin_panel()
{
  if(current_user_can(get_option('aw_admin_panel_permissions'))):
    echo '<div id="aw_admin_panel">';
      echo 'Post ID '.get_the_ID();
    echo '</div>';
  endif;
}

/****************************************************//**
* @Brief  get all public post types
********************************************************/
function aw_get_all_custom_post_types()
{

  $args = array(
     'public'   => true,
     '_builtin' => false
  );

  $output = 'names'; // names or objects, note names is the default
  $operator = 'and'; // 'and' or 'or'

  return get_post_types( $args, $output, $operator );
}


/****************************************************//**
* @Brief  This filter adds a login / logout Button
*         to the header navigation menu.
* @param  $menu is the navigation menu being modified.
* @param  $args menu options see wp_nav_menu()
*         documentation for details.
********************************************************/
function aw_add_login_button($menu, $args)
{
  //Add login/out button to header navigation menu
  if($args->theme_location == 'header-menu'):
    $menu .= '<li class="Button ButtonColor">'. wp_loginout($_SERVER['REQUEST_URI'], false) .'</li>';
  endif;

  return $menu;
}

add_filter("wp_nav_menu_items", "aw_add_login_button", 10, 2);
