<?php
/*
Template Name: Tag Template
*/
?>


<?php get_header(); ?>
<?php get_sidebar( 'primary' ); ?>


<!-- print the name of the page when in debug mode -->
<?php aw_print_name('tag.php'); ?>


<!-- The Loop -->
<main id="index-content" class="group">
  <li>
    <?php
      foreach(get_tags() as $tag)
      {
        echo '<br>';
        $tag_link = get_tag_link( $tag->term_id );
        echo '<li><a Class="Button ButtonColor" href="'.$tag_link.'">'.$tag->name.'</a></li>';
      }
    ?>
  </li>
</main>


<!-- Add comments to template -->
 <?php if ( comments_open() || get_comments_number() ) : ?>
   <?php comments_template(); ?>
 <?php endif; ?>


<!-- Create post navigation menu -->
<nav class="post_navigation_menu post_navigation_menu_color">
  <?php global $wp_query; amazing_walls_numeric_posts_nav($wp_query, "Previous", "Next"); ?>
</nav>

<!-- Create page footer -->
<?php get_footer(); ?>
