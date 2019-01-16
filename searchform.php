
  <form role="search" method="get" class="searchform group" action="<?php echo home_url( '/' ); ?>">

    <!-- Create a searchable text field -->
    <input type="search" class="search-field"
    placeholder="<?php echo esc_attr_x( 'Search', 'placeholder' ) ?>"
    value="<?php echo get_search_query() ?>" name="s"
    title="<?php echo esc_attr_x( 'Search for:', 'label', 'custom') ?>" />

    <!-- Create a dropdownl list of post types -->
    <select name="aw_post_search_filter">
      <option value="All" <?php echo aw_selected("All"); ?>>All</option>
      <option value="post" <?php echo aw_selected("post"); ?>>Post</option>
    <?php foreach(aw_get_all_custom_post_types() as $type)
    {

        $lable = ucfirst($type);
        echo '<option value="'.$type.'" '.aw_selected($type).'>'.$lable.'</option>';
    }
    ?>
    </select>


    <!-- Create a submit button -->
    <input id="searchform_submit" class="Button ButtonColor" type="submit" value="Submit">
  </form>


  <!-- add selected attribute to the currently selected option -->
  <?php function aw_selected($type)
    {
      if($_GET['aw_post_search_filter'] == $type)
        return 'selected="selected"';

      return '';
    }
?>
