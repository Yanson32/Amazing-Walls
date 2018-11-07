<?php
	require('Custom Type Lables.php');
	require_once('custom_type_general_section.php');
	require_once('custom_types_activation_section.php');
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

		aw_custom_type_general_section();
		aw_custom_type_activation();
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
