<?php

	error_reporting(E_ALL);

	//Exit if accessed directly
	if(!defined('ABSPATH'))
	{
	  exit;
	}
	require_once('general.php');
	require_once('theme_section.php');
	require_once('post_thumbnail_section.php');
	require(get_template_directory().'/includes/config.php');
	$page_slug = 'aw_theme_options';

	/************************************************************************************************
	*	Purpose:	Create menu page
	*************************************************************************************************/
	function aw_create_main_menu_page()
   	{
      global $page_slug;
      $page_title = "Amazing Walls Options";
      $menu_title = "Amazing Walls";
      $capability = "manage_options";
      $callback = "aw_theme_admin_menu_page_template";

      //Generate amazing walls admin page
   		add_menu_page(	$page_title,			     //page title
						$menu_title, 									           //menu lable
						$capability, 									         //capability
						$page_slug, 								                 //page slug
						$callback					 //callback for page templat
					);


    add_submenu_page($page_slug, $page_title, 'General', $capability, $page_slug, $callback);

		//call register settings function
    add_action( 'admin_init', 'aw_register_menu_page_settings' );

   	}
 	add_action("admin_menu", "aw_create_main_menu_page");


	/************************************************************************************************
	*	Purpose:	Register main menu settings
	*************************************************************************************************/
	function aw_register_menu_page_settings()
	{
		global $options_group;
		global $page_slug;

		//Create theme Options
		theme_section($options_group, $page_slug);

		//Create post thumbnail section
		post_thumbnail_section($options_group, $page_slug);


	}




	/****************************************************************************************************
	*	Purpose Amazing Walls menu page template
	****************************************************************************************************/
    function aw_theme_admin_menu_page_template()
   	{
			require_once('general_template.php');
   	}


?>
