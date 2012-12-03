<?php
/**
 * Register the navigation menus. This theme uses wp_nav_menu() in three locations.
 */
 register_nav_menus( array(
   'top'           => __( 'Top Menu', 'basestation' ),
   'main'          => __( 'Main Menu', 'basestation' ),
   'bottom'        => __( 'Bottom Menu', 'basestation' ),
   'marketing-top' => __( 'Marketing Menu', 'basestation' )
 ) );


/**
 * Custom Walker for Top menu
 * @since 1.0
 */
class Basestation_Topbar_Nav_Walker extends Walker_Nav_Menu {

  public $dropdown_enqueued;

  /**
   * Check if required script queued.
   */
  function __construct() {

    $this->dropdown_enqueued = wp_script_is( 'foundation.js', 'queue' );
  }

  /**
   * Adjust classes for individual menu items.
   */
  function display_element( $element, &$children_elements, $max_depth, $depth = 0, $args, &$output ) {

    if ( $element->current )
      $element->classes[] = 'active';

    $element->is_dropdown = ! empty( $children_elements[$element->ID] );

    if ( $element->is_dropdown ) {

      if( 0 == $depth  )
        $element->classes[] = 'has-dropdown';
      elseif( 1 == $depth )
        $element->classes[] = 'dropdown';
    }

    parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
  }

  /**
   * Enqueue script and set class for list.
   */
  function start_lvl( &$output, $depth ) {

    if ( ! $this->dropdown_enqueued ) {
      wp_enqueue_script( 'foundation.js' );
      $this->dropdown_enqueued = true;
    }

    $indent  = str_repeat( "\t", $depth );
    $class   = ( $depth < 2 ) ? 'dropdown' : 'unstyled';
    $output .= "\n{$indent}<ul class='{$class}'>\n";
  }

  /**
   * Adjust markup for top level dropdown menu item.
   */
  function start_el( &$output, $item, $depth, $args ) {

    $item_html = '';
    parent::start_el( $item_html, $item, $depth, $args );

    if ( $item->is_dropdown && ( 0 == $depth ) ) {
      $item_html = str_replace( '<a', '<a class="has-dropdown"', $item_html );
      $item_html = str_replace( esc_attr( $item->url ), '#', $item_html );
    }

    $output .= $item_html;
  }
}




/* Custom Walker for Main menu */
class Basestation_Navbar_Nav_Walker extends Walker_Nav_Menu {

  function start_lvl(&$output, $depth) {
    $indent = str_repeat("\t", $depth);
    $output .= "\n$indent<a href=\"#\" class=\"flyout-toggle\"><span> </span></a><ul class=\"flyout\">\n";
  }

  function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {
    $id_field = $this->db_fields['id'];
    if ( !empty( $children_elements[ $element->$id_field ] ) ) {
      $element->classes[] = 'has-flyout';
    }

    if ( $element->current )
      $element->classes[] = 'active';

    Walker_Nav_Menu::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
  }

}



/* Custom Walker for Marketing Menu */
class Basestation_Marketing_Nav_Walker extends Walker_Nav_Menu {

  /* Add active class */
  function display_element( $element, &$children_elements, $max_depth, $depth = 0, $args, &$output ) {
    if ( $element->current )
    $element->classes[] = 'active';

    parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
  }

  /* Adjust markup for 'sub-nav' style menu. Change <li> to <dd> */
  function start_el( &$output, $item, $depth, $args ) {

    $item_html = '';
    parent::start_el( $item_html, $item, $depth, $args );

    $item_html = str_replace( '<li', '<dd', $item_html );
    // $item_html = str_replace( esc_attr( $item->url ), '#', $item_html );

    $output .= $item_html;
  }
}
