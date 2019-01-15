<?php
/*
Template Name: Tag Template
*/
?>


<?php get_header(); ?>
<?php get_sidebar( 'primary' ); ?>


<!-- print the name of the page when in debug mode -->
<?php aw_print_name('tag.php'); ?>

<?php $alphabet = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'); ?>

<!-- The Loop -->
<main id="index-content" class="group">
  <div class="clearfix" style="float:left; width:70%;">
    <ul id="aw_tag_list_alphabetical" onclick="aw_letter_selected(event, 'A');">
      <?php foreach($alphabet as $letter)
      {
        echo '<li class="Button ButtonColor">'.$letter.'</li>';
      }
      ?>
    </ul>
  </div>

  <?php
    foreach($alphabet as $letter)
    {
      echo '<div id="aw_tags_'.$letter.'" style="display:none">';
        foreach(get_tags() as $tag)
        {
          if(empty($tag->name))
            return;

          if(strtoupper($tag->name[0]) == $letter)
          {
            echo '<br>';
            $tag_link = get_tag_link( $tag->term_id );
            echo '<li><a Class="Button ButtonColor" href="'.$tag_link.'">'.$tag->name.'</a></li>';
          }
        }
      echo '</div>';
    }
?>
</main>


<!-- Add comments to template -->
 <?php if ( comments_open() || get_comments_number() ) : ?>
   <?php comments_template(); ?>
 <?php endif; ?>


<!-- Create post navigation menu -->
<nav class="post_navigation_menu post_navigation_menu_color">
  <?php global $wp_query; aw_numeric_posts_nav($wp_query, "Previous", "Next"); ?>
</nav>

<script>
function aw_letter_selected(event, letter)
{
  var element = document.getElementById("aw_tags_" + letter);
  if (element.style.display === "none")
  {
    element.style.display = "inline-block";
  }
  else
  {
    element.style.display = "none";
  }
}
</script>
<!-- Create page footer -->
<?php get_footer(); ?>
