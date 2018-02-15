<?php   	

	/************************************************************************************************
	*	Purpose:	Create menu page
	*************************************************************************************************/
	function aw_create_main_menu_page()
   	{
		//Generate amazing walls admin page
   		add_menu_page(	"Amazing Walls Options",							//page title
						"Amazing Walls", 									//menu lable
						"manage_options", 									//capability
						"aw_theme_options", 								//page slug
						"aw_theme_admin_menu_page_template"					//callback for page templat
					);
	
		//call register settings function
    	add_action( 'admin_init', 'aw_register_menu_page_settings' );
   	}
 	add_action("admin_menu", "aw_create_main_menu_page");

	
	/************************************************************************************************
	*	Purpose:	Register main menu settings
	*************************************************************************************************/
	function aw_register_menu_page_settings()
	{

		add_settings_section(	'aw-style-options', 						//Section id
								'Style Options', 							//Section title
								'aw_sidebar_options',						//Callback
								'aw_theme_options'							//Parent page slug
							);

		register_setting(	'aw-main-menu-page-settings-group', 			//Setting id
							'aw_style'										//Setting name
						);


		add_settings_field(	'aw-style', 									//Id
							'Style',			 							//Title
							'aw_style_callback', 							//Callback
							'aw_theme_options', 							//Page
							'aw-style-options'								//Section
							);




	}

	/****************************************************************************************************
	*	Purpose Amazing Walls menu page template
	****************************************************************************************************/
    function aw_theme_admin_menu_page_template()
   	{ 
		require_once(get_template_directory().'/includes/Amazing Walls Menu/templates/aw_main_menu_template.php');

   	}

	/****************************************************************************************************
	*	Purpose		Format sidebar options on main menu settings page
	****************************************************************************************************/
	function aw_sidebar_options()
	{
	}


	/************************************************************************************************
	*	Purpose:	Register main menu settings
	*************************************************************************************************/
	function aw_style_callback()
	{
		$style = get_option('aw_style');

		echo '<label for="Light">Light</label>';
		if($style === 'Light')
			echo '<input type="radio" name="aw_style" value="Light" placeholder="Light" id="Light" checked />';
		else
			echo '<input type="radio" name="aw_style" value="Light" placeholder="Light" id="Light"/>';

		echo '</br>';
		echo '<label for="Dark">Dark	 </label>';
		if($style === 'Dark')
			echo '<input type="radio" name="aw_style" value="Dark" placeholder="Dark" id="Dark" checked />';
		else
			echo '<input type="radio" name="aw_style" value="Dark" placeholder="Dark" id="Dark"/>';

		
	}
?>
