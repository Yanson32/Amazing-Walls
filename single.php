<?php get_header(); ?>
<?php get_sidebar( 'primary' ); ?>

<!-- Exit if password is required -->
<?php if ( post_password_required() ): ?>
	return;
<?php endif; ?>

<!-- print the name of the page when in debug mode -->
<?php aw_print_name('Single.php'); ?>

		<div id="single-content">

<!-- The Loop -->
<?php if ( have_posts() ) : ?>
	<?php while ( have_posts() ) : ?>
			<h1><?php the_post(); ?></h1>
			<?php the_title(); ?>
			<?php the_content(); ?>
			<?php the_tags(); ?></br>
	<?php endwhile; ?>
<?php endif; ?>

<!-- navigation links -->
<?php previous_post_link(); ?> <?php next_post_link(); ?>
</div>
<!-- Add comments to template -->
<?php if ( comments_open() || get_comments_number() ) : ?>
	<?php comments_template(); ?>
<?php endif; ?>


<?php get_footer(); ?>
