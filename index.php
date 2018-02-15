<?php get_header(); ?>
<?php get_sidebar( 'primary' ); ?>


<!-- print the name of the page when in debug mode -->
<?php aw_print_name('index.php'); ?>



 <!-- Start the Loop. -->
 <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

	<?php get_template_part('/Templates/Parts/post'); ?>
	<?php endwhile; ?>
 	<?php endif; ?>

<div style="clear:left"></div>

<!-- Create post navigation menu -->
<nav class="post_navigation_menu post_navigation_menu_color">
   <?php amazing_walls_numeric_posts_nav(); ?>
</nav>
</br>
</br>

<?php get_footer(); ?>
