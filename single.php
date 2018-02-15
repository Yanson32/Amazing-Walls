<?php get_header(); ?>
<?php get_sidebar( 'primary' ); ?>

<?php if ( post_password_required() ) {
	return;
}?>

<!-- print the name of the page when in debug mode -->
<?php aw_print_name('Single.php'); ?>

<h2><?php the_title(); ?></h2>
<?php get_template_part('/Templates/Parts/attachment style'); ?>

<nav class="post_navigation_menu">
   <?php wpbeginner_numeric_posts_nav(); ?>
</nav>
<?php get_footer(); ?>

