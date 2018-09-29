  <ul id="aw_post_header">
    <li style="float:left" ><?php get_search_form(); ?></li>
    <?php if(is_singular()): ?>
      <li><?php aw_the_queue_button(); ?> </li>
    <?php endif; ?>
    <?php if(is_singular()): ?>
      <li><?php aw_the_download_button();?> </li>
    <?php endif; ?>
  </ul>
  <?php echo wp_login(); ?>
<hr style="width:100%; float:left">


<!-- <?php aw_the_queue_button(); ?>
<?php aw_the_download_button() ?> -->
