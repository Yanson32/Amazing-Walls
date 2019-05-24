<?php
/*
Template Name: Upload
*/
?>
<?php get_header(); ?>

<div id="SearchFormContainer">
  <?php get_search_form(); ?>
</div>
<hr style="width:100%; float:left">

<?php get_sidebar( 'primary' ); ?>
<h2 class="Title" >Upload </h2>
<main>
  <form id="aw_upload_form">
    <label class="AWLable" for="upload_title" >Title</label>
    <input type="text" id="upload_title">
    <br>
    <lable class="AWLable" for="upload_post_type">Post Type</lable>
    <select id="upload_post_type" onchange="selectionChangedUploadForm()">
       <option value="photo_upload_form">Photo</option>
       <option value="photoalbum_upload_form">Photo Album</option>
       <option value="video_upload_form">Video</option>
       <option value="mobile_upload_form">Mobile</option>
    </select>

    <div  id="photo_upload_form">
      <lable class="AWLable" for="aw_photo_tags">Tags:</lable>
      <input type="text" id="aw_photo_tags" name="tags"><br>
      <lable class="AWLable" for="aw_photo_people">People:</lable>
      <input type="text" id="aw_photo_people" name="people"><br>
      <label class="AWLable" for="aw_photo_upload">Upload</label>
      <input type="file" name="aw_photo_upload" id="aw_photo_upload">
    </div>

    <div id="mobile_upload_form" class="aw_post_upload_form">

    </div>

    <div id="photoalbum_upload_form" class="aw_post_upload_form">

    </div>

    <div id="video_upload_form" class="aw_post_upload_form">

    </div>
    <br>

    <br>
    <label class="AWLable" for="aw_upload_submit_button"></label>
    <button id="aw_upload_submit_button" class="Button ButtonColor" style="padding:5px" type="submit">Submit</button>
    <?php //wp_insert_post; ?>
  </form>

  <script>

  </script>

  <?php get_footer(); ?>
</main>

<!-- Create page footer -->
