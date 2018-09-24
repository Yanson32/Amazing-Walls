<?php

error_reporting(E_ALL);

//Exit if accessed directly
if(!defined('ABSPATH'))
{
  exit;
}

function post_thumbnail_section($group, $page)
{
  $section_id = 'aw_post_thumbnail_section';

  add_settings_section(	$section_id, 							//Section id
              'Post Thumbnail', 									//Section title
              'aw_post_thumbnail_callback',				//Callback
              $page											          //Parent page slug
            );

  register_setting(	$group, 											//Setting id
            'aw_pt_crop'													//Setting name
          );


  add_settings_field(	'aw_crop_field', 		       //Id
            'Crop',			 									       //Title
            'aw_crop_callback', 						     //Callback
            $page, 											         //Page
            $section_id													 //Section
            );




 add_settings_field(	'aw_resize_field', 		     //Id
                      'Resize',			 						 //Title
                      'aw_resize_callback', 		 //Callback
                      $page, 						         //Page
                      $section_id								 //Section
                      );
}

function aw_post_thumbnail_callback()
{

}

function aw_crop_callback()
{
  $checked = '';

  if(get_option('aw_pt_crop'))
    $checked = 'checked';

  echo '<input id="aw_pt_crop_input" name="aw_pt_crop" type="radio" value="1" placeholder="false" '.$checked.'>';
}

function aw_resize_callback()
{
  $checked = '';

  if(!get_option('aw_pt_crop'))
    $checked = 'checked';


  echo '<input id="aw_pt_resize_input" name="aw_pt_crop" type="radio" value="0" placeholder="false"'.$checked.'>';
}
