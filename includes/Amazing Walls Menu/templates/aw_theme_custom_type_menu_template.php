<h1> Amazing Walls Custom Types</h1>
<?php settings_errors(); ?>
<form method="post" action="options.php">
	<?php settings_fields('aw-custom-type-settings-group'); ?>
	<?php do_settings_sections("aw_custom_types"); ?>
	<?php submit_button(); ?>
</form>
