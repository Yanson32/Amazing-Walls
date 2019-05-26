<?php get_header(); ?>
<!-- print the name of the page when in debug mode -->
<?php aw_print_name('archive-photo.php'); ?>
<?php get_template_part('/Templates/Parts/post header'); ?>
<div id="row_2">
  <div id="row_2_column_1" class="">
    <main class="clearfix">
      <?php if(is_search()): ?>
        <h1 class="search-title">
          <?php echo $wp_query->found_posts; ?> <?php _e( 'Results For', 'locale' ); ?>: "<?php the_search_query(); ?>"
        </h1>
      <?php endif; ?>
      <?php if ( have_posts() ) : ?>
        <?php while ( have_posts() ) : ?>
          <?php the_post(); ?>
          <div id="post-<?php the_ID(); ?>" <?php post_class('archive_single_post'); ?> >

            <!-- get the defined width and height of the post featured image -->
            <?php $image_width = wp_get_additional_image_sizes()['aw_photo_post_thumbnail']['width']; ?>
            <?php $image_height = wp_get_additional_image_sizes()['aw_photo_post_thumbnail']['height']; ?>


            <?php if(is_search() || is_tax() || is_singular() || is_tag() || is_category()):?>
              <?php $image_width = wp_get_additional_image_sizes()['aw_thumbnail']['width']; ?>
              <?php $image_height = wp_get_additional_image_sizes()['aw_thumbnail']['height']; ?>
            <?php endif; ?>

            <!-- Permalink of post -->
            <?php $thumb_link =  get_permalink(); ?>
            <?php if ( has_post_thumbnail() ): ?>
              <a href="<?php echo $thumb_link; ?>"><?php the_post_thumbnail('photo-thumbnail'); ?></a>
            <?php else: ?>
              <a href="<?php echo $thumb_link; ?>"><img src="<?php bloginfo('template_directory'); ?>/assets/images/default-featured-image.jpg" alt="<?php the_title(); ?>" /></a>
            <?php endif; ?>

          </div>
        <?php endwhile; ?>
      <?php endif; ?>
    </main>

    <!-- Add comments to template -->
    <?php if ( comments_open() || get_comments_number() ) : ?>
      <?php comments_template(); ?>
    <?php endif; ?>

    <!-- Create post navigation menu -->
    <nav class="post_navigation_menu post_navigation_menu_color">
      <?php global $wp_query; aw_numeric_posts_nav($wp_query, "Previous", "Next"); ?>
    </nav>

    <!-- Create page footer -->
    <?php get_footer(); ?>
  </div>
  <div id="row_2_column_2" class="">
    <?php get_sidebar( 'primary' ); ?>
  </div>
</div>
