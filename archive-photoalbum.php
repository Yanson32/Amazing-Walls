<!-- Function Definition -->
<!-- Start the loop -->
<?php get_header(); ?>
<?php get_sidebar( 'primary' ); ?>

<!-- print the name of the page when in debug mode -->
<?php aw_print_name('Archive Photoalbum.php'); ?>

<div class="archive_gallery_all_posts">
<?php
   if(have_posts()):
   	
   	while(have_posts()): the_post();
   ?>

		<!-- style the post -->
		<?php get_template_part('/Templates/Parts/post'); ?>
		<!-- End the loop -->
		<?php
   endwhile;
   
   
   else:
   	
   	echo '<p>No content found</p>';
   
   endif;
   ?>
</div>
<!-- Create post navigation menu -->
<div style="clear:left"></div>
<nav class="post_navigation_menu">
	<?php
		global $wp_query;
		amazing_walls_numeric_posts_nav($wp_query, "Previous Album", "Next Album"); 
	?>
</nav>
</br>
</br>
<?php
   get_footer();
   ?>

