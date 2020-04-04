<?php require_once(get_template_directory().'/includes/config.php'); ?>
<?php get_header(); ?>
<!-- print the name of the page when in debug mode -->
<?php aw_print_name('single-video.php'); ?>
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

			<?php $custom_fields = get_post_custom_values('Video'); ?>

      <?php $custom_fields = apply_filters('aw_photo_filter', $custom_fields); ?>
			<?php if(is_array($custom_fields)): ?>
                    
					<?php
                    $i = -1;
                    foreach ($custom_fields as $value)
					{   
                        $i += 1;
                        echo 'loop = '.$i;
                        $url = wp_get_attachment_url($value);
                        $previous_video;
                        $next_video;
                        $left_arrow_id = 'video_gallery_left_arrow_'.$value;
                        $right_arrow_id = 'video_gallery_right_arrow_'.$value;
                        
                        
                        if($i < sizeof($custom_fields) - 1)
                        {
                            $next_video = $custom_fields[$i + 1];
                        }
                        
                        echo '<div class="video_gallery_item" id="video-container-'.$value.'">';
                            echo '<video id="video-'.$value.'" controls loop>';
							echo '<source src="'.$url.'">';
                            echo '</video>';
                        echo '</div>';
					}
                    $left_arrow = get_template_directory_uri()."/assets/images/arrow-left.png";
                    $right_arrow = get_template_directory_uri()."/assets/images/arrow-right.png";
            echo '<img onclick=arrowClicked("video_gallery_left_arrow"); id="video_gallery_left_arrow" style="width:100px; height:100px;" value="'.$previous_video.'" src='.$left_arrow.'>';
            echo '<img onclick=arrowClicked("video_gallery_right_arrow"); id="video_gallery_right_arrow" style="width:100px; height:100px;" value="'.$next_video.'" src='.$right_arrow.'>';
            ?>
			<?php endif; ?>
    

    </main>

    <!-- The Loop -->
    <?php if ( have_posts() ) : ?>
      <?php while ( have_posts() ) : ?>
        <?php the_post(); ?>
        <?php the_content() ?>
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

<script>

    let current_video_id = 0;
    let vid_array = <?php echo json_encode($custom_fields); ?>;

    /*********************************************************************
    *   @breif  This code will run on page load.
    *********************************************************************/
    jQuery(document).ready(function($) 
    {
        //Set global current video variable
        if(vid_array.length > 0)
        {
            current_video_id = vid_array[0];
        }

        setCurrentVideo(current_video_id);

        //The left arrow should not be displayed.
        document.getElementById("video_gallery_left_arrow").style.display = "none";

        //If only one video is available 
        //The right arrow is not needed.
        if(vid_array.length == 1)
        {
            document.getElementById("video_gallery_right_arrow").style.display = "none";
        }
    });

    /*********************************************************************
    *   @breif  Set a video to be displayed in the web page.
    *   @param  The id of the video to be displayed.
    *   @param  If true the video will be set to play.
    *********************************************************************/
    function setCurrentVideo(video, play = false)
    {
       //Set all videos to hidden and pause
       for(i = 0; i < vid_array.length; ++i)
        {
            let id = "video-container-";
            id += vid_array[i];
            document.getElementById(id).style.display = "none";
            let video_id = "video-";
            video_id += vid_array[i];
            document.getElementById(video_id).pause();
        }

        let id = "video-container-";
        id += video;
        let element = document.getElementById(id);
        element.style.display = "block";

        if(play)
        {
            //Set the video to play
            let video_id = "video-";
            video_id += current_video_id;
            document.getElementById(video_id).play();
        }
        
    }

    /*********************************************************************
    *   @breif  Event handler for the arrow controls.
    *   @param  The id of the arrow that was clicked.
    *********************************************************************/
    function arrowClicked(param_id)
    {
        let isCurrentVideoSet = false;
        for(i = 0; i < vid_array.length; ++i)
        {
            if(vid_array[i] == current_video_id)
            {
                //Right arrow clicked
                if(param_id == "video_gallery_right_arrow")
                {
                    //Set to the next video
                    if(((i + 1) < vid_array.length) && !isCurrentVideoSet)
                    {
                        document.getElementById("video_gallery_left_arrow").style.display = "inline-block";
                        current_video_id = vid_array[i + 1];
                        setCurrentVideo(current_video_id, true);
                        document.getElementById("video_gallery_left_arrow").style.display = "inline-block";
                        isCurrentVideoSet = true;
                    }

                    //Hide the arrow
                    if((i) == (vid_array.length - 1))
                    {
                        document.getElementById("video_gallery_right_arrow").style.display = "none";
                    }


                }
                //Left arrow clicked
                else
                {
                    //Set the left arrow to hidden when the first video is being displayed.
                    if((i - 1) == 0)
                        document.getElementById("video_gallery_left_arrow").style.display = "none";

                    //If there is more than 1 video display right arrow
                    if(vid_array.length > 1)
                        document.getElementById("video_gallery_right_arrow").style.display = "inline-block";
                    
                    
                    //If there is a previous video
                    if((i - 1) >= 0)
                    {
                        //Set the video
                        current_video_id = vid_array[i - 1];
                        setCurrentVideo(current_video_id, true);
                    }
                }
            }
        }
    }
</script>

