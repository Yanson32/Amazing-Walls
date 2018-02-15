<?php
/*
Template Name: Page Template
*/
?>


<!-- Start the loop -->
<?php get_header(); ?>
<?php get_sidebar( 'primary' ); ?>

<?php
	global $post;
	echo $post->post_content;
?>
<!-- Create post navigation menu -->
<div style="clear:left"></div>
<nav class="post_navigation_menu">
   <?php amazing_walls_numeric_posts_nav(); ?>
</nav>
</br>
</br>
<?php get_footer(); ?>
