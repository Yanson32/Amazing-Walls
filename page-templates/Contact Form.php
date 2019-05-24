<?php
	/*
	*	Template Name: Contact
	*/
?>

<?php get_header(); ?>
<!-- print the name of the page when in debug mode -->
<?php aw_print_name('Contact.php Page Template'); ?>
<?php get_template_part('/Templates/Parts/post header'); ?>
<div id="row_2">
  <div id="row_2_column_1" class="">
    <main class="clearfix">
      <?php if ( have_posts() ) : ?>
        <?php while ( have_posts() ) : ?>
          <?php the_post(); ?>
         <?php get_template_part('/Templates/Parts/post'); ?>
        <?php endwhile; ?>
      <?php endif; ?>
    </main>

    <!-- Create page footer -->
    <?php get_footer(); ?>
  </div>
  <div id="row_2_column_2" class="">
    <?php get_sidebar( 'primary' ); ?>
  </div>
</div>
