<?php
/*
Template Name: Tag Template
*/
?>

<?php $alphabet = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'); ?>

<?php get_header(); ?>
<!-- print the name of the page when in debug mode -->
<?php aw_print_name('tag.php'); ?>
<?php get_template_part('/Templates/Parts/post header'); ?>
<div id="row_2">
  <div id="row_2_column_1" class="">
    <main class="clearfix">
      <!-- Create a bunch of links for each letter of the alphabet -->
      <div class="clearfix">
        <ul id="aw_tag_list_alphabetical" >
          <?php foreach($alphabet as $letter)
          {
            echo '<li id="aw_tags_button_'.$letter.'" class="Button ButtonColor" onclick="aw_letter_selected(event, &quot;'.$letter.'&quot;);">'.$letter.'</li>';
          }
          ?>
        </ul>
      </div>

      <?php
        foreach($alphabet as $letter)
        {
          echo '<div id="aw_tags_'.$letter.'" style="display:none;">';
            echo '<ul class="aw_tag_list">';
              foreach(get_tags() as $tag)
              {
                if(empty($tag->name))
                  return;


                if(strtoupper($tag->name[0]) == $letter)
                {
                  $tag_link = get_tag_link( $tag->term_id );
                  echo '<li><a Class="Button ButtonColor" href="'.$tag_link.'">'.$tag->name.'</a></li>';
                }

              }
            echo '</ul>';
          echo '</div>';
        }
    ?>
    </main>

    <!-- Create page footer -->
    <?php get_footer(); ?>
  </div>
  <div id="row_2_column_2" class="">
    <?php get_sidebar( 'primary' ); ?>
  </div>
</div>

<script>
/**********************************************************************************//**
* @Brief  Event handler for userer selected letter
**************************************************************************************/
function aw_letter_selected(event, letter)
{
  //Hide all tags
  let arr = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];

  for(let i = 0; i < arr.length; ++i)
  {
    var element = document.getElementById("aw_tags_" + arr[i]);
    element.style.display = "none";
  }

  //Remove highlight from all buttons
  for(let i = 0; i < arr.length; ++i)
  {
    let button = document.getElementById("aw_tags_button_" + arr[i]);
    button.classList.remove("current-menu-item");
  }
  //Hilight selected button
  let button = document.getElementById("aw_tags_button_" + letter);
  button.classList.add("current-menu-item");

  //Show the selected tags
  var element = document.getElementById("aw_tags_" + letter);
  if (element.style.display === "none")
  {
    element.style.display = "block";
  }
  else
  {
    element.style.display = "none";
  }
}
</script>
