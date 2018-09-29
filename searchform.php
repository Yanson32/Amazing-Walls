
  <form role="search" method="get" class="searchform group" action="<?php echo home_url( '/' ); ?>">
    <input type="search" class="search-field"
    placeholder="<?php echo esc_attr_x( 'Search', 'placeholder' ) ?>"
    value="<?php echo get_search_query() ?>" name="s"
    title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
    <input id="searchform_submit" class="Button ButtonColor" type="submit" value="Submit">
  </form>
