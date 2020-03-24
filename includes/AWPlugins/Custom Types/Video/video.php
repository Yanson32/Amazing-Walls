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
		'name' => __('Video', 'Amazing_Walls_Domain'),
		'singular_name' => __('Video', 'Amazing_Walls_Domain'),
		'add_new' => __('Add New Video', 'Amazing_Walls_Domain'),
		'add_new_item' => __('Add New Video', 'Amazing_Walls_Domain'),
		'edit_item' => __('Edit Video', 'Amazing_Walls_Domain'),
		'new_item' => __('New Video', 'Amazing_Walls_Domain'),
		'all_items' => __('All Video', 'Amazing_Walls_Domain'),
		'view_item' => __('View Videos', 'Amazing_Walls_Domain'),
		'search_items' => __('Search Videos', 'Amazing_Walls_Domain'),
		'not_found' => __('No Videos Found', 'Amazing_Walls_Domain'),
		'not_found_in_trash' => __('No videos found in trash', 'Amazing_Walls_Domain'),
		'parent_item_colon' => '',
		'menu_name' => __('Video', 'Amazing_Walls_Domain'),

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
