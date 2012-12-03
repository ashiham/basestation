<?php
/**
 * The template used to load the Main Menu in header*.php
 *
 * @package Base Station
 * @since Base Station 0.70
 */
?>
<!-- Main menu -->
    <div id="main-nav">
      <?php wp_nav_menu( array( 'theme_location' => 'main', 'container' => false, 'menu_class' => '', 'items_wrap' => '<ul class="nav-bar">%3$s</ul>', 'walker' => new Basestation_Navbar_Nav_Walker(), 'fallback_cb' => false ) ); ?>
    </div><!-- #main-nav -->
<!-- End Main menu -->
