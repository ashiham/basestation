<?php
/**
 * Menu widget with Foundation side-nav markup. Credit to Andrey Savchenko for the original version of this widget.
 *
 * @package Base Station
 * @subpackage Widgets
 * @since .93
 */
class Side_Nav_Menu_Widget extends WP_Nav_Menu_Widget {

  private $instance;

  function __construct() {

    WP_Widget::__construct(
      'side_nav_menu',
      __( 'Custom Menu: Side Nav', 'basestation' ),
      array(
        'description' => __( 'Custom menu widget using Side Nav styling. Only goes one level deep!', 'basestation' )
      )
    );
  }

  function widget( $args, $instance ) {

    $this->instance = $instance;
    add_filter( 'wp_nav_menu_args', array( $this, 'wp_nav_menu_args' ) );
    add_filter( 'wp_nav_menu', array( $this, 'wp_nav_menu' ) );
    parent::widget( $args, $instance );
    remove_filter( 'wp_nav_menu_args', array( $this, 'wp_nav_menu_args' ) );
    remove_filter( 'wp_nav_menu', array( $this, 'wp_nav_menu' ) );
  }

  function wp_nav_menu_args( $args ) {

    $args['container_class'] = empty( $this->instance['panel'] ) ? '' : 'panel';
    $args['menu_class']      = 'menu side-nav';

    return apply_filters( 'side_nav_menu_args', $args );
  }

  function wp_nav_menu( $nav_menu ) {

    $nav_menu = str_replace( '"sub-menu"', '"sub-menu side-nav"', $nav_menu );
    $nav_menu = str_replace( 'current-menu-item', 'current-menu-item active', $nav_menu );

    return $nav_menu;
  }

  function update( $new_instance, $old_instance ) {

    $instance         = parent::update( $new_instance, $old_instance );
    $instance['panel'] = (boolean) $new_instance['panel'];

    return $instance;
  }

  function form( $instance ) {

    parent::form( $instance );
    $panel = isset( $instance['panel'] ) ? $instance['panel'] : false;

    ?>
    <p>
      <label for="<?php echo $this->get_field_id( 'panel' ); ?>"><?php echo __( '"panel" Container', 'basestation' ); ?></label>
      <input type="checkbox" id="<?php echo $this->get_field_id( 'panel' ); ?>" name="<?php echo $this->get_field_name( 'panel' ); ?>" <?php checked( $panel )  ?> />
    </p>
    <?php
  }
}