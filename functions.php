<?php

    require('includes/Amazing Walls Menu/amazing walls menu.php');
   	require('widgets/Resolution.php');
   	require('includes/helpers.php');
    require('includes/AWPlugins/AWPlugins.php');

	
   add_filter( 'widget_meta_poweredby', '__return_empty_string' );


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

function pw_show_gallery_image_urls( $content ) {

 	global $post;

 	// Only do this on singular items
 	if( ! is_singular() )
 		return $content;

 	// Make sure the post has a gallery in it
 	if( ! has_shortcode( $post->post_content, 'gallery' ) )
 		return $content;

 	// Retrieve all galleries of this post
 	$galleries = get_post_galleries_images( $post );

	$image_list = '<ul>';

	// Loop through all galleries found
	foreach( $galleries as $gallery ) {

		// Loop through each image in each gallery
		foreach( $gallery as $image ) {

			$image_list .= '<li>' . $image . '</li>';

		}

	}

	$image_list .= '</ul>';

	// Append our image list to the content of our post
	$content .= $image_list;

 	return $content;

 }
 add_filter( 'the_content', 'pw_show_gallery_image_urls' );


/******************************************************************************************************************
*	Enqueue scripts
******************************************************************************************************************/
if ( ! function_exists( 'amazing_walls_enqued' ) )
{
	function amazing_walls_enqued()
   	{
		wp_enqueue_style('customstyle', get_template_directory_uri().'/css/style.css', array(), '1.0.0', 'all');
		wp_enqueue_style('customstyle', get_template_directory_uri().'/css/format.css', array(), '1.0.0', 'all');
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
   		add_theme_support( 'post-thumbnails' );
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


   if ( ! function_exists( 'shape_comment' ) ) :
   /**
    * Template for comments and pingbacks.
    *
    * Used as a callback by wp_list_comments() for displaying the comments.
    *
    * @since Shape 1.0
    */
   function shape_comment( $comment, $args, $depth ) {
       $GLOBALS['comment'] = $comment;
       switch ( $comment->comment_type ) :
           case 'pingback' :
           case 'trackback' :
       ?>
<li class="post pingback">
   <p><?php _e( 'Pingback:', 'amazing_walls' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'shape' ), ' ' ); ?></p>
   <?php
      break;
      default :
      ?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
   <article id="comment-<?php comment_ID(); ?>" class="comment">
      <footer>
         <div class="comment-author vcard">
            <?php echo get_avatar( $comment, 40 ); ?>
            <?php printf( __( '%s <span class="says">says:</span>', 'shape' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
         </div>
         <!-- .comment-author .vcard -->
         <?php if ( $comment->comment_approved == '0' ) : ?>
         <em><?php _e( 'Your comment is awaiting moderation.', 'amazing_walls' ); ?></em>
         <br />
         <?php endif; ?>
         <div class="comment-meta commentmetadata">
            <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time pubdate datetime="<?php comment_time( 'c' ); ?>">
            <?php
               /* translators: 1: date, 2: time */
               printf( __( '%1$s at %2$s', 'shape' ), get_comment_date(), get_comment_time() ); ?>
            </time></a>
            <?php edit_comment_link( __( '(Edit)', 'shape' ), ' ' );
               ?>
         </div>
         <!-- .comment-meta .commentmetadata -->
      </footer>
      <div class="comment-content"><?php comment_text(); ?></div>
      <div class="reply">
         <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
      </div>
      <!-- .reply -->
   </article>
   <!-- #comment-## -->
   <?php
      break;
      endswitch;
      }
      endif; // ends check for shape_comment()

      ?>
