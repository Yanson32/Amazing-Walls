<?php
  function aw_custom_type_general_section()
  {

    //Activate custom types
    add_settings_section(	'aw_custom_types_general_section', 				//Section id
                'General', 					//Section title
                'aw_custom_types_general',					//Callback
                'aw_custom_types'							//Parent page slug
              );

    register_setting( 	'aw-custom-type-settings-group',				 //Setting id
              'aw_ct_download');							                   //Setting name

    add_settings_field(	'aw_ct_download_field', 						//Id
              'Allow Download', 								//Title
              'aw_ct_allow_download_field', 						//Callback
              'aw_custom_types', 								//Page
              'aw_custom_types_general_section'						//Section
              );

    register_setting( 	'aw-custom-type-settings-group',				 //Setting id
                        'aw_ct_queue');							                   //Setting name

    add_settings_field(	'aw_ct_queue_field', 						//Id
                        'Allow Queue', 								//Title
                        'aw_ct_allow_queue_field', 						//Callback
                        'aw_custom_types', 								//Page
                        'aw_custom_types_general_section'						//Section
                        );
  }
  function aw_custom_types_general()
  {

  }

  function aw_ct_allow_download_field()
  {
    $name = 'aw_ct_download';
    $checked = (get_option($name))? "checked" : "";
    echo '<input name="'.$name.'" type="checkbox" '.$checked.' >';
  }

  function aw_ct_allow_queue_field()
  {
    $name = 'aw_ct_queue';
    $checked = (get_option($name))? "checked" : "";
    echo '<input name="'.$name.'" type="checkbox" '.$checked.' >';
  }
