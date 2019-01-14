<?php

    require_once('Admin/Admin.php');
    require_once('widgets/widgets.php');
   	require_once('includes/helpers.php');
    require_once('includes/AWPlugins/AWPlugins.php');
    require('includes/config.php');
    add_theme_support( 'post-thumbnails' );


    function aw_post_serchform_filter_options()
    {
      if(empty(get_option('aw_default_post_types')))
      {
        update_option('aw_default_post_types', array('post', 'photo', 'photoalbum', 'mobile', 'video'));
      }
    }
    add_action('after_setup_theme', 'aw_post_serchform_filter_options');


    function aw_serchform_filter($query)
    {
      //if ( $query->is_main_query )
      {
        if ($query->is_search)
        {
          $post_type = $_GET['aw_post_search_filter'];

          if($post_type == 'All' || empty($post_type))
            return $query;

          $query->is_search = false;
          $query->set('post_type', $post_type);
        }
      }

      return $query;
    }

    add_action('pre_get_posts','aw_serchform_filter');

    function show_taxonomy($taxonomy, $lable)
    {
    	$terms = get_the_terms(get_the_ID(), $taxonomy);

      if(!empty($terms)):
      	echo '<ul class="Tag" style="inline-block; text-align:left">';
      	echo '<li class="TagLable">'.$lable.'</li>';
      	foreach($terms as $term)
      	{
      		$link = get_term_link($term, $taxonomy);
      		echo '<li class="Button ButtonColor Tag"><a href="'.$link.'">'.$term->name.'</a></li>';
      	}

      	echo '</ul>';
      endif;
    }

    function add_login_logout_register_menu( $items, $args )
    {
     if ( $args->theme_location != 'header-menu' )
      return $items;

     if ( is_user_logged_in() )
     {
       $items .= '<li Class="Button ButtonColor"><a href="' . wp_logout_url() . '">' . __( 'Log Out' ) . '</a></li>';
     }
     else
     {
       $items .= '<li Class="Button ButtonColor"><a href="' . wp_login_url() . '">' . __( 'Login In' ) . '</a></li>';
       $items .= '<li Class="Button ButtonColor"><a href="' . wp_registration_url() . '">' . __( 'Sign Up' ) . '</a></li>';
     }

     return $items;
    }

    add_filter( 'wp_nav_menu_items', 'add_login_logout_register_menu', 199, 2 );

    // 3. Make Courses posts show up in archive pages
    add_filter( 'pre_get_posts', 'wpshout_add_custom_post_types_to_query' );
    function aw_add_custom_post_types_to_query( $query )
    {
    	if(is_search() || is_category() || is_tag() && $query->is_main_query() && empty( $query->query_vars['suppress_filters'] ))
      {
    		$query->set( 'post_type', array(
    			'post',
    			'photo',
          'photoalbum',
          'video',
          'mobile'
    		) );
    	}
    }

   add_filter( 'widget_meta_poweredby', '__return_empty_string' );

   // // Deactivate default MediaElement.js styles by WordPress
   // function remove_mediaelement_styles() {
   //
   //         wp_dequeue_style('wp-mediaelement');
   //         wp_deregister_style('wp-mediaelement');
   // }
   // add_action( 'wp_print_styles', 'remove_mediaelement_styles' );

	add_filter( 'pre_get_posts', 'tgm_io_cpt_search' );
	/**
	 * This function modifies the main WordPress query to include an array of
	 * post types instead of the default 'post' post type.
	 *
	 * @param object $query  The original query.
	 * @return object $query The amended query.
	 */
	function tgm_io_cpt_search( $query )
	{

		if ( $query->is_search ) {
		$query->set( 'post_type', array( 'post', 'photo', 'photoalbum', 'video', 'mobile' ) );
		}

		return $query;

	}

   function get_featured_image_url($size)
   {
   	$thumb_id = get_post_thumbnail_id();
   	$thumb_url_array = wp_get_attachment_image_src($thumb_id, $size, true);
   	return $thumb_url_array[0];
   }
   function print_featured_image()
   {
   	$featured_image_full = get_featured_image_url('full');
   	echo "<a href=\"$featured_image_full\"><img src=\"$featured_image_full\" class=\"attachment_page_image\"></a>";
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
if ( ! function_exists( 'amazing_walls_setup' ) )
{
	function amazing_walls_setup()
   	{

   		//adds featuered image support
      set_post_thumbnail_size( 300, 169, get_option('aw_pt_crop') );

   		//add support for coment rss feed
   		add_theme_support( 'automatic-feed-links' );

   		add_theme_support( 'custom-background' );

   		/*add menu support*/
   		register_nav_menus( array(
       		'main-menu'   => __( 'main-menu', $aw_text_domain),
          'header-menu'   => __( 'header-menu', $aw_text_domain),
       		'footer-menu' => __( 'footer-menu', $aw_text_domain )
   		) );
   	}
   	add_action('after_setup_theme', 'amazing_walls_setup');
}


/******************************************************************************************************************
*	Add support for site logo
******************************************************************************************************************/
if ( ! function_exists( 'aw_logo_setup' ) )
{
	function aw_logo_setup()
	{

		add_theme_support( 'custom-logo',
		 array(
			'height'      => 100,
			'width'       => 400,
			'flex-width' => true,
		) );
	}
	add_action( 'after_setup_theme', 'aw_logo_setup' );
}


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
               		'name'          => __( 'Primary Sidebar', $aw_text_domain),
               		'description'   => __( 'A short description of the sidebar.', $aw_text_domain),
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

function the_featured_image_url($id)
{

  //Set the default featured image
  $featured_image_url = get_template_directory_uri()."/assets/images/default-featured-image.jpg";

  $image_size = 'post-thumbnail';

  if(get_post_type() == 'mobile' ):
    $image_size = 'mobile-thumb';
  endif;

  if(is_search() || is_tax() || is_singular() || is_tag()):
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

function test_customizer_callback($wp_customize)
{
  $wp_customize->add_setting('header_bg_color', array(
    'default'   => '#4285f4',
    'transport' => 'refresh'
  ));

  $wp_customize->add_section('ju_color_theme_section', array(
    'title' => __('color', $aw_text_domain),
    'priority' => 30
  ));

  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'theme_colors', array(
    'label' => __('Header Color', $aw_text_domain),
    'section' => 'ju_color_theme_section',
    'settings'   => 'header_bg_color',
  )));
}
add_action('customize_register', 'test_customizer_callback');

