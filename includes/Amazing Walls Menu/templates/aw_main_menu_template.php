<h1> Amazing Walls Theme Options</h1>
<?php settings_errors(); ?>
<form method="post" action="options.php">
	<?php settings_fields('aw-main-menu-page-settings-group'); ?>
	<?php do_settings_sections("aw_theme_options"); ?>
	<?php submit_button(); ?>
</form>
