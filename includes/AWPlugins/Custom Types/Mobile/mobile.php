<?php
	require_once(get_template_directory().'/includes/config.php');
	//require_once('location_meta_box.php');
	//require_once('photo_meta_box.php');
  //require_once('resolution_taxonomy.php');


  //only create the post type if the admin allows
  if(get_option('create_mobile_type'))
    add_action( 'init', 'aw_custom_posttype_mobile' );


  /******************************************************************************************************************
  *	Create custom post photo
  ******************************************************************************************************************/
  function aw_custom_posttype_mobile()
  {
  	// $customtypes = get_option('aw_custom_types');
  	// $customtypes[] =
    //Custom type labels
  	$labels = array(
  	'name' => __('Mobile', $aw_text_domain),
  	'singular_name' => __('Mobile', $aw_text_domain),
  	'add_new' => __('Add New Mobile', $aw_text_domain),
  	'add_new_item' => __('Add New Mobile', $aw_text_domain),
  	'edit_item' => __('Edit Mobile', $aw_text_domain),
  	'new_item' => __('New Mobile', $aw_text_domain),
  	'all_items' => __('All Mobile', $aw_text_domain),
  	'view_item' => __('View Mobile', $aw_text_domain),
  	'search_items' => __('Search Mobile', $aw_text_domain),
  	'not_found' => __('No Mobile Found', $aw_text_domain),
  	'not_found_in_trash' => __('No mobile found in trash', $aw_text_domain),
  	'parent_item_colon' => '',
  	'menu_name' => __('Mobile', $aw_text_domain),

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
  	'rewrite' => array('slug' => 'mobile'),
  	'supports' => $supports,
  	'taxonomies' => array('post_tag', 'category'),
  	'show_in_menu' => true,
  	'menu_position' => 5,
  	'show_in_nav_menus' => true,
  	'hierarchical' => true,
  	'register_meta_box_cb' => 'aw_mobile_meta_box',
  	);

    register_post_type( 'Mobile', $args);
  }

  add_image_size( 'mobile-thumb', 169, 300);
  /********************************************************************//**
  *	@brief Add meta boxes for the photo post type
  ************************************************************************/
  function aw_mobile_meta_box()
  {
  	//add_meta_box('aw_location_meta_box', 'Location', 'aw_location_meta_box_markup', 'photo');
		//add_meta_box('aw_photo_meta_box', 'Photo', 'aw_photo_meta_box_markup', 'photo');
  }

	/************************************************************//**
	*	@brief	When a photo is saved we set the custum field 'photo'
	*					to the featured image id.
	***************************************************************/
	function aw_save_mobile()
	{
		//get custom field photo
		$custom_fields = get_post_custom_values('Photo');

		//if custom field photo is empty, post type equals
		//mobile, and a featured image has been set. We set custom
		//field Photo to featured image id
		if(empty($custom_fields) && get_post_type(get_the_ID()) == 'mobile'):
			$thumbnail_id = get_post_thumbnail_id(get_the_ID());

			//Add thumbnail id as post meta photo if there is a thumbnail
			if(!empty($thumbnail_id))
				add_post_meta(get_the_ID(), 'Photo', $thumbnail_id);
		endif;
	}
	add_action( 'save_post', 'aw_save_mobile' );
