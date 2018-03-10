<?php
/******************************************************************************************************************
*	Create custom post video
******************************************************************************************************************/
if ( ! function_exists( 'amazing_walls_custom_posttype_photo' ) )
{
	function aw_custom_posttype_video()
	{
    	//Custom type labels
		$labels = array(
		'name' => __('Video'),
		'singular_name' => __('Video'),
		'add_new' => __('Add New Video'),
		'add_new_item' => __('Add New Video'),
		'edit_item' => __('Edit Video'),
		'new_item' => __('New Video'),
		'all_items' => __('All Video'),
		'view_item' => __('View Videos'),
		'search_items' => __('Search Videos'),
		'not_found' => __('No Videos Found'),
		'not_found_in_trash' => __('No videos found in trash'),
		'parent_item_colon' => '',
		'menu_name' => __('Video'),

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
   	add_action( 'init', 'aw_custom_posttype_video' );
}







?>
