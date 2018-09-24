<?php
/******************************************************************************************************************
*	Create custom post photo
******************************************************************************************************************/
if ( ! function_exists( 'amazing_walls_custom_posttype_photo' ) )
{
	function aw_custom_posttype_photo()
	{
		$customtypes = get_option('aw_custom_types');
		$customtypes[] =
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
		);


       		register_post_type( 'Photo', $args);

   	}
   	add_action( 'init', 'aw_custom_posttype_photo' );
}


/******************************************************************************************************************
*	Create custom taxonomy Resolution for post type photo
******************************************************************************************************************/
   function amazing_walls_resolution_init()
   {
   	//add new hierarchical taxonomy
   	$lables = array(
   		'name' => 'Resolution',
   		'singular_name' => 'Resulution',
   		'search_items' => 'Search Types',
   		'all_items' => 'All Types',
   		'parent_item' => 'Parent Type',
   		'parent_item_colon' => 'Parent Type:',
   		'edit_item' => 'Edit Type',
   		'update_item' => 'Update Type',
   		'add_new_item' => 'Add New Type',
   		'new_item_name' => 'New Type Name',
   		'menu_name' => 'Resolution'
   	);

   	$args = array(
   		'hierarchical' => true,
   		'labels' => $lables,
   		'show_ui' => true,
   		'show_admin_column' => true,
   		'query_var' => true,
   		'rewrite' => array('slug' => 'resolution'),
		'show_tagcloud' => true,
   	);

   	register_taxonomy('Resolution', array('photo'), $args);
   }
   add_action( 'init', 'amazing_walls_resolution_init' );


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

   	register_taxonomy('People', array('photo'), $args);
   }
   add_action( 'init', 'amazing_walls_people_init' );


///******************************************************************************************************************
//*
//******************************************************************************************************************/
//    function my_search_filter($query) {
//        if ( !is_admin() && $query->is_main_query() ) {
//            if ($query->is_search) {
//                $query->set('post_type', array( 'post','photo') );
//            }
//        }
//    }
//add_action('pre_get_posts','my_search_filter');


    add_action( 'save_post', 'aw_add_resolition' );

    function aw_add_resolition($post_id)
    {
        if(has_post_thumbnail($post_id))
        {

            //get the image resolution
            $image_url = get_the_post_thumbnail_url($post_id);
            list($width, $height) = getimagesize($image_url);

            if($width  == null)
                $width = 0;

            if($height == null)
                $height = 0;

            //Insert resolution into Resolution taxonomy
            $term = $width;
            $term .= 'x';
            $term .= $height;
            $taxonomy = 'Resolution';
            wp_insert_term($term, $taxonomy);

        }
    }
