<?php get_header(); ?>
<?php get_sidebar( 'primary' ); ?>

<!-- print the name of the page when in debug mode -->
<?php aw_print_name('archive-video.php'); ?>

<!-- The Loop -->
<div class="Body">
  <?php get_template_part('/Templates/Parts/post header'); ?>
  <main id="index-content" class="aw_group">
    <?php if(is_search()): ?>
      <h1 class="search-title">
        <?php echo $wp_query->found_posts; ?> <?php _e( 'Results For', 'locale' ); ?>: "<?php the_search_query(); ?>"
      </h1>
    <?php endif; ?>

    <?php if ( have_posts() ) : ?>
      <?php while ( have_posts() ) : ?>
        <?php the_post(); ?>
        <div id="post-<?php the_ID(); ?>" <?php post_class('archive_single_post clearfix'); ?> >

          <!-- get the defined width and height of the post featured image -->
          <?php $image_width = wp_get_additional_image_sizes()['aw_video_post_thumbnail']['width']; ?>
          <?php $image_height = wp_get_additional_image_sizes()['aw_video_post_thumbnail']['height']; ?>

        	<!-- Permalink of post -->
        	<?php $thumb_link =  get_permalink(); ?>

        	<!-- Alt text set to image title if available -->
        	<?php $alt_text = get_the_title(); ?>

        	<!-- Get the featured image url -->
        	<?php $image = aw_the_featured_image_url(get_the_ID(), $image_width, $image_height); ?>

        	<a href="<?php echo $thumb_link; ?>"><img class="post-thumbnail" src="<?php echo $image;?>" style="width:<?php echo $image_width; ?>; height:<?php echo $image_height; ?>" alt="<?php echo $alt_text; ?>"></a>

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
