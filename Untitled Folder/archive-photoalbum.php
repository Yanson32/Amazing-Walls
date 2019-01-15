<!-- Function Definition -->
<!-- Start the loop -->
<?php get_header(); ?>
<?php get_sidebar( 'primary' ); ?>

<!-- print the name of the page when in debug mode -->
<?php aw_print_name('Archive Photoalbum.php'); ?>

<div class="archive_gallery_all_posts">

  <?php if ( have_posts() ) : ?>
  	<?php while ( have_posts() ) : ?>
  		<?php the_post(); ?>
      <?php get_template_part('/Templates/Parts/post'); ?>
  	<?php endwhile; ?>
  <?php endif; ?>

  <!-- Add comments to template -->
  <?php if ( comments_open() || get_comments_number() ) : ?>
  	<?php comments_template(); ?>
  <?php endif; ?>

</div>
<!-- Create post navigation menu -->
<div style="clear:left"></div>
<nav class="post_navigation_menu">
	<?php global $wp_query; aw_numeric_posts_nav($wp_query, "Previous Album", "Next Album"); ?>
</nav>
</br>
</br>
<?php
   get_footer();
   ?>
