<h1> Amazing Walls Theme Test</h1>
<?php settings_errors(); ?>
<form method="post">
	<?php settings_fields('aw-main-menu-page-settings-group'); ?>
	<?php do_settings_sections("aw_admin_test"); ?>
	<?php submit_button(); ?>
</form>
