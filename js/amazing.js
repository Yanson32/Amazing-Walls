function selectionChangedUploadForm()
{
  document.getElementById('photo_upload_form').style.display = 'none';
  document.getElementById('photoalbum_upload_form').style.display = 'none';
  document.getElementById('video_upload_form').style.display = 'none';
  document.getElementById('mobile_upload_form').style.display = 'none';
  console.log(document.getElementById('upload_post_type').value);
  document.getElementById(document.getElementById('upload_post_type').value).style.display = 'block';
}

function taxFilterSubmitEvent(event)
{
  event.preventDefault();
}
