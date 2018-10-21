<?php
/************************************************************************//**
*	Create custom taxonomy Resolution for post type photo
****************************************************************************/
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
   'hierarchical' => false,
   'labels' => $lables,
   'show_ui' => true,
   'show_admin_column' => true,
   'query_var' => true,
   'rewrite' => array('slug' => 'resolution'),
	'show_tagcloud' => true,
  );

  register_taxonomy('Resolution', array('photo', 'mobile'), $args);
}
add_action( 'init', 'amazing_walls_resolution_init' );



// /************************************************************************//**
// *	@brief save resolution data
// ****************************************************************************/
// function aw_add_resolition($post_id)
// {
//     if(has_post_thumbnail($post_id))
//     {
//
//         //get the image resolution
//         $image_url = get_the_post_thumbnail_url($post_id);
//         list($width, $height) = getimagesize($image_url);
//
//         if($width  == null)
//             $width = 0;
//
//         if($height == null)
//             $height = 0;
//
//         //Insert resolution into Resolution taxonomy
//         $term = $width;
//         $term .= 'x';
//         $term .= $height;
//         $taxonomy = 'Resolution';
//         wp_insert_term($term, $taxonomy);
//
//     }
// }
// add_action( 'save_post', 'aw_add_resolition' );

/*************************************************************************************//**
* @brief: This function saves the resolution of the post thumbnail to the resolution
*         taxonomy.
*****************************************************************************************/
function aw_save_resolution()
{
	global $post;

		//Make sure the post type is photo or mobile
		if(get_post_type() == 'photo' || get_post_type() == 'mobile'):

			//Make sure the post has a thumbnail
			//if($post->has_post_thumbnail):
				$thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id( $post ), 'full');
				$width = $thumbnail[1];
				$height = $thumbnail[2];

				//Set the resolution of the post thumbnail. We erase any previous entries resolution entries
				wp_set_object_terms( get_the_ID(), $width.'x'.$height, 'Resolution', false);
			//endif;
		endif;
}
add_action( 'save_post', 'aw_save_resolution' );
