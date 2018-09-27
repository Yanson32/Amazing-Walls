<?php
/*
Template Name: Upload
*/
?>
<?php get_header(); ?>

<div class="SearchFormContainer" style="padding:5px">
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
    <select id="upload_post_type" onchange="selectionChanged()">
       <option value="photo">Photo</option>
       <option value="photoalbum">Photo Album</option>
       <option value="video">Video</option>
    </select>
    <br>
    <label class="AWLable" for="aw_photo_upload">Upload</label>
    <input type="file" name="aw_photo_upload" id="aw_photo_upload">
    <br>
    <label class="AWLable" for="aw_upload_submit_button"></label>
    <button id="aw_upload_submit_button" class="Button ButtonColor" type="submit">Submit</button>
    <?php //wp_insert_post; ?>
  </form>
</main>

<!-- Create page footer -->
<?php get_footer(); ?>

<script type="text/script">

</script>
