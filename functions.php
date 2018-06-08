<?php

    require('includes/Amazing Walls Menu/amazing walls menu.php');
   	require('widgets/Resolution.php');
   	require('includes/helpers.php');
    require('includes/AWPlugins/AWPlugins.php');

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
		wp_enqueue_style('tablet-style', get_template_directory_uri().'/css/tablet.css', array(), '1.0.0', 'all and (max-width: 600px)');
    wp_enqueue_style('phone-style', get_template_directory_uri().'/css/phone.css', array(), '1.0.0', 'all and (max-width: 300px)');
		wp_enqueue_script('customjs', get_template_directory_uri().'/js/amazing.js', array(), '1.0.0', true);

		$style = get_option('aw_style');

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
   		add_theme_support( 'post-thumbnail' );
   		set_post_thumbnail_size( 300, 169, true );
   		/*add_image_size("post-thumbnail", 300, 169, true);*/

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
  $post = get_post($id);
  if($post->has_post_thumbnail):
    return get_the_post_thumbnail_url($id);
  else:
	   return get_template_directory_uri()."/assets/images/default-featured-image.jpg";
  endif;
}

function the_lock_post_image_url()
{
	return get_template_directory_uri()."/assets/images/default-password-protected-image.jpg";
}
@ini_set('upload_max_size', '64M');
@ini_set('post_max_size', '256M');
@ini_set('max_execution_time', '400');

      ?>
