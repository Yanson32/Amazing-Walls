<div id="post-<?php the_ID(); ?>" <?php post_class('archive_single_post clearfix'); ?> >

	<!-- Permalink of post -->
	<?php $thumb_link =  get_permalink(); ?>

	<!-- Alt text set to image title if available -->
	<?php $alt_text = get_the_title(); ?>
	<?php if($alt_text == "" || $alt_text == "Private:" || $alt_text == "Protected:"): ?>
		<?php $alt_text = "Featured Image"; ?>
	<?php endif; ?>

	<!-- Get the featured image url -->
	<?php $image = the_featured_image_url(get_the_ID()); ?>

	<!-- get the defined width and height of the post featured image -->
	<?php global $_wp_additional_image_sizes; ?>
	<?php $image_width = $_wp_additional_image_sizes['post-thumbnail']['width']; ?>
	<?php $image_height = $_wp_additional_image_sizes['post-thumbnail']['height']; ?>
	<?php if(get_post_type() == 'mobile'): ?>
		<?php $image_width = $_wp_additional_image_sizes['mobile-thumb']['width']; ?>
		<?php $image_height = $_wp_additional_image_sizes['mobile-thumb']['height']; ?>
	<?php endif; ?>

	<?php if(is_home() || is_search()):?>
		<?php $image_width = 200; ?>
		<?php $image_height = 200; ?>
	<?php endif; ?>
	<?php if(has_post_thumbnail()):?>
		<a href="<?php echo $thumb_link; ?>"><img class="post-thumbnail" src="<?php echo $image; ?>" style="width:<?php echo $image_width; ?>; height:<?php echo $image_height; ?>" alt="<?php echo $alt_text; ?>"></a>
	<?php else: ?>
		<a href="<?php echo $thumb_link; ?>"><img class="post-thumbnail" src="<?php echo $image;?>" style="width:<?php echo $image_width; ?>; height:<?php echo $image_height; ?>" alt="<?php echo $alt_text; ?>"></a>
	<?php endif; ?>
</div>
