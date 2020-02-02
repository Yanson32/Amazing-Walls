<?php
/*
Template Name: Upload
*/
?>

<?php 
if( 'POST' == $_SERVER['REQUEST_METHOD']  ) 
{
	if($_POST['upload_post_type'] == 'photo'):
		aw_create_photo_mobile('Photo');
    elseif($_POST['upload_post_type'] == 'mobile'):
        aw_create_photo_mobile('Photo');
	elseif($_POST['upload_post_type'] == 'photoalbum'):
		aw_create_photo_album();
    elseif($_POST['upload_post_type'] == 'video'):
        aw_create_video();
	endif;
}
?>
<?php get_header(); ?>
<!-- print the name of the page when in debug mode -->
<?php aw_print_name('Upload.php Page Template'); ?>
<?php get_template_part('/Templates/Parts/post header'); ?>
<div id="row_2">
  <div id="row_2_column_1" class="">
    <main class="clearfix">
      <h2>Upload</h2>
      <form id="aw_upload_form" method="post" enctype="multipart/form-data" name="front_end_upload">
		<?php wp_nonce_field( 'aw_image_upload', 'aw_image_upload_nonce' ); ?>
        <label class="AWLable" for="upload_title" >Title</label>
        <input type="text" id="upload_title" name="upload_title" required>
        <br>
        <label class="AWLable" for="upload_post_type">Post Type</label>
        <select id="upload_post_type" name="upload_post_type" onchange="selectionChangedUploadForm();">
           <option value="photo">Photo</option>
           <option value="photoalbum">Photo Album</option>
           <option value="video">Video</option>
           <option value="mobile">Mobile</option>
        </select><br>
		<label class="AWLable" for="upload_tags">Tags</label>
		<input type="text" id="upload_tags" name="upload_tags" placeholder="Comma seperated list"><br>
		<label class="AWLable" for="people_upload">People:</label>
        <input type="text" id="people_upload" name="people_upload[]" placeholder="Comma seperated list"><br>
		<label class="AWLable" for="category_upload">Category:</label>
        <input type="text" id="category_upload" name="category_upload" placeholder="Comma seperated list"><br>
        <label class="AWLable" for="alt_text_upload">Alt Text:</label>
        <input type="text" id="alt_text_upload" name="alt_text_upload" required><br>
        <label class="AWLable" for="aw_upload_visibility">Visibility</label>
        <select id="aw_upload_visibility" name="aw_upload_visibility" required>
            <option value='publish'>Public</option>
            <option value='private'>Private</option>
        </select>
        <label class="AWLable" for="aw_upload_password">Password</label>
        <input id="aw_upload_password" name='aw_upload_password' placeholder="Enter Password" type="password">
        <label class="AWLable" for="aw_upload_password_confirm">Password</label>
        <input id="aw_upload_password_confirm" name='aw_upload_password_confirm' placeholder="Enter Password" type="password">
        <label class="AWLable" for="aw_photo_upload">Upload</label>
        <input type="file" name="aw_photo_upload[]"  multiple="multiple" id="aw_photo_upload">
        <div id="aw_featured_image_upload_container">
            <label class="AWLable" for="aw_featured_image_upload">Featured Image:</label>
            <input type="file" name="aw_featured_image_upload" id="aw_featured_image_upload">
        </div>
        <label class="AWLable" for="aw_upload_submit_button"></label>
        <button id="aw_upload_submit_button" class="Button ButtonColor" style="padding:5px" type="submit" name="Upload" >Submit</button>
      </form>
      <div id="admin_upload_info">
      <?php if(current_user_can('administrator')): ?>
  	   <span style="color:red;font-size:20px">Max upload size: <?php echo ini_get("upload_max_filesize");?></span><br>
	    <?php else: ?>
        <?php echo 'you nedd to be an admin'; ?>
      <?php endif; ?>
      </div>
    </main>

    <!-- Create page footer -->
    <?php get_footer(); ?>
  </div>
  <div id="row_2_column_2" class="">
    <?php get_sidebar( 'primary' ); ?>
  </div>
</div>

<script>
    jQuery(document).ready(function($) {
    selectionChangedUploadForm();
});
</script>
