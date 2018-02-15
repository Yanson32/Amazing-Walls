<?php
	/*
	*	Template Name: Contact
	*/
?>


<!-- Start the loop -->
<?php get_header(); ?>
<?php get_sidebar( 'primary' ); ?>

<!-- print the name of the page when in debug mode -->
<?php aw_print_name('contact.php'); ?>

<div id="ContactForm">
<table>
	<tr>
		<td><lable>Name</lable></td>
		<td><input type="textfield" name="name"></td>
	</tr>
	<tr>
		<td><lable>E-mail</lable></td>
		<td><input type="email" name="email"></td>
	</tr>
	<tr>
		<td><lable>Comment</lable></td>
		<td><textarea></textarea></td>
	</tr>
</table>
</div>
<!-- Create post navigation menu -->
<div style="clear:left"></div>
<nav class="post_navigation_menu">
   <?php amazing_walls_numeric_posts_nav(); ?>
</nav>
</br>
</br>
<?php get_footer(); ?>
