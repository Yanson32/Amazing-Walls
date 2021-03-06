<?php
  function aw_custom_type_activation()
  {
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
          							'create_mobile_type');					//Setting name

    add_settings_field(	'aw-activate-mobile-type', 				//Id
          							'Activate Mobile', 						//Title
          							'aw_activate_mobile_type', 				//Callback
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

  /*******************************************************************************************************
	*	Activate custom types
	*******************************************************************************************************/
	function aw_activate_photo_type()
	{
    $name = 'create_photo_type';
    $checked = (get_option($name))? "checked" : "";
		echo '<input type="checkbox" name="'.$name.'" '.$checked.'/>';
	}

  function aw_activate_photo_gallery_type()
  {
    $name = 'create_photo_gallery_type';
    $checked = (get_option($name))? 'checked': '';
    echo '<input type="checkbox" name="'.$name.'" '.$checked.'/>';
  }

  function aw_activate_mobile_type()
  {
    $name = 'create_mobile_type';
    $checked = (get_option($name))? 'checked': '';
    echo '<input type="checkbox" name="'.$name.'" '.$checked.'/>';
  }

  function aw_activate_video_type()
  {
      $name = 'create_video_type';
      $checked = (get_option($name))? 'checked': '';
      echo '<input type="checkbox" name="'.$name.'" '.$checked.'/>';
  }

function aw_activate_custom_types()
{

}
