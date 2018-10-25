<?php
/************************************************************************//**
*	Create custom taxonomy aspect ratio for post type photo
****************************************************************************/
function amazing_walls_aspect_ratio_init()
{
  //add new hierarchical taxonomy
  $lables = array(
   'name' => 'Aspect Ratio',
   'singular_name' => 'Aspect Ratio',
   'search_items' => 'Search Types',
   'all_items' => 'All Types',
   'parent_item' => 'Parent Type',
   'parent_item_colon' => 'Parent Type:',
   'edit_item' => 'Edit Type',
   'update_item' => 'Update Type',
   'add_new_item' => 'Add New Type',
   'new_item_name' => 'New Type Name',
   'menu_name' => 'Aspect Ratio'
);

  $args = array(
   'hierarchical' => false,
   'labels' => $lables,
   'show_ui' => true,
   'show_admin_column' => true,
   'query_var' => true,
   'rewrite' => array('slug' => 'aspectratio'),
	'show_tagcloud' => true,
  );

  register_taxonomy('Aspect Ratio', array('photo', 'mobile'), $args);
}
add_action( 'init', 'amazing_walls_aspect_ratio_init' );


/*************************************************************************************//**
* @brief: This function saves the aspect ratio of a post thumbnail to the Aspect Ratio
*         taxonomy.
*****************************************************************************************/
function aw_save_aspect_ratio()
{
  //Make sure the post type has a photo custom field
  if(!empty(get_post_custom_values('Photo'))):
    $image_id_array = get_post_custom_values('Photo');

    foreach($image_id_array as $id)
    {
      $image = wp_get_attachment_image_src($id, 'full');
      $width = $image[1];
      $height = $image[2];
      $cd = array_reduce(array($width, $height), 'gcd');
      $width /= $cd;
      $height /= $cd;

			//Set the aspect ratio of the post thumbnail. We erase any previous aspect ratio entries
      wp_set_object_terms( get_the_ID(), $width.':'.$height, 'Aspect Ratio', false);
		//endif;
    }
	endif;
}
add_action( 'save_post', 'aw_save_aspect_ratio' );


// Recursive function to compute gcd (euclidian method)
function gcd ($a, $b)
{
    return $b ? gcd($b, $a % $b) : $a;
}
