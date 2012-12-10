<?php
/**
 * Load Foundation javascript modules
 *
 * @package Base Station
 * @since 0.1
 */
function basestation_foundation_js_loader() {
    /* Load the Foundation libraries */
    wp_enqueue_script('foundation.js', get_template_directory_uri().'/js/foundation.min.js', array('jquery'),'3.22', true );
    wp_enqueue_script('app.js', get_template_directory_uri().'/js/app.js', array('jquery'), '3.22', true );
    wp_enqueue_script('offcanvas.js', get_template_directory_uri().'/js/jquery.offcanvas.js', array('jquery'), '3.22', true );

    /* Load the pagination helper */
    wp_enqueue_script('basestation_page-links.js', get_template_directory_uri().'/js/basestation_page-links.js', array('jquery'),'1.0', true);
}
add_action('wp_enqueue_scripts', 'basestation_foundation_js_loader');