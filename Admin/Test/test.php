<?php

error_reporting(E_ALL);

//Exit if accessed directly
if(!defined('ABSPATH'))
{
  exit;
}

require(get_template_directory().'/includes/config.php');

$page_slug = 'aw_admin_test';
/************************************************************************************************
*	Purpose:	Create menu page
*************************************************************************************************/
function aw_create_test_menu_page()
  {
    global $page_slug;
    $page_title = "Amazing Walls Test";
    $menu_title = "Test";
    $capability = "manage_options";
    $callback = "aw_theme_admin_menu_test_template";




  add_submenu_page($page_slug, $page_title, 'Test', $capability, $page_slug, $callback);

  //call register settings function
  add_action( 'admin_init', 'aw_register_menu_test_settings' );

  }
add_action("admin_menu", "aw_create_test_menu_page");

function aw_theme_admin_menu_test_template()
{
  require_once('test_template.php');
}

function aw_register_menu_test_settings()
{
  $section_id = 'aw_test_section';
  global $page_slug;
  $page = $page_slug;
  global $options_group;
  $group = $options_group;
  add_settings_section(	$section_id, 							//Section id
              'Test', 									//Section title
              'aw_test_callback',				//Callback
              $page											          //Parent page slug
            );

  register_setting(	$group, 											//Setting id
            'aw_test_crop'													//Setting name
          );


  add_settings_field(	'aw_test2_field', 		       //Id
            'Test',			 									       //Title
            'aw_test2_callback', 						     //Callback
            $page, 											         //Page
            $section_id													 //Section
            );




 add_settings_field(	'aw_test3_field', 		     //Id
                      'Test',			 						 //Title
                      'aw_test3_callback', 		 //Callback
                      $page, 						         //Page
                      $section_id								 //Section
                      );
}

function aw_test_callback()
{

}

function aw_test2_callback()
{
  echo '<input type="text">';
}

function aw_test3_callback()
{
  echo '<input type="text">';
}

if($_SERVER['REQUEST_METHOD'] == 'post')
{
  echo 'post';
}
