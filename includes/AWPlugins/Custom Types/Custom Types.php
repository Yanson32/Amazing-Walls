<?php
/*
*
* Plugin Name: Amazing-Wallpapers-Plugin
* Description: This plugin comes with the Amazing-Wallpapers theme and adds some functionality that makes
*		sense for the theme.
* Author: Wayne J Larson Jr
* Version: 0.1
*/
	$createphoto = get_option('create_photo_type');
	if($createphoto)
		require('Custom Post Type Photo.php');

	$createphotogallery = get_option('create_photo_gallery_type');
	if($createphotogallery)
		require('Custom Post Type Photo Album.php');

	$createvideo = get_option('create_video_type');
	if($createvideo)
		require('Custom Post Type Video.php');


	function aw_custom_type_callback()
	{
		register_setting(	'aw-custom-types',
							'aw_custom_types');

	}

?>
