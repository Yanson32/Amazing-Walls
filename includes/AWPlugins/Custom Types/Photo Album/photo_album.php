<?php
	require_once(get_template_directory().'/includes/config.php');
/******************************************************************************************************************
*	Create custom post photo album
******************************************************************************************************************/
if ( ! function_exists( 'amazing_walls_custom_posttype_photo_album' ) )
{
	function amazing_walls_custom_posttype_photo_album()
	{
    	//Custom type labels
			$labels = array(
			'name' => __('Photo Album', 'Amazing_Walls_Domain'),
			'singular_name' => __('Album', 'Amazing_Walls_Domain'),
			'add_new' => __('Add New Album', 'Amazing_Walls_Domain'),
			'add_new_item' => __('Add New Album', 'Amazing_Walls_Domain'),
			'edit_item' => __('Edit Album', 'Amazing_Walls_Domain'),
			'new_item' => __('New Album', 'Amazing_Walls_Domain'),
			'all_items' => __('All Albums', 'Amazing_Walls_Domain'),
			'view_item' => __('View Albums', 'Amazing_Walls_Domain'),
			'search_items' => __('Search Albums', 'Amazing_Walls_Domain'),
			'not_found' => __('No Albums Found', 'Amazing_Walls_Domain'),
			'not_found_in_trash' => __('No albums found in trash', 'Amazing_Walls_Domain'),
			'parent_item_colon' => '',
			'menu_name' => __('Photo Album', 'Amazing_Walls_Domain')
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
			'rewrite' => array('slug' => __('album', 'Amazing_Walls_Domain')),
			'supports' => $supports,
			'taxonomies' => array('post_tag', 'category'),
			'show_in_menu' => true,
			'menu_position' => 5,
			'register_meta_box_cb' => 'aw_gallery_meta_box',
			);


      register_post_type( __('Photo Album', 'Amazing_Walls_Domain'), $args);
   	}


    if(get_option('create_photo_gallery_type'))
   	  add_action( 'init', 'amazing_walls_custom_posttype_photo_album' );
}

function aw_gallery_meta_box()
{

    add_meta_box( 'gallery-meta-box', __( 'Gallery', 'Amazing_Walls_Domain'), 'aw_gallery_callback', 'photoalbum' );
}

function aw_gallery_callback($post)
{
    wp_nonce_field(aw_save_gallery_data, 'aw_gallery_meta_box_nonce');
    $value = esc_attr(get_post_meta($post->ID, '_gallery_value_key', true));
    echo '<label for="aw_gallery_field">User Gallery</label>';
    echo '<input class="widefat" type="email" id="aw_gallery_field" name="aw_gallery_field" value="' .esc_attr($value). '" size="25" />';
    echo '<div class="uploader">';
		echo '<input class="widefat" id="_unique_name" name="settings[_unique_name]" type="text" />';
		echo '<input id="_unique_name_button" class="button" name="_unique_name_button" type="text" value="Upload" />';
    echo '</div>';
}


//set default attributes for image galleries
function aw_gallery_defaults( $settings )
{
    $settings['galleryDefaults']['link'] = 'file';
    return $settings;
}
add_filter( 'media_view_settings', 'aw_gallery_defaults');
