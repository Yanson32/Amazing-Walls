<?php get_header(); ?>
<?php get_sidebar( 'primary' ); ?>

<!-- print the name of the page when in debug mode -->
<?php aw_print_name('Single.php'); ?>

<!-- get password if post is locked -->
<?php if ( post_password_required() ): ?>
	<?php get_the_password_form(); ?>
<?php endif; ?>
<!-- <?php wp_get_attachment_image(); ?> -->
	<div id="single-body" class="Body group">
		<?php get_template_part('/Templates/Parts/post header'); ?>

		<main>
			<!-- The Loop -->
			<?php if ( have_posts() ) : ?>
				<?php while ( have_posts() ) : ?>
						<?php the_post(); ?>

						<div id="single-content">
						<!-- Don't show the title when password protected -->
						<?php if(!post_password_required()): ?>
							<h1 class=" PrimaryTitleColor"><?php the_title(); ?></h1>
						<?php endif; ?>

						<?php if(!is_page(get_the_ID()) && !post_password_required()): ?>
							<!-- <div class="Tag TagColor"> -->
								<div style="">
									<?php show_taxonomy('post_tag', 'Tags'); ?>
									<?php show_taxonomy('category', 'Category');?>
									<?php show_taxonomy('People', 'People'); ?>
									<?php show_taxonomy('Resolution', 'Resolution'); ?>
									<?php show_taxonomy('Aspect Ratio', 'Aspect Ratio'); ?>
									<?php $post_meta = get_post_meta(get_the_ID()) ?>
								</div>
							</div>
						<!-- <?php endif; ?> -->
						<div style="clear:both"></div>
						<!-- <?php if(get_post_type() == 'photo' || get_post_type() == 'mobile'): ?>
							<a href=<?php the_post_thumbnail_url( 'full' ); ?> alt="<?php echo get_the_title(get_the_ID()); ?>"><?php the_post_thumbnail('full'); ?></a>
						<?php endif; ?> -->
						<!-- The main content of the post -->

						<?php $custom_fields = get_post_custom_values('Photo'); ?>
						<?php foreach($custom_fields as $value)
						{
							$url = wp_get_attachment_url($value);

							echo '<a href="'.$url.'"><img src="'.$url.'"></a>';
						}
							?>

						<?php the_content(); ?>

				<?php endwhile; ?>
			<?php endif; ?>
		</main>
			</br>


		<!-- navigation links -->
		<div class="nav-links Button ButtonColor" style="float:left">
			<?php previous_post_link('%link', 'Previous'); ?>
		</div>
		<div class="nav-links Button ButtonColor" style="float:right">
			<?php next_post_link('%link', 'Next'); ?>
		</div>

		<!-- Add comments to template -->
		<div class="comments group">
			<hr style="width:100%">
			<?php if ( comments_open() || get_comments_number() ) : ?>
				<?php comments_template(); ?>
			<?php endif; ?>
		</div>
			<div style="clear:both"></div>
			<?php get_footer(); ?>
	</div>
</div>
