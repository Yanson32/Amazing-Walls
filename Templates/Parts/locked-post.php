<div class="archive_single_post <?php echo get_post_type(); ?>">
   	<?php $image =  the_lock_post_image_url(); ?>
    <?php $thumb_link =  Get_most_recent_permalink(); ?>

<!-- get the defined width and height of the post featured image -->
	<?php global $_wp_additional_image_sizes; ?>
	<?php $image_width = $_wp_additional_image_sizes['post-thumbnail']['width']; ?>
	<?php $image_height = $_wp_additional_image_sizes['post-thumbnail']['height']; ?>
   	<img src="<?php echo $image; ?>" alt="Post Locked" style="width:<?php echo $image_width; ?>; height:<?php echo $image_height; ?>">
</div>
