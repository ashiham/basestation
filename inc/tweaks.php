<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Base Station
 * @since Base Station 0.1
 */


/**
 * We don't need to self-close these tags in html5: <img>, <input>
 * @since Base Station 0.3
 */
if ( ! function_exists( 'basestation_remove_self_closing_tags' ) ):
function basestation_remove_self_closing_tags( $input ) {
  return str_replace(' />', '>', $input);
}
add_filter( 'get_avatar', 'basestation_remove_self_closing_tags' );
add_filter( 'comment_id_fields', 'basestation_remove_self_closing_tags' );
add_filter( 'post_thumbnail_html', 'basestation_remove_self_closing_tags' );
endif;


/**
 * Pretty search URL. Changes /?s=foo to /search/foo. http://txfx.net/wordpress-plugins/nice-search/
 * @since Base Station 0.3
 */
if ( ! function_exists( 'basestation_nice_search_redirect' ) ):
function basestation_nice_search_redirect() {
  if ( is_search() && get_option('permalink_structure') != '' && strpos( $_SERVER['REQUEST_URI'], '/wp-admin/' ) === false && strpos( $_SERVER['REQUEST_URI'], '/search/' ) === false ) {
    wp_redirect( home_url( '/search/' . str_replace( array( ' ', '%20' ),  array( '+', '+' ), get_query_var( 's' ) ) ) );
    exit();
  }
}
add_action( 'template_redirect', 'basestation_nice_search_redirect' );
endif;


if ( ! function_exists( 'basestation_search_query' ) ):
function basestation_search_query($escaped = true) {
  $query = apply_filters('basestation_search_query', get_query_var('s'));
  if ($escaped) {
      $query = esc_attr($query);
  }
  return urldecode($query);
}
add_filter('get_search_query', 'basestation_search_query');
endif;



/**
 * Custom image, link, and title on login/register page
 * ----------------------------------------------------
 * @since .50
 * @deprecated .91
 * TODO Delete this feature in 1.1.0.
 */

/* Custom permalink for login page image */
if ( ! function_exists( 'basestation_custom_login_image_link' ) ) {
  function basestation_custom_login_image_link() {
    return get_site_url();
  }
  add_filter('login_headerurl', 'basestation_custom_login_image_link');
}

/* Custom title for login page image */
if ( ! function_exists( 'basestation_custom_login_image_title' ) ) {
  function basestation_custom_login_image_title() {
    return esc_attr(get_bloginfo('name'));
  }
  add_filter('login_headertitle', 'basestation_custom_login_image_title');
}

/* Custom login logo for wp-admin screen */
if ( of_get_option( 'basestation_custom_login_image' ) ) {
  if ( ! function_exists( 'basestation_custom_login_image' ) ) {
    function basestation_custom_login_image() {
      _deprecated_function( __FUNCTION__, '.91', 'the <a href="http://wordpress.org/extend/plugins/login-logo/" target="_blank">Login Logo plugin</a>' );
      echo '<style type="text/css">
      .login h1 a { background-image:url( "'.of_get_option( 'basestation_custom_login_image_file' ).'" ) !important; }
      </style>';
    }
  }
add_action('login_head', 'basestation_custom_login_image');
}


/* Style the excerpt continuation */
if ( ! function_exists( 'basestation_excerpt_more') ) {
  function basestation_excerpt_more($more) {
    global $post;
    return ' ... <a href="'. get_permalink($post->ID) . '">'. __( 'Continue Reading ', 'basestation' ) .' &rarr;</a>';
  }
}
add_filter('excerpt_more', 'basestation_excerpt_more');


/**
 * Adds custom classes to the array of body classes.
 *
 * @since Base Station 0.1
 */
/* function basestation_body_classes( $classes ) {
	// If this isn't a post or a page we'll add the convenient .indexed class
	if ( ! is_singular() ) {
		$classes[] = 'indexed';
	}
	// Adds a class of group-blog to blogs with more than 1 published author
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', 'basestation_body_classes' );
*/



/**
 * Filter in a link to a content ID attribute for the next/previous image links on image attachment pages
 *
 * @since Base Station 0.1
 */
/* function basestation_enhanced_image_navigation( $url, $id ) {
	if ( ! is_attachment() && ! wp_attachment_is_image( $id ) )
		return $url;

	$image = get_post( $id );
	if ( ! empty( $image->post_parent ) && $image->post_parent != $id )
		$url .= '#main';

	return $url;
}
add_filter( 'attachment_link', 'basestation_enhanced_image_navigation', 10, 2 ); */