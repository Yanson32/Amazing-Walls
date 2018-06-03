<?php get_header(); ?>
<?php get_sidebar( 'primary' ); ?>

<!-- print the name of the page when in debug mode -->
<?php aw_print_name('Single.php'); ?>

<!-- get password if post is locked -->
<?php if ( post_password_required() ): ?>
	<?php get_the_password_form(); ?>
<?php endif; ?>

<div id="single-body" class="group">
	<div id="single-content">
			<!-- The Loop -->
			<?php if ( have_posts() ) : ?>
				<?php while ( have_posts() ) : ?>
						<?php the_post(); ?>

						<!-- Don't show the title when password protected -->
						<?php if(!post_password_required()): ?>
							<h1><?php the_title(); ?></h1>
						<?php endif; ?>
						<?php the_content(); ?>

						<!-- Don't show tags when password protected -->
						<?php if(!post_password_required()): ?>
							<div class="Tag TagColor">
								<?php the_tags('<ul class="tags"><li>', '</li><li>', '</li></ul>'); ?>
							</div>
						<?php endif; ?>
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
