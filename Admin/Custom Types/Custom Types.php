<?php
	require('Custom Type Lables.php');
	require(get_template_directory().'/includes/config.php');

	/************************************************************************************************
	*	Purpose:	Create custom type menu page
	*************************************************************************************************/
	function aw_create_custom_type_menu_page()
  {


		//Generate amazing walls admin page
   		add_submenu_page("aw_theme_options",								//parent slug
						"Amazing Walls Custom Types",						//page title
						"Custom Types", 									//menu lable
						"manage_options", 									//capability
						"aw_custom_types", 									//page slug
						"aw_theme_custom_type_menu_template"				//callback for page templat
					);


		//call register settings function
		add_action('admin_init', 'aw_register_custom_type_lables');
    add_action( 'admin_init', 'aw_register_custom_type_page_settings' );


   	}
 	add_action("admin_menu", "aw_create_custom_type_menu_page");

	/************************************************************************************************
	*	Purpose:	Register custom type settings
	*************************************************************************************************/
	function aw_register_custom_type_page_settings()
	{

		add_settings_section(	'aw-create-custom-type-features', 			//Section id
								'Supported Features', 						//Section title
								'aw_custom_type_features',					//Callback
								'aw_custom_types'							//Parent page slug
							);

		register_setting(	'aw-custom-type-settings-group', 				//Setting id
							'custom_type_name'								//Setting name
						);

		register_setting(	'aw-custom-type-settings-group', 				//Setting id
							'custom_type_dropdown'							//Setting name
						);

		//Custom type options
		add_settings_section(	'aw-create-custom-types', 					//Section id
								'Create custom types', 						//Section title
								'aw_custom_type_options',					//Callback
								'aw_custom_types'							//Parent page slug
							);

		register_setting(	'aw-custom-type-settings-group', 				//Setting id
							'custom_type_name'								//Setting name
						);

		register_setting(	'aw-custom-type-settings-group', 				//Setting id
							'custom_type_dropdown'							//Setting name
						);

		add_settings_field(	'aw-add-custom-type', 							//Id
							'Add custom type', 								//Title
							'aw_add_custom_type', 							//Callback
							'aw_custom_types', 								//Page
							'aw-create-custom-types'						//Section
							);

		register_setting(	'aw-custom-type-settings-group', 				//Setting id
							'custom_type_slug'								//Setting name
						);

		add_settings_field(	'aw-custom-type-slug', 							//Id
							'Custom Type Slug', 							//Title
							'aw_custom_type_slug_callback', 				//Callback
							'aw_custom_types', 								//Page
							'aw-create-custom-types'						//Section
							);

		//Activate custom types
		add_settings_section(	'aw-activate-custom-types', 				//Section id
								'Activate custom types', 					//Section title
								'aw_activate_custom_types',					//Callback
								'aw_custom_types'							//Parent page slug
							);

		register_setting( 	'aw-custom-type-settings-group',				//Setting id
							'create_photo_type');							//Setting name

		add_settings_field(	'aw-activate-photo-type', 						//Id
							'Activate Photo', 								//Title
							'aw_activate_photo_type', 						//Callback
							'aw_custom_types', 								//Page
							'aw-activate-custom-types'						//Section
							);

		register_setting( 	'aw-custom-type-settings-group',				//Setting id
							'create_photo_gallery_type');					//Setting name

		add_settings_field(	'aw-activate-photo-gallery-type', 				//Id
							'Activate Photo Album', 						//Title
							'aw_activate_photo_gallery_type', 				//Callback
							'aw_custom_types', 								//Page
							'aw-activate-custom-types'						//Section
							);

		register_setting( 	'aw-custom-type-settings-group',				//Setting id
							'create_video_type');							//Setting name

		add_settings_field(	'aw-activate-video-type', 						//Id
							'Activate Video', 								//Title
							'aw_activate_video_type', 						//Callback
							'aw_custom_types', 								//Page
							'aw-activate-custom-types'						//Section
							);
	}


	/****************************************************************************************************
	*	Purpose Amazing Walls menu page template
	****************************************************************************************************/
    function aw_theme_custom_type_menu_template()
   	{
		require_once('Custum Type Template.php');

   	}

	/****************************************************************************************************
	*	Purpose		Format custom type options.
	****************************************************************************************************/
	function aw_custom_type_options()
	{

	}


	/************************************************************************************************
	*	Purpose:
	*************************************************************************************************/
	function aw_add_custom_type()
	{
		$custom_type_name = get_option('custom_type_name');
		echo '<input type="text" name="custom_type_name" value="'.$custom_type_name.'" placeholder="Type Name"/>';

		$customTypeDropdown = get_option('custom_type_dropdown');

		if($customTypeDropdown == "Video")
			$video = 'selected';
		else if($customTypeDropdown == "Photo")
			$photo = 'selected';
		else if($customTypeDropdown == "Photo Album")
			$photoalbum = 'selected';
		else if($customTypeDropdown == "Video Gallery")
			$videogallery = 'selected';

 		echo '<select name=custom_type_dropdown>';
  			echo '<option value="Photo"'.$photo.'>Photo</option>';
  			echo '<option value="Photo Album"'.$photoalbum.'>Photo Album</option>';
			echo '<option value="Video"'.$video.'>Video</option>';
			echo '<option value="Video Gallery"'.$videogallery.'>Video Gallery</option>';
		echo '</select>';
	}

	function aw_custom_type_slug_callback()
	{
		$custom_type_slug = get_option('custom_type_slug');
		echo '<input type="text" name="custom_type_slug" value="'.$custom_type_slug.'" placeholder="Type Slug"/>';
	}


	/*******************************************************************************************************
	*	Activate custom types
	*******************************************************************************************************/


	function aw_activate_photo_type()
	{
		$createphoto = get_option('create_photo_type');
		if(!$createphoto)
			echo '<input type="checkbox" name="create_photo_type"/>';
		else
			echo '<input type="checkbox" name="create_photo_type" checked/>';
	}

	function aw_activate_photo_gallery_type()
	{
		$createphotogallery = get_option('create_photo_gallery_type');
		if(!$createphotogallery)
			echo '<input type="checkbox" name="create_photo_gallery_type"/>';
		else
			echo '<input type="checkbox" name="create_photo_gallery_type" checked/>';
	}

	function aw_activate_video_type()
	{
		$createvideo = get_option('create_video_type');
		if(!$createvideo)
			echo '<input type="checkbox" name="create_video_type"/>';
		else
			echo '<input type="checkbox" name="create_video_type" checked/>';
	}
?>
