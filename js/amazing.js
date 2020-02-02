function selectionChangedUploadForm()
{
    document.getElementById('aw_featured_image_upload_container').style.display = 'none';
    document.getElementById("aw_photo_upload").multiple = true;
    var e = document.getElementById("upload_post_type");
    var strUser = e.options[e.selectedIndex].value;
    if(strUser == "photoalbum")
    {
        document.getElementById('aw_featured_image_upload_container').style.display = 'block';
    }
    else if(strUser == "video")
    {
        document.getElementById('aw_featured_image_upload_container').style.display = 'block';
        document.getElementById("aw_photo_upload").multiple = false;
    }

}

function taxFilterSubmitEvent(event)
{
  event.preventDefault();
}

