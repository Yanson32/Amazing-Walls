<div id="primary" class="sidebar SidebarColor">
  <?php do_action( 'before_sidebar' ); ?>
  <?php if ( ! dynamic_sidebar( 'primary' ) ) : ?>
    <aside id="meta" class="widget">
<h1 class="widget-title"><?php _e( 'Meta', 'shape' ); ?></h1>
    <ul>
      <?php wp_register(); ?>
      <li><?php wp_loginout(); ?></li>
      <?php wp_meta(); ?>
    </ul>
    </aside>
    <aside id="tags" class="widget">
      <h1 class="widget-title"><?php _e( 'Tags', 'shape' ); ?></h1>
      <ul>
        <li><?php wp_tag_cloud( 'smallest=8&largest=22' ); ?></li>
      </ul>
    </aside>
    <aside id="people" class="widget">
      <h1 class="widget-title"><?php _e( 'Tags', 'shape' ); ?></h1>
      <ul>
        <li><?php wp_tag_cloud( 'smallest=8&largest=22', array('taxonomy' => array('People'))); ?></li>
      </ul>
    </aside>
  <?php endif; ?>
</div>
