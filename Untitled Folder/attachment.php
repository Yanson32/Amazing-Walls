<?php get_header(); ?>
<?php get_sidebar( 'primary' ); ?>

<!-- Exit if password is required -->
<?php if ( post_password_required() ): ?>
	return;
<?php endif; ?>

<!-- print the name of the page when in debug mode -->
<?php aw_print_name('Attachment.php'); ?>

<!-- The Loop -->
<?php if ( have_posts() ) : ?>
	<?php while ( have_posts() ) : ?>
		<?php the_post(); ?>
		<?php the_title(); ?>
		<?php the_content(); ?>
	<?php endwhile; ?>
<?php endif; ?>

<!-- navigation links -->
<?php previous_post_link(); ?>
<?php next_post_link(); ?>

<!-- Add comments to template -->
<?php if ( comments_open() || get_comments_number() ) : ?>
	<?php comments_template(); ?>
<?php endif; ?>


<?php get_footer(); ?>
