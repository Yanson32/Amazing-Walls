<?php
	/*
	*	Template Name: Contact
	*/
?>


<?php get_header(); ?>
<?php get_sidebar( 'primary' ); ?>


<!-- print the name of the page when in debug mode -->
<?php aw_print_name('Contact.php Page Template'); ?>


<!-- The Loop -->
<main>
 <?php if ( have_posts() ) : ?>
   <?php while ( have_posts() ) : ?>
     <?php the_post(); ?>
    <?php get_template_part('/Templates/Parts/post'); ?>
   <?php endwhile; ?>
 <?php endif; ?>
</main>


<!-- Add comments to template -->
 <?php if ( comments_open() || get_comments_number() ) : ?>
   <?php comments_template(); ?>
 <?php endif; ?>


<!-- Create post navigation menu -->
<nav class="post_navigation_menu post_navigation_menu_color">
  <?php global $wp_query; aw_numeric_posts_nav($wp_query, "Previous", "Next"); ?>
</nav>

<!-- Create page footer -->
<?php get_footer(); ?>
