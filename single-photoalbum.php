<?php get_header(); ?>
<?php get_sidebar( 'primary' ); ?>

<!-- print the name of the page when in debug mode -->
<?php aw_print_name('Single-photoalbum.php'); ?>

<!-- get password if post is locked -->
<?php if ( post_password_required() ): ?>
	<?php get_the_password_form(); ?>
<?php endif; ?>

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

						<!-- Display info for admin only-->
						<?php aw_admin_panel(); ?>

						<?php if(!is_page(get_the_ID()) && !post_password_required()): ?>
							<!-- <div class="Tag TagColor"> -->
								<?php aw_show_taxonomy('post_tag', 'Tags'); ?>
								<?php aw_show_taxonomy('category', 'Category');?>
								<?php aw_show_taxonomy('People', 'People'); ?>
								<?php aw_show_taxonomy('Resolution', 'Resolution'); ?>
								<?php $post_meta = get_post_meta(get_the_ID()) ?>
							</div>
						<!-- <?php endif; ?> -->
						<div style="clear:both"></div>

						<?php $custom_fields = get_post_custom_values('Photo'); ?>
						<?php if(is_array($custom_fields)): ?>
							<?php
								foreach($custom_fields as $value)
								{
									$link = wp_get_attachment_url($value);
									$image = wp_get_attachment_image_url($value);
									echo '<div class="photo_album_item" style="margin:5px; display:inline-block;">';
									echo '<a href="'.$link.'"><img src="'.$image.'"></a>';
									echo '</div>';
								}
							?>
						<?php endif; ?>
						<div style="clear:both"></div>
						<?php the_content(); ?>
						<?php aw_posts_section(); ?>
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
