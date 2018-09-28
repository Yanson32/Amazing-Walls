<?php
/*
*   @brief this file contains all necessary code for the location
*          meta box.
*
*
*/




/********************************************************************//**
*	@Brief html markup for the location meta box.
************************************************************************/
function aw_location_meta_box_markup()
{
  global $post;

 // Nonce field to validate form request came from current site
 wp_nonce_field( basename( __FILE__ ), 'photo_location_fields' );

 // Get the location data if it's already been entered
 $location = get_post_meta( $post->ID, 'location', true );

 // Output the field
 echo '<input type="text" name="location" value="' . esc_textarea( $location )  . '" class="widefat">';
}
/**
 * Save the metabox data
 */

/********************************************************************//**
*	@brief save the metadata for the location meta box
************************************************************************/
function aw_save_location_meta( $post_id, $post )
{
 // Return if the user doesn't have edit permissions.
 if ( ! current_user_can( 'edit_post', $post_id ) ) {
   return $post_id;
 }
 // Verify this came from the our screen and with proper authorization,
 // because save_post can be triggered at other times.
 if ( ! isset( $_POST['location'] ) || ! wp_verify_nonce( $_POST['photo_location_fields'], basename(__FILE__) ) )
 {
   return $post_id;
 }
 // Now that we're authenticated, time to save the data.
 // This sanitizes the data from the field and saves it into an array $events_meta.
 $events_meta['location'] = esc_textarea( $_POST['location'] );
 // Cycle through the $events_meta array.
 // Note, in this example we just have one item, but this is helpful if you have multiple.
 foreach ( $events_meta as $key => $value ) :
   // Don't store custom data twice
   if ( 'revision' === $post->post_type )
   {
     return;
   }
   if ( get_post_meta( $post_id, $key, false ) )
   {
     // If the custom field already has a value, update it.
     update_post_meta( $post_id, $key, $value );
   } else
   {
     // If the custom field doesn't have a value, add it.
     add_post_meta( $post_id, $key, $value);
   }
   if ( ! $value )
   {
     // Delete the meta key if there's no value
     delete_post_meta( $post_id, $key );
   }
 endforeach;
}
add_action( 'save_post', 'aw_save_location_meta', 1, 2 );
