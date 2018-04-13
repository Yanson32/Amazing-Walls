<?php get_header(); ?>
<?php get_sidebar( 'primary' ); ?>

<!-- print the name of the page when in debug mode -->
<?php aw_print_name('Search.php'); ?>

<!-- The Loop -->
<?php if ( have_posts() ) : ?>
	<?php while ( have_posts() ) : ?>
		<?php the_post(); ?>
		<?php the_title(); ?><br>
		<?php if( has_post_thumbnail() ) : ?>
			<?php echo the_post_thumbnail(); ?>
		<?php endif; ?>
	<?php endwhile; ?>
<?php endif; ?>


<!-- Create post navigation menu -->
<nav class="post_navigation_menu post_navigation_menu_color">
  <?php global $wp_query; amazing_walls_numeric_posts_nav($wp_query, "Previous", "Next"); ?>
</nav>

</br>
</br>
<?php get_footer(); ?>