function aw_createZipFile($filename)
{
	if(extension_loaded('zip'))
	{
		$server_root = get_site_url();
		$tempZip = new ZipArchive();
		if($tempZip->open($filename, ZipArchive::CREATE|ZipArchive::OVERWRITE) == True)
		{
			foreach(aw_get_images() as $image)
			{
					//$image = substr($image, strlen($server_root));
					//$image = $_SERVER['DOCUMENT_ROOT'].$image;
					$tempZip->addFile($image, basename(($image)));
				}
			}

			$tempZip->close();
	}
}

function aw_download_enabled()
{
  return get_option('aw_ct_download');
}

function aw_get_images()
{
  $images =& get_children( array (
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
* @brief  Use 'nav_menu_css_class' filter to add css class to
*         the main menu.
***************************************************************************/
function aw_add_main_menu_class( $classes, $item, $args )
{
    // Only affect the menu placed in the 'secondary' wp_nav_bar() theme location
    if ( 'main-menu' === $args->theme_location || $args->theme_location === 'footer-menu')
    {
        // Make these items 3-columns wide in Bootstrap
        $classes[] = 'Button ButtonColor';
    }

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

    //When downloading an album we need to create a zip file
    if(get_post_type() == 'photoalbum' && is_single()):
      $permissions = 0744;
      $downloads_folder = ABSPATH."Downloads/";

      $title = sanitize_title(get_the_title(get_the_ID()));
      $file = (($title)? $title: get_the_ID()).".zip";
      $server_path = $downloads_folder.$file;
      $url = get_site_url()."/Downloads/".$file;

      mkdir($downloads_folder);
      chmod($downloads_folder, $permissions);
      aw_createZipFile($server_path);
      chmod($server_path, $permissions);

    //When downloading a non album type we just need to download the file itself.
    else:
      $custom_fields = get_post_custom_values('Photo');
      if($custom_fields):
        $url = wp_get_attachment_url($custom_fields[0]);
      endif;
    endif;
    echo '<a class="Button ButtonColor" href="'.$url.'" download>Download</a>';
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
add_filter('the_title', aw_post_title_filter);


/***********************************************************************//**
* @Brief  This function adds a section of posts associated with a custom
*         field.
* @param $args An array of values to customize post section
***************************************************************************/
function aw_posts_section($args)
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
        get_template_part('/Templates/Parts/post');
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
