
  <form role="search" method="get" class="searchform group" action="<?php echo home_url( '/' ); ?>">
    <input type="search" class="search-field"
    placeholder="<?php echo esc_attr_x( 'Search', 'placeholder' ) ?>"
    value="<?php echo get_search_query() ?>" name="s"
    title="<?php echo esc_attr_x( 'Search for:', 'label', 'custom') ?>" />

    <?php $post_types = get_option('aw_default_post_types'); ?>
    <select name="aw_post_search_filter">
      <option value="All" <?php echo aw_selected("All"); ?>>All</option>
    <?php foreach($post_types as $type)
        echo '<option value="'.$type.'" '.aw_selected($type).'>'.$type.'</option>';?>
    </select>
    <input id="searchform_submit" class="Button ButtonColor" type="submit" value="Submit">
  </form>
<?php function aw_selected($type)
  {
    if($_GET['aw_post_search_filter'] == $type)
      return 'selected="selected"';

    return '';
  }
?>
