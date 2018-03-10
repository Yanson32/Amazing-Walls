<?php get_header(); ?>
<?php get_sidebar( 'primary' ); ?>

<!-- print the name of the page when in debug mode -->
<div id="test">
<?php aw_print_name('Single-Video.php'); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<?php the_title(); ?>
<?php the_content(); ?>
 <?php endwhile; ?>
 <?php endif; ?>



	<?php comments_template(); ?>
</div>

<nav class="post_navigation_menu">
	<?php
		global $wp_query;
		amazing_walls_numeric_posts_nav($wp_query, "Previous Video", "Next Video");
	?>
</nav>
<?php get_footer(); ?>
