<div class="archive_single_post <?php echo get_post_type(); ?>">
  <?php if( has_post_thumbnail() ) : ?>
   	<?php $image = "wp-content/themes/Amazing Wallpapers/locked.png"; ?>
    <?php $thumb_link =  Get_most_recent_permalink(); ?>
   	<?php echo "<a href=$thumb_link><img src=$image style=width:300px;height:169px></a>"; ?>
  <?php endif; ?>

</div>
