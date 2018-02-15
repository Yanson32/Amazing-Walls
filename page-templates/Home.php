<?php
   /*
   *   Template Name: Home Page
   */
?>

<!-- Function Definition -->
<?php

   function print_post()
   {
   	if( has_post_thumbnail() ) :
		//the_post_thumbnail();
		$the_title = the_title();
		$alt_text = the_title();
   		$thumb_link =  get_attachment_link( get_post_thumbnail_id() );
   		echo "<a href=$thumb_link alt=$the_title title=$alt_text>";
		echo the_post_thumbnail();
		echo "</a>";
   	endif;
   }
?>
<!-- Start the loop -->
<?php get_header(); ?>
<?php get_sidebar( 'primary' ); ?>
<p>Home Template</p>
<div id="index_all_posts" class="archive_all_posts">
	<?php 	if(have_posts()): 
			while(have_posts()): the_post();?>
	
				<!-- style the post -->
				<div id="index_single_post" class="archive_single_post"><?php print_post();?></div>
   	
				<!-- End the loop -->
   			<?php 	endwhile; 
      
      		 else: ?>
      			<p>No content found</p>
      		<?php endif; ?>

</div>


<!-- Create post navigation menu -->
<div style="clear:left"></div>
<nav class="post_navigation_menu">
   <?php amazing_walls_numeric_posts_nav(); ?>
</nav>
</br>
</br>
<?php get_footer(); ?>