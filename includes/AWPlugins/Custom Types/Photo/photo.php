<?php
	require_once('location_meta_box.php');
  require_once('people_taxonomy.php');
  require_once('resolution_taxonomy.php');


  //only create the post type if the admin allows
  if(get_option('create_photo_type'))
    add_action( 'init', 'aw_custom_posttype_photo' );


  /******************************************************************************************************************
  *	Create custom post photo
  ******************************************************************************************************************/
  function aw_custom_posttype_photo()
  {
  	// $customtypes = get_option('aw_custom_types');
  	// $customtypes[] =
    //Custom type labels
  	$labels = array(
  	'name' => __('Photo'),
  	'singular_name' => __('Photo'),
  	'add_new' => __('Add New Photo'),
  	'add_new_item' => __('Add New Photo'),
  	'edit_item' => __('Edit Photo'),
  	'new_item' => __('New Photo'),
  	'all_items' => __('All Photos'),
  	'view_item' => __('View Photos'),
  	'search_items' => __('Search Photos'),
  	'not_found' => __('No Photos Found'),
  	'not_found_in_trash' => __('No photos found in trash'),
  	'parent_item_colon' => '',
  	'menu_name' => __('Photo'),

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
  	'rewrite' => array('slug' => 'photo'),
  	'supports' => $supports,
  	'taxonomies' => array('post_tag', 'category'),
  	'show_in_menu' => true,
  	'menu_position' => 5,
  	'show_in_nav_menus' => true,
  	'hierarchical' => true,
  	'register_meta_box_cb' => 'aw_photo_meta_box',
  	);

    register_post_type( 'Photo', $args);
  }


  /********************************************************************//**
  *	@brief Add meta boxes for the photo post type
  ************************************************************************/
  function aw_photo_meta_box()
  {
  	add_meta_box('aw_location_meta_box', 'Location', 'aw_location_meta_box_markup', 'photo');
  }
