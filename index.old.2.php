<?php get_header(); ?>
<?php get_sidebar( 'primary' ); ?>


<!-- print the name of the page when in debug mode -->
<?php aw_print_name('index.php'); ?>

<?php
	// The Query
	$args = array('post_type' => array('post', 'photo', 'photoalbum', 'video'));
	$the_query = new WP_Query( $args );
?>

<!-- // The Loop -->
<?php if ( $the_query->have_posts() ): ?>

	<?php while( $the_query->have_posts() ): ?>

		<?php $the_query->the_post(); ?>
		<?php get_template_part('/Templates/Parts/post'); ?>
	<?php endwhile; ?>

	<!-- Restore original Post Data -->
	<?php wp_reset_postdata(); ?>
<?php else: ?> 
	<!-- // no posts found -->
	<?php echo "No Posts Found"; ?>
<?php endif; ?>

<div style="clear:left"></div>

<!-- Create post navigation menu -->
<nav class="post_navigation_menu post_navigation_menu_color">
   <?php amazing_walls_numeric_posts_nav($the_query); ?>
</nav>
</br>
</br>

<?php get_footer(); ?>
