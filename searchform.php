
  <form role="search" method="get" class="searchform clearfix" action="<?php echo home_url( '/' ); ?>">

    <!-- Create a searchable text field -->
    <input type="search" class="search-field"
    placeholder="<?php echo esc_attr_x( 'Search', 'placeholder' ) ?>"
    value="<?php echo get_search_query() ?>" name="s"
    title="<?php echo esc_attr_x( 'Search for:', 'label', 'custom') ?>" />

    <!-- Create a dropdownl list of post types -->
    <?php $select_value = (isset($_GET['aw_post_search_filter']))?$_GET['aw_post_search_filter']: '' ?>
    <?php $selection_values['all'] = "all"; ?>
    <?php $selection_values['post'] = "post"; ?>
    <?php $selection_values += aw_get_all_custom_post_types(); ?>
    <?php $selection_values = apply_filters("aw_post_search_filter", $selection_values); ?>
    <select name="aw_post_search_filter">

      <?php foreach($selection_values as $type)
      {

          $lable = ucfirst($type);
          echo '<option value="'.$type.'" '.selected($select_value, $type).'>'.$lable.'</option>';
      }
      ?>
    </select>

    <!-- Create a submit button -->
    <input id="searchform_submit" class="Button ButtonColor" type="submit" value="Submit">
  </form>
