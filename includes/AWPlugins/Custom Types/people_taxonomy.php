<?php
  /******************************************************************************************************************
  *	Create custom taxonomy People for post type photo
  ******************************************************************************************************************/
  function amazing_walls_people_init()
  {
    //add new hierarchical taxonomy
    $lables = array(
      'name' => 'People',
   		'singular_name' => 'Person',
   		'search_items' => 'Search People',
   		'all_items' => 'All People',
   		'edit_item' => 'Edit People',
   		'update_item' => 'Update Person',
   		'add_new_item' => 'Add New Person',
   		'new_item_name' => 'New Person',
   		'menu_name' => 'People'
   	);

   	$args = array(
   		'hierarchical' => false,
   		'labels' => $lables,
   		'show_ui' => true,
   		'show_admin_column' => true,
   		'query_var' => true,
   		'rewrite' => array('slug' => 'people'),
			'show_tagcloud' => true,
    );

    $taxonomies[] = array();

    if(get_option('create_photo_type'))
      $taxonomies[] = 'photo';

    if(get_option('create_photo_gallery_type'))
      $taxonomies[] = 'photoalbum';

    if(get_option('create_video_type'))
      $taxonomies[] = 'video';

    $taxonomies[] = 'mobile';
    register_taxonomy('People', $taxonomies, $args);
  }

  add_action( 'init', 'amazing_walls_people_init' );
