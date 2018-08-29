<?php
function theme_section($group, $page)
{
  $section = 'aw_theme_section';

  add_settings_section(	$section, 								//Section id
              'Theme Options', 										//Section title
              'aw_theme_callback',								//Callback
              $page																//Parent page slug
            );

  register_setting(	$group, 											//Setting id
            'aw_theme'														//Setting name
          );

  add_settings_field(	'aw_dark_theme', 						//Id
            'Dark',			 													//Title
            'aw_dark_theme_callback', 						//Callback
            $page, 																//Page
            $section															//Section
            );

  add_settings_field(	'aw_light_theme', 					//Id
            'Light',			 												//Title
            'aw_light_theme_callback', 						//Callback
            $page, 																//Page
            $section															//Section
            );
}

/****************************************************************************************************
*
****************************************************************************************************/
function aw_theme_callback()
{
}


/************************************************************************************************
*	Purpose:	Register main menu settings
*************************************************************************************************/
function aw_dark_theme_callback()
{

  $checked = '';

  if(get_option('aw_theme') === "Dark")
    $checked = 'checked';

  echo '<input type="radio" name="aw_theme" value="Dark" placeholder="Dark" id="dark_theme" '.$checked.' />';

}

function aw_light_theme_callback()
{
  $checked = '';

  if(get_option('aw_theme') === 'Light')
    $checked = 'checked';

  echo '<input type="radio" name="aw_theme" value="Light" placeholder="Light" id="light_theme" '.$checked.' />';

}
