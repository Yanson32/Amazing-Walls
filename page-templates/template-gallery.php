<?php
/*
Template Name: Gallery Page
*/
?>

<?php
 
        $images = get_children( array( 'post_parent' => $post->ID, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order', 'order' => 'ASC', 'numberposts' => 999 ) ); 
/* $images is now a object that contains all images (related to post id 1) and their information ordered like the gallery interface. */
        if ( $images ) { 

                //looping through the images
                foreach ( $images as $attachment_id => $attachment ) {
                ?>

                            <?php /* Outputs the image like this: <img src="" alt="" title="" width="" height="" /> */  ?> 
                            <?php echo wp_get_attachment_image( $attachment_id, 'full' ); ?>

                            This is the Caption:<br/>
                            <?php echo $attachment->post_excerpt; ?>

                            This is the Description:<br/>
                            <?php echo $attachment->post_content; ?>

                <?php
                }
        }
 ?>
<?php get_footer(); ?>