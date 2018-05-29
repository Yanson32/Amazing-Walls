<?php get_header(); ?>
<?php get_sidebar( 'primary' ); ?>

<!-- Exit if password is required -->
<?php if ( post_password_required() ): ?>
	<?php return; ?>
<?php endif; ?>

<!-- print the name of the page when in debug mode -->
<?php aw_print_name('Single.php'); ?>

<div id="single-body" class="group">
	<div id="single-content">
			<!-- The Loop -->
			<?php if ( have_posts() ) : ?>
				<?php while ( have_posts() ) : ?>
						<?php the_post(); ?>
						<h1><?php the_title(); ?></h1>
						<?php the_content(); ?>
						<div class="Tag TagColor">
							<?php the_tags(null, ' '); ?>
						</div>
				<?php endwhile; ?>
			<?php endif; ?>

			</br>
	
		<!-- navigation links -->
		<div class="nav-links">
			<?php previous_post_link(); ?>
			<?php next_post_link(); ?>
		</div>
	</div>
	<!-- Add comments to template -->
	<div class="comments group">
		<hr style="width:100%">
		<?php if ( comments_open() || get_comments_number() ) : ?>
			<?php comments_template(); ?>
		<?php endif; ?>
	</div>
</div>
<div>
	<?php get_footer(); ?>
</div>
