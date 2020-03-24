<?php function aw_photo_meta_box_markup()
{
?>
  <style> .media-upload h2 { font-weight: bold; } </style>

  <script>
  ( function( $ ) {

     $(document).ready(

         function()
         {
               $('#upload_image_button').click(
                   function()
                   {
                       tb_show('', 'media-upload.php?post_id=<?php  echo $post->ID; ?>&type=image&amp;TB_iframe=true');
                       return false;
                   }
               );
         }
     );

  } ) ( jQuery );
  </script>

  <div class="media-upload">
      <h2>Upload Media</h2>
      <table>
         <tr valign="top">
            <td><input id="upload_image_button" type="button" value="Upload Media"></td>
         </tr>
      </table>
  </div>
  <?php
}


/********************************************************************//**
*	@brief save the metadata for the location meta box
************************************************************************/
function aw_save_photo_meta( $post_id, $post )
{

}
add_action( 'save_post', 'aw_save_photo_meta', 1, 2 );

function admin_scripts()
{
   wp_enqueue_script('media-upload');
   wp_enqueue_script('thickbox');
}

function admin_styles()
{
   wp_enqueue_style('thickbox');
}

add_action('admin_print_scripts', 'admin_scripts');
add_action('admin_print_styles', 'admin_styles');
