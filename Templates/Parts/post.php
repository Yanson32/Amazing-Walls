<div id="post-<?php the_ID(); ?>" <?php post_class('archive_single_post clearfix'); ?> >

  <?php if(is_home() || is_search() || is_tax() || is_singular() || is_tag() || is_category()):?>
    <?php $image_width = wp_get_additional_image_sizes()['thumbnail']['width']; ?>
  	<?php $image_height = wp_get_additional_image_sizes()['thumbnail']['height']; ?>
	<?php endif; ?>

  <!-- Permalink of post -->
  <?php $thumb_link =  get_permalink(); ?>

  <!-- Alt text set to image title if available -->
  <?php $alt_text = get_the_title(); ?>

  <!-- Get the featured image url -->
  <?php $image = aw_the_featured_image_url(get_the_ID(), $image_width, $image_height); ?>


  <a href="<?php echo $thumb_link; ?>"><img class="post-thumbnail" src="<?php echo $image;?>" style="width:<?php echo $image_width; ?>; height:<?php echo $image_height; ?>" alt="<?php echo $alt_text; ?>"></a>

</div>
