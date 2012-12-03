<?php
/**
 * The template used to load the Top Navbar Menu in header*.php
 *
 * @package Base Station
 * @since Base Station 0.70
 */
?>
<!-- Load Top Menu -->
  <nav class="<?php echo apply_filters( 'basestation_top_navbar_class' , 'top-bar'); ?>">

        <?php if (of_get_option('basestation_name_in_navbar',1) ) { // Show site name in navbar? ?>
        <ul id="navbar-brand">
          <li class="name"><a class="brand" href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></li>
          <li class="toggle-topbar"><a href="#"></a></li>
        </ul><!-- /#navbar-brand -->
        <?php } // site name in navbar ?>

        <section>
          <?php wp_nav_menu( array( 'theme_location' => 'top', 'container' => false, 'menu_class' => 'left nav', 'walker' => new Basestation_Topbar_Nav_Walker(), 'fallback_cb' => false ) ); ?>
        </section>

  </nav><!-- /top-bar -->
<!-- End Top Menu -->
