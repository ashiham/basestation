<?php
/**
 * Clean up header output
 * @package Base Station
 * @since Base Station 0.3
 */

if ( ! function_exists( 'basestation_noindex' ) ):
function basestation_noindex() {
  if (get_option('blog_public') === '0') {
    echo '<meta name="robots" content="noindex,nofollow">', "\n";
  }
}
endif;

if ( ! function_exists( 'basestation_head_cleanup' ) ):
function basestation_head_cleanup() {
  remove_action('wp_head', 'rsd_link');
  remove_action('wp_head', 'wlwmanifest_link');
  remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
  remove_action('wp_head', 'wp_generator');
  remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
  remove_action('wp_head', 'noindex', 1);
  add_action('wp_head', 'basestation_noindex');
}
add_action('init', 'basestation_head_cleanup');
endif;
