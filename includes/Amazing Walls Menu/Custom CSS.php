<?php
	/****************************************************************************************************
	*	Purpose Create Amazing Walls css sub menu
	****************************************************************************************************/
   	function aw_theme_css_sub_menu_page()
   	{
		
		
		//Generate amazing walls css sub menu page
		add_submenu_page(	"aw_theme_options", 							//parent slug
							"Amazing Walls CSS", 							//page title
							"Custom CSS", 									//menu lable
							"manage_options", 								//
							"aw_them_css", 									//page slug
							"aw_css_menu_page_template"						//callback for page template
						);
	
		//call register settings function
    	add_action( 'admin_init', 'aw_register_css_menu_settings' );
   	}
 	add_action("admin_menu", "aw_theme_css_sub_menu_page");


	/****************************************************************************************************
	*	Purpose register Amazing Walls css settings
	****************************************************************************************************/
	function aw_register_css_menu_settings()
	{

	}
	

	/****************************************************************************************************
	*	Purpose Amazing Walls css menu template
	****************************************************************************************************/
	function aw_css_menu_page_template()
   	{
		require_once(get_template_directory().'/includes/Amazing Walls Menu/templates/aw_css.php');
   	}
?>
