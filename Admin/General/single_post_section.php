<?php
  function single_post_section($group, $page)
  {
    $section = 'Single Post';
    add_settings_section(	$section, 								//Section id
                'Single Post', 										//Section title
                'aw_single_post_section_callback',								//Callback
                $page																//Parent page slug
              );

    register_setting(	$group, 											//Setting id
              'aw_admin_panel_permissions'											//Setting name
            );

   add_settings_field(	'aw_admin_panel_field', 						//Id
              'Admin Panel Permissions',			 													//Title
              'aw_admin_panel_permissions_callback', 						//Callback
              $page, 																//Page
              $section															//Section
              );
  }

  function aw_single_post_section_callback()
  {

  }


  function aw_admin_panel_permissions_callback()
  {
    $name = 'aw_admin_panel_permissions';
    $option = get_option($name);
    $administrator = ($option === "administrator")? "selected": "";
    $editor = ($option === "editor")? "selected": "";
    $author = ($option === "author")? "selected": "";
    $contributor = ($option === "contributor")? "selected": "";
    $subscriber = ($option === "subscriber")? "selected": "";

    echo '<select name="'.$name.'">';
      echo '<option  value="administrator" '.$administrator.'>Admin</option>';
      echo '<option value="editor" '.$editor.'>Editor</option>';
      echo '<option value="author" '.$author.'>Author</option>';
      echo '<option value="contributor" '.$contributor.'>Contributor</option>';
      echo '<option value="subscriber" '.$subscriber.'>Subscriber</option>';
    echo '</select>';
  }
