<?php
/**
 * Register and enqueue the front end CSS
 *
 * @package Base Station
 * @since 1.0
 */


/* Load Foundation CSS */
function basestation_foundation_styles() {
    wp_enqueue_style( 'foundation', basestation_locate_template_uri( 'css/foundation.min.css' ), array(), '3.22', 'all' );
}
add_action( 'wp_enqueue_scripts', 'basestation_foundation_styles', 1 );



/* Load theme styles */
function basestation_theme_styles() {
    wp_enqueue_style( 'basestation-style', get_stylesheet_uri() );

    /* Check for custom.css and if it exists and we're not using a child theme, load it. */
    if ( file_exists( get_template_directory() . '/custom/custom.css' ) && !is_child_theme() ) {
        wp_enqueue_style( 'basestation-custom', basestation_locate_template_uri( 'custom/custom.css' ) );
    }

}
add_action( 'wp_enqueue_scripts', 'basestation_theme_styles', 2 );