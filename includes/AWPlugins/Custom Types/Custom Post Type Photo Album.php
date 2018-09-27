<?php
/******************************************************************************************************************
*	Create custom post photo album
******************************************************************************************************************/
if ( ! function_exists( 'amazing_walls_custom_posttype_photo_album' ) )
{
	function amazing_walls_custom_posttype_photo_album()
	{
    	//Custom type labels
			$labels = array(
			'name' => __('Photo Album'),
			'singular_name' => __('Album'),
			'add_new' => __('Add New Album'),
			'add_new_item' => __('Add New Album'),
			'edit_item' => __('Edit Album'),
			'new_item' => __('New Album'),
			'all_items' => __('All Albums'),
			'view_item' => __('View Albums'),
			'search_items' => __('Search Albums'),
			'not_found' => __('No Albums Found'),
			'not_found_in_trash' => __('No albums found in trash'),
			'parent_item_colon' => '',
			'menu_name' => __('Photo Album')
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
			'rewrite' => array('slug' => 'album'),
			'supports' => $supports,
			'taxonomies' => array('post_tag', 'category'),
			'show_in_menu' => true,
			'menu_position' => 5,
			);


      register_post_type( 'Photo Album', $args);
   	}
   	add_action( 'init', 'amazing_walls_custom_posttype_photo_album' );
}

function aw_gallery_meta_box()
{
    add_meta_box( 'gallery-meta-box', __( 'Gallery', 'Amazing_Walls' ), 'aw_gallery_callback', 'photoalbum' );
}

function aw_gallery_callback($post)
{
    wp_nonce_field(aw_save_gallery_data, 'aw_gallery_meta_box_nonce');
    $value = get_post_meta($post->ID, '_gallery_value_key', true);
    echo '<label for="aw_gallery_field">User Gallery</label>';
    echo '<input class="widefat" type="email" id="aw_gallery_field" name="aw_gallery_field" value="' .esc_attr($value). '" size="25" />';
    echo '<div class="uploader">';
		echo '<input class="widefat" id="_unique_name" name="settings[_unique_name]" type="text" />';
		echo '<input id="_unique_name_button" class="button" name="_unique_name_button" type="text" value="Upload" />';
    echo '</div>';
}
add_action( 'add_meta_boxes', 'aw_gallery_meta_box' );


//set default attributes for image galleries
function aw_gallery_defaults( $settings )
{
    $settings['galleryDefaults']['link'] = 'file';
    return $settings;
}
add_filter( 'media_view_settings', 'aw_gallery_defaults');
