<div class="archive_single_post <?php echo get_post_type(); ?>">

	<!-- Permalink of post -->
	<?php $thumb_link =  Get_most_recent_permalink(); ?>
	
	<!-- Alt text set to image title if available -->
	<?php $alt_text = get_the_title(); ?>
	<?php if($alt_text == "" || $alt_text == "Private:" || $alt_text == "Protected:"): ?>
		<?php $alt_text = "Featured Image"; ?>
	<?php endif; ?>

	<!-- Get the featured image url -->
	<?php $image = get_the_post_thumbnail_url(); ?>	
	<?php if(!has_post_thumbnail()) : ?>
		<?php $image = the_default_featured_image_url(); ?>
	<?php endif; ?>

	<!-- get the defined width and height of the post featured image -->
	<?php global $_wp_additional_image_sizes; ?>
	<?php $image_width = $_wp_additional_image_sizes['post-thumbnail']['width']; ?>
	<?php $image_height = $_wp_additional_image_sizes['post-thumbnail']['height']; ?>
	<a href=<?php echo $thumb_link; ?>><img src="<?php echo $image; ?>" style="width:<?php echo $image_width; ?>; height:<?php echo $image_height; ?>" alt="<?php echo $alt_text; ?>"></a>
</div>


