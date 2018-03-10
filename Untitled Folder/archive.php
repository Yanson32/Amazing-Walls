<?php get_header(); ?>
<?php get_sidebar( 'primary' ); ?>

<!-- print the name of the page when in debug mode -->
<?php aw_print_name('archive.php'); ?>

<?php
// The Query
$args = array('post_type' => array('post', 'photo', 'photoalbum', 'video'));
$the_query = new WP_Query( $args );


// The Loop
if ( $the_query->have_posts() ) 
{
	while( $the_query->have_posts() ) 
	{
		$the_query->the_post();
		get_template_part('/Templates/Parts/post');
	}
	
	/* Restore original Post Data */
	wp_reset_postdata();
} 
else 
{
	// no posts found
	echo "No Posts Found";
}
?>
<div style="clear:left"></div>

<!-- Create post navigation menu -->
<nav class="post_navigation_menu post_navigation_menu_color">
   <?php 	
			amazing_walls_numeric_posts_nav($the_query); 
	?>
</nav>
</br>
</br>
<?php get_footer(); ?>
