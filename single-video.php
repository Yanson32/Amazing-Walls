<?php get_header(); ?>
<?php get_sidebar( 'primary' ); ?>
<div style="float:clear;"></div>
<!-- print the name of the page when in debug mode -->
<?php aw_print_name('Single-Video.php'); ?>

<h2><?php the_title(); ?></h2>


<?php if(has_shortcode( $post->post_content, 'video' ) ): ?>

<div id="single_video">
	<?php echo do_shortcode('[video]') ?>
</div>
<?php endif ?>

<nav class="post_navigation_menu">
	<?php
		global $wp_query;
		amazing_walls_numeric_posts_nav($wp_query, "Previous Video", "Next Video"); 
	?>
</nav>
<?php get_footer(); ?>

