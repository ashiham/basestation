<?php
/**
 * The template used to load the Top Navbar Menu in the Marketing Page template
 *
 * @package Base Station
 * @subpackage Templates
 * @since .93
 */
?>
  <?php wp_nav_menu( array( 'theme_location' => 'marketing-top', 'container' => false, 'menu_class' => 'sub-nav', 'items_wrap' => '<dl id="%1$s" class="%2$s">%3$s</dl>', 'walker' => new Basestation_Marketing_Nav_Walker(), 'depth' => 1, 'fallback_cb' => false ) ); ?>