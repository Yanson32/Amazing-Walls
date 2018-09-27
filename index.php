<?php get_header(); ?>

<div class="SearchFormContainer" style="padding:5px">
  <?php get_search_form(); ?>
</div>
<hr style="width:100%; float:left">

<?php get_sidebar( 'primary' ); ?>


<!-- print the name of the page when in debug mode -->
<?php aw_print_name('index.php'); ?>

<!-- The Loop -->
<div class="Body" style="float:left; width:78%">
  <main id="index-content" class="group">


    <?php if(is_search()): ?>
      <h1 class="search-title">
        <?php echo $wp_query->found_posts; ?> <?php _e( 'Search Results Found For', 'locale' ); ?>: "<?php the_search_query(); ?>"
      </h1>
    <?php endif; ?>

    <?php if ( have_posts() ) : ?>
      <?php while ( have_posts() ) : ?>
        <?php the_post(); ?>
        <?php get_template_part('/Templates/Parts/post'); ?>
      <?php endwhile; ?>
    <?php endif; ?>
  </main>


  <!-- Add comments to template -->
   <?php if ( comments_open() || get_comments_number() ) : ?>
     <?php comments_template(); ?>
   <?php endif; ?>


  <!-- Create post navigation menu -->
  <nav class="post_navigation_menu post_navigation_menu_color">
    <?php global $wp_query; amazing_walls_numeric_posts_nav($wp_query, "Previous", "Next"); ?>
  </nav>
</div>
<!-- Create page footer -->
<?php get_footer(); ?>
