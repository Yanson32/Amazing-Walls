<?php
	require_once(get_template_directory().'/includes/config.php');

/******************************************************************************************************************
*	Create custom post video
******************************************************************************************************************/
if ( ! function_exists( 'amazing_walls_custom_posttype_photo' ) )
{
	function aw_custom_posttype_video()
	{
    	//Custom type labels
		$labels = array(
		'name' => __('Video', $aw_text_domain),
		'singular_name' => __('Video', $aw_text_domain),
		'add_new' => __('Add New Video', $aw_text_domain),
		'add_new_item' => __('Add New Video', $aw_text_domain),
		'edit_item' => __('Edit Video', $aw_text_domain),
		'new_item' => __('New Video', $aw_text_domain),
		'all_items' => __('All Video', $aw_text_domain),
		'view_item' => __('View Videos', $aw_text_domain),
		'search_items' => __('Search Videos', $aw_text_domain),
		'not_found' => __('No Videos Found', $aw_text_domain),
		'not_found_in_trash' => __('No videos found in trash', $aw_text_domain),
		'parent_item_colon' => '',
		'menu_name' => __('Video', $aw_text_domain),

		);

		//supported
		$supports = array(
		'title',
		'editor',
		'excerpt',
		'author',
		'thumbnail',
		'comments',
		'revisions',
		'custom-fields',
		'tag',
		);

		$args = array(
		'labels' => $labels,
		'public' => true,
		'has_archive' => true,
		'rewrite' => array('slug' => 'video'),
		'supports' => $supports,
		'taxonomies' => array('post_tag', 'category'),
		'show_in_menu' => true,
		'menu_position' => 5,
		'show_in_nav_menus' => true,

		);


       		register_post_type( 'Video', $args);

   	}

    if(get_option('create_video_type'))
   	  add_action( 'init', 'aw_custom_posttype_video' );
}

add_image_size( 'aw_video_post_thumbnail', 169, 300);
