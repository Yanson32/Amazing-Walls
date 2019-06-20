<?php get_header(); ?>
<!-- print the name of the page when in debug mode -->
<?php aw_print_name('single-photoalbum.php'); ?>
<?php get_template_part('/Templates/Parts/post header'); ?>
<div id="row_2">
  <div id="row_2_column_1" class="clearfix">

    <!-- Don't show the title when password protected -->
    <?php if(!post_password_required()): ?>
      <h1 class=" PrimaryTitleColor"><?php the_title(); ?></h1>
    <?php endif; ?>

    <!-- Display info for admin only-->
    <?php aw_admin_panel(); ?>

    <?php if(!is_page(get_the_ID()) && !post_password_required()): ?>
      <div id="taxonomies" style="font-size:15px">
        <?php
          $tax = apply_filters('aw_tax_filter', $taxonomies);
          for($i = 0; $i < sizeof($tax); $i++)
          {
            aw_show_taxonomy($tax[$i]);
          }
        ?>
      </div>
		<?php endif; ?>
		<main id="single">

    <?php $custom_fields = get_post_custom_values('Photo'); ?>
    <?php $custom_fields = apply_filters('aw_photoalbum_filter', $custom_fields); ?>
			<?php if(is_array($custom_fields)): ?>
			   <?php
				 foreach($custom_fields as $value)
				 {
					 $link = wp_get_attachment_url($value);
					 $image = wp_get_attachment_image_url($value, 'aw_thumbnail');
					 echo '<div class="thumbnail" style="margin:5px; display:inline-block;">';
					 echo '<a href="'.$link.'"><img src="'.$image.'"></a>';
					 echo '</div>';
				 }
			 ?>
		 <?php endif; ?>

		</main>

    <!-- The Loop -->
    <?php if ( have_posts() ) : ?>
      <?php while ( have_posts() ) : ?>
        <?php the_post(); ?>
        <?php the_content(); ?>
        <?php aw_posts_section(); ?>
      <?php endwhile; ?>
    <?php endif; ?>

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
