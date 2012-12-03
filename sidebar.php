<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Base Station
 * @since Base Station 0.1
 */
?>
<?php if ( current_theme_supports( 'theme-layouts' ) && !is_admin() && 'layout-1c' !== theme_layouts_get_layout() || !current_theme_supports( 'theme-layouts' ) ) { ?>

<?php do_action( 'basestation_sidebar_before' ); ?>
  <div id="sidebar" class="<?php echo apply_filters( 'basestation_sidebar_container_class', 'three columns' ); ?>">
    <?php do_action( 'basestation_sidebar_inside_before' ); ?>
    <div id="secondary" class="<?php echo apply_filters( 'basestation_secondary_container_class', 'widget-area well' ); ?>" role="complementary">
      <?php do_action( 'before_sidebar' ); ?>
      <?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>

        <aside id="search" class="widget widget_search">
          <?php get_search_form(); ?>
        </aside>

        <aside id="archives" class="widget">
          <h3 class="widget-title"><?php _e( 'Archives', 'basestation' ); ?></h3>
          <ul>
            <?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
          </ul>
        </aside>

        <aside id="meta" class="widget">
          <h3 class="widget-title"><?php _e( 'Meta', 'basestation' ); ?></h3>
          <ul>
            <?php wp_register(); ?>
            <aside><?php wp_loginout(); ?></aside>
            <?php wp_meta(); ?>
          </ul>
        </aside>

      <?php endif; // end sidebar widget area ?>
    </div><!-- #secondary .widget-area -->
    <?php do_action( 'basestation_sidebar_inside_after' ); ?>
  </div><!-- #sidebar -->
<?php do_action( 'basestation_sidebar_after' ); ?>

<?php } //endif ?>