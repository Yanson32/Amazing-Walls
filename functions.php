<?php

    require_once('Admin/Admin.php');
   	require_once('widgets/Resolution.php');
    require_once('widgets/People.php');
    require_once('widgets/TagFilter.php');
   	require_once('includes/helpers.php');
    require_once('includes/AWPlugins/AWPlugins.php');
    require('includes/config.php');
    add_theme_support( 'post-thumbnails' );

    // 3. Make Courses posts show up in archive pages
    add_filter( 'pre_get_posts', 'wpshout_add_custom_post_types_to_query' );
    function wpshout_add_custom_post_types_to_query( $query ) {
    	if(

        is_search() ||
        is_category() ||
    		is_tag() &&
    		$query->is_main_query() &&
    		empty( $query->query_vars['suppress_filters'] )
    	) {
    		$query->set( 'post_type', array(
    			'post',
    			'photo',
          'photoalbum',
          'video'
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
		$query->set( 'post_type', array( 'post', 'photo', 'photoalbum', 'video' ) );
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
    wp_enqueue_style('phone-style', get_template_directory_uri().'/css/phone.css', array(), '1.0.0', 'all and (max-width: 300px)');
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
       		'main-menu'   => __( 'main-menu', 'amazing_walls'),
       		'footer-menu' => __( 'footer-menu', 'amazing_walls' )
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
               		'name'          => __( 'Primary Sidebar' ),
               		'description'   => __( 'A short description of the sidebar.' ),
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


  //If has a thumbnail
  if(has_post_thumbnail($id)):
    $featured_image_url = get_the_post_thumbnail_url($id);
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
    'title' => __('color', 'udemy'),
    'priority' => 30
  ));

  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'theme_colors', array(
    'label' => __('Header Color', 'udemy'),
    'section' => 'ju_color_theme_section',
    'settings'   => 'header_bg_color',
  )));
}
add_action('customize_register', 'test_customizer_callback');

function aw_createZipFile($filename)
{
	if(extension_loaded('zip'))
	{
		$server_root = 'http://';
		if(isset($_SERVER['HTTPS']))
			$server_root = 'https://';

		$server_root = $server_root.$_SERVER['HTTP_HOST'];
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
  return true;
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

function aw_queue_enabled()
{
  return true;
}

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


function aw_the_download_button()
{
  if(aw_download_enabled()):
    $file = "Download.zip";
    aw_createZipFile($file);
    echo '<a class="Button ButtonColor" href="'.$file.'">Download</a>';
  endif;
}

function aw_the_queue_button()
{
  if(aw_queue_enabled()):
    echo '<a class="Button ButtonColor" href="">Queue</a>';
  endif;
}

@ini_set('upload_max_size', '64M');
@ini_set('post_max_size', '256M');
@ini_set('max_execution_time', '400');

      ?>
