<?php
    function aw_register_custom_type_lables()
    {
        add_settings_section(	'aw-create-custom-type-lables', 			//Section id
								'Lables', 									//Section title
								'aw_custom_type_options',					//Callback
								'aw_custom_types'							//Parent page slug
							);
		
		register_setting(	'aw-custom-type-settings-group', 				//Setting id
							'custom_type_name'								//Setting name
						);
				
		add_settings_field(	'aw-custom-type-name', 							//Id
							'Type Name',	 								//Title
							'aw_add_custom_type_name', 						//Callback
							'aw_custom_types', 								//Page
							'aw-create-custom-type-lables'					//Section
							);
		
		register_setting(	'aw-custom-type-settings-group', 				//Setting id
							'custom_type_singular_name'						//Setting name
						);
				
		add_settings_field(	'aw-custom-type-singular-name', 				//Id
							'Type Singular Name',	 						//Title
							'aw_add_custom_type_singular_name', 			//Callback
							'aw_custom_types', 								//Page
							'aw-create-custom-type-lables'					//Section
							);
		
		register_setting(	'aw-custom-type-settings-group', 				//Setting id
							'custom_type_add_new_type'						//Setting name
						);
				
		add_settings_field(	'aw-custom-type-add-new-type',		 			//Id
							'Add New Type',				 					//Title
							'aw_add_custom_type_add_new_type',		 		//Callback
							'aw_custom_types', 								//Page
							'aw-create-custom-type-lables'					//Section
							);
		
		register_setting(	'aw-custom-type-settings-group', 				//Setting id
							'custom_type_add_new_item'						//Setting name
						);
				
		add_settings_field(	'aw-custom-type-add-new-item',		 			//Id
							'Add New Item',				 					//Title
							'aw_add_custom_type_add_new_item',		 		//Callback
							'aw_custom_types', 								//Page
							'aw-create-custom-type-lables'					//Section
							);
		

		
		register_setting(	'aw-custom-type-settings-group', 				//Setting id
							'custom_type_edit_item'							//Setting name
						);
				
		add_settings_field(	'aw-custom-type-edit-item',		 				//Id
							'Edit Item',				 					//Title
							'aw_add_custom_type_edit_item',		 			//Callback
							'aw_custom_types', 								//Page
							'aw-create-custom-type-lables'					//Section
							);
		
		register_setting(	'aw-custom-type-settings-group', 				//Setting id
							'custom_type_new_item'							//Setting name
						);
				
		add_settings_field(	'aw-custom-type-new-item',		 				//Id
							'New Item',				 						//Title
							'aw_add_custom_type_new_item',		 			//Callback
							'aw_custom_types', 								//Page
							'aw-create-custom-type-lables'					//Section
							);
		
		register_setting(	'aw-custom-type-settings-group', 				//Setting id
							'custom_type_all_items'							//Setting name
						);
				
		add_settings_field(	'aw-custom-type-all-items',		 				//Id
							'All Items',				 					//Title
							'aw_add_custom_type_all_items',		 			//Callback
							'aw_custom_types', 								//Page
							'aw-create-custom-type-lables'					//Section
							);
		
		register_setting(	'aw-custom-type-settings-group', 				//Setting id
							'custom_type_view_item'							//Setting name
						);
				
		add_settings_field(	'aw-custom-type-view-item',		 				//Id
							'View Item',				 					//Title
							'aw_add_custom_type_view_item',		 			//Callback
							'aw_custom_types', 								//Page
							'aw-create-custom-type-lables'					//Section
							);
		
		register_setting(	'aw-custom-type-settings-group', 				//Setting id
							'custom_type_search_items'						//Setting name
						);
				
		add_settings_field(	'aw-custom-type-search-items',		 			//Id
							'Search Items',				 					//Title
							'aw_add_custom_type_search_items',		 		//Callback
							'aw_custom_types', 								//Page
							'aw-create-custom-type-lables'					//Section
							);
		
		register_setting(	'aw-custom-type-settings-group', 				//Setting id
							'custom_type_not_found'						//Setting name
						);
				
		add_settings_field(	'aw-custom-type-not-found',		 				//Id
							'Not Found',				 					//Title
							'aw_add_custom_type_not_found',		 			//Callback
							'aw_custom_types', 								//Page
							'aw-create-custom-type-lables'					//Section
							);
		
		register_setting(	'aw-custom-type-settings-group', 				//Setting id
							'custom_type_not_found_in_trash'				//Setting name
						);
				
		add_settings_field(	'aw-custom-type-not-found-in-trash',		 	//Id
							'Not Found In Trash',				 			//Title
							'aw_add_custom_type_not_found_in_trash',		//Callback
							'aw_custom_types', 								//Page
							'aw-create-custom-type-lables'					//Section
							);
		
		register_setting(	'aw-custom-type-settings-group', 				//Setting id
							'custom_type_parent_item_colon'					//Setting name
						);
				
		add_settings_field(	'aw-custom-type-parent-item-colon',		 		//Id
							'Parent Item Colon',				 			//Title
							'aw_add_custom_type_parent_item_colon',			//Callback
							'aw_custom_types', 								//Page
							'aw-create-custom-type-lables'					//Section
							);
		
		register_setting(	'aw-custom-type-settings-group', 				//Setting id
							'custom_type_menu_name'							//Setting name
						);
				
		add_settings_field(	'aw-custom-type-menu-name',		 				//Id
							'Menu Name',				 					//Title
							'aw_add_custom_type_menu_name',					//Callback
							'aw_custom_types', 								//Page
							'aw-create-custom-type-lables'					//Section
							);
    }
    
    	//Lables
	function aw_add_custom_type_name()
	{
		$name = 'custom_type_name';
		$value = get_option($name);
		$placeholder = 'Type Name';
		echo '<input type="text" name="'.$name.'" value="'.$value.'" placeholder="'.$placeholder.'"/>';
		
	}
	
	function aw_add_custom_type_singular_name()
	{
		$name = 'custom_type_singular_name';
		$value = get_option($name);
		$placeholder = 'Singular Name';
		echo '<input type="text" name="'.$name.'" value="'.$value.'" placeholder="'.$placeholder.'"/>';
	}
	
	function aw_add_custom_type_add_new_type()
	{
		$name = 'custom_type_add_new_type';
		$value = get_option($name);
		$placeholder = 'Add New Type';
		echo '<input type="text" name="'.$name.'" value="'.$value.'" placeholder="'.$placeholder.'"/>';
	}
	
	function aw_add_custom_type_add_new_item()
	{
		$name = 'custom_type_add_new_item';
		$value = get_option($name);
		$placeholder = 'Add New Item';
		echo '<input type="text" name="'.$name.'" value="'.$value.'" placeholder="'.$placeholder.'"/>';
		
	}
	
	function aw_add_custom_type_edit_item()
	{
		$name = 'custom_type_edit_item';
		$value = get_option($name);
		$placeholder = 'Edit Item';
		echo '<input type="text" name="'.$name.'" value="'.$value.'" placeholder="'.$placeholder.'"/>';
	}
	
	function aw_add_custom_type_new_item()
	{
		$name = 'custom_type_new_item';
		$value = get_option($name);
		$placeholder = 'New Item';
		echo '<input type="text" name="'.$name.'" value="'.$value.'" placeholder="'.$placeholder.'"/>';
	}
	
	function aw_add_custom_type_all_items()
	{
		$name = 'custom_type_all_items';
		$value = get_option($name);
		$placeholder = 'All Items';
		echo '<input type="text" name="'.$name.'" value="'.$value.'" placeholder="'.$placeholder.'"/>';
	}
	
	function aw_add_custom_type_view_item()
	{
		$name = 'custom_type_view_item';
		$value = get_option($name);
		$placeholder = 'View Item';
		echo '<input type="text" name="'.$name.'" value="'.$value.'" placeholder="'.$placeholder.'"/>';
	}
	
	function aw_add_custom_type_search_items()
	{
		$name = 'custom_type_search_items';
		$value = get_option($name);
		$placeholder = 'Search Items';
		echo '<input type="text" name="'.$name.'" value="'.$value.'" placeholder="'.$placeholder.'"/>';
	}
	
	function aw_add_custom_type_not_found()
	{
		$name = 'custom_type_not_found';
		$value = get_option($name);
		$placeholder = 'Custom Type Not Found';
		echo '<input type="text" name="'.$name.'" value="'.$value.'" placeholder="'.$placeholder.'"/>';
	}
	
	function aw_add_custom_type_not_found_in_trash()
	{
		$name = 'custom_type_not_found_in_trash';
		$value = get_option($name);
		$placeholder = 'Custom Type Not Found In Trash';
		echo '<input type="text" name="'.$name.'" value="'.$value.'" placeholder="'.$placeholder.'"/>';
	}
	
	function aw_add_custom_type_parent_item_colon()
	{
		$name = 'custom_type_parent_item_colon';
		$value = get_option($name);
		$placeholder = 'Parent Item Colon';
		echo '<input type="text" name="'.$name.'" value="'.$value.'" placeholder="'.$placeholder.'"/>';
	}
	
	function aw_add_custom_type_menu_name()
	{
		$name = 'custom_type_menu_name';
		$value = get_option($name);
		$placeholder = 'Menu Name';
		echo '<input type="text" name="'.$name.'" value="'.$value.'" placeholder="'.$placeholder.'"/>';
	}
?>