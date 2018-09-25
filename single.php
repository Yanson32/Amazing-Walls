<?php get_header(); ?>
<?php get_sidebar( 'primary' ); ?>

<!-- print the name of the page when in debug mode -->
<?php aw_print_name('Single.php'); ?>

<!-- get password if post is locked -->
<?php if ( post_password_required() ): ?>
	<?php get_the_password_form(); ?>
<?php endif; ?>
<?php wp_get_attachment_image(); ?>
	<div id="single-body" class="group">
    <?php get_search_form(); ?>

		<?php if(aw_queue_enabled()): ?>
			<?php echo '<a class="Button ButtonColor" style="display:inline-block; float:right; padding:5px" href="">Queue</a>'; ?>
		<?php endif; ?>
		<?php if(aw_download_enabled()): ?>
		<?php $file = "Download.zip"; ?>
		<?php aw_createZipFile($file); ?>
		<?php echo '<a class="Button ButtonColor" style="display:inline-block; float:right; padding:5px" href="'.$file.'">Download</a>'; ?>
		<?php endif; ?>
		<hr style="width:100%; float:left">
	<div id="single-content">

			<!-- The Loop -->
			<?php if ( have_posts() ) : ?>
				<?php while ( have_posts() ) : ?>
						<?php the_post(); ?>

						<!-- Don't show the title when password protected -->
						<?php if(!post_password_required()): ?>
							<h1 class=" PrimaryTitleColor"><?php the_title(); ?></h1>
						<?php endif; ?>

						<?php if(!is_page(get_the_ID())): ?>
							<div class="Tag TagColor">
								<?php the_tags('<ul><li class="Button ButtonColor Tag">', '</li> <li class="Button ButtonColor Tag">', '</li></ul>'); ?>
							</div>
						<?php endif; ?>

						<!-- The main content of the post -->
						<?php the_content(); ?>

						<!-- Don't show tags when password protected -->
						<?php if(!post_password_required()): ?>
						<?php endif; ?>
				<?php endwhile; ?>
			<?php endif; ?>

			</br>


		<!-- navigation links -->
		<div class="nav-links Button ButtonColor" style="float:left">
			<?php previous_post_link('%link', 'Previous'); ?>
		</div>
		<div class="nav-links Button ButtonColor" style="float:right">
			<?php next_post_link('%link', 'Next'); ?>
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
<?php
	$arr = (get_images());

	foreach($arr as $path)
	{
		echo $path;
		echo '<br>';
	}

	print_r(get_images());
?>
