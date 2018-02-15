<?php
	/****************************************************************************************************
	*	Purpose Create Amazing Walls settings sub menu and
	****************************************************************************************************/
   	function aw_theme_admin_settings_page()
   	{
		
		//Generate amazing walls settings sub page
		add_submenu_page(	"aw_theme_options", 					//parent slug
							"Amazing Walls Settings", 				//page title
							"Settings", 							//menu lable
							"manage_options", 						//
							"aw_theme_options_settings", 			//page slug
							"aw_theme_settings_page_template"		//callback for page template
						);
		
	
		//call register settings function
    	add_action( 'admin_init', 'aw_register_admin_menu_settings' );
   	}
 	add_action("admin_menu", "aw_theme_admin_settings_page");


	function aw_register_admin_menu_settings()
	{
		
	}

	/****************************************************************************************************
	*	Purpose Amazing Walls settings menu templete
	****************************************************************************************************/
	function aw_theme_settings_page_template()
	{
   		require_once(get_template_directory().'/includes/Amazing Walls Menu/templates/aw_settings_template.php');
	}
?>
