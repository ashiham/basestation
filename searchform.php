<?php
/**
 * The template for displaying search forms in Base Station
 *
 * @package Base Station
 * @since Base Station 0.1
 */
?>
  <form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
    <label for="s" class="assistive-text"><?php _e( 'Search', 'basestation' ); ?></label>
    <input type="text" class="field" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" id="s" placeholder="<?php esc_attr_e( 'Search &hellip;', 'basestation' ); ?>" />
    <input type="submit" class="medium button" name="submit" id="searchsubmit" value="<?php esc_attr_e( 'Search', 'basestation' ); ?>" />
  </form>
