
  <form role="search" method="get" class="searchform group" action="<?php echo home_url( '/' ); ?>">

    <!-- Create a searchable text field -->
    <input type="search" class="search-field"
    placeholder="<?php echo esc_attr_x( 'Search', 'placeholder' ) ?>"
    value="<?php echo get_search_query() ?>" name="s"
    title="<?php echo esc_attr_x( 'Search for:', 'label', 'custom') ?>" />

    <!-- Create a dropdownl list of post types -->
    <?php $select_value = (isset($_GET['aw_post_search_filter']))?$_GET['aw_post_search_filter']: '' ?>
    <select name="aw_post_search_filter">
      <option value="All" <?php echo selected($select_value, "All"); ?>>All</option>
      <option value="post" <?php echo selected($select_value, "post"); ?>>Post</option>
      <?php foreach(aw_get_all_custom_post_types() as $type)
      {

          $lable = ucfirst($type);
          echo '<option value="'.$type.'" '.selected($select_value, $type).'>'.$lable.'</option>';
      }
      ?>
    </select>


    <!-- Create a submit button -->
    <input id="searchform_submit" class="Button ButtonColor" type="submit" value="Submit">
  </form>
