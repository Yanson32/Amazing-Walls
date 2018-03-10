<?php
	get_header();
	get_sidebar( 'primary' );
?>

<!-- print the name of the page when in debug mode -->
<?php aw_print_name('Single-photoalbum.php'); ?>
<?php //Show album download link ?>
<?php if(is_user_logged_in() && aw_has_field("Download")) { ?>
	<div id="single_gallery_button_div">
		<a class="Button ButtonColor" href=<?php echo amazing_walls_get_custom_field("Download"); ?> download>Download</a>
	</div>
<?php }?>

<div class="single_gallery_image_div">


	<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : ?>
			<?php the_post(); ?>
			<?php the_title(); ?>
			<?php the_content(); ?>
		<?php endwhile; ?>
	<?php endif; ?>

	<?php if ( comments_open() || get_comments_number() ) : ?>
		<?php comments_template(); ?>
	<?php endif; ?>
	 	<?php
  	// Make sure the post has a gallery in it
 	// if(has_shortcode( $post->post_content, 'gallery' ) )
	// {
  //
  //   	echo do_shortcode('[gallery]');
	// }
//echo the_content();

    /*//Retrieve all galleries of this post
 	$galleries = get_post_galleries_images( $post );

	//Loop through all galleries found
	foreach( $galleries as $gallery )
	{

        //Loop through each image in each gallery
		foreach( $gallery as $image )
		{
			echo "<div class=gallery_image><a href=$image ><image class=thumbnail src=$image></a></div>";

		}

	}*/
      ?>

</div>
<div style="clear:left"></div>
<nav class="post_navigation_menu">
   <?php wpbeginner_numeric_posts_nav(); ?>
</nav>
<?php get_footer(); ?>
