<?php
/**
 * Register widgetized areas and widgets
 *
 * @package Base Station
 * @since Base Station 0.1
 */
if ( ! function_exists( 'basestation_widgets_init' ) ):
function basestation_widgets_init() {
  register_sidebar( array(
    'name'          => __( 'Sidebar', 'basestation' ),
    'description'   => __( 'The main widget area displayed in the sidebar.', 'basestation' ),
    'id'            => 'sidebar-1',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget'  => '</aside>',
    'before_title'  => '<h3 class="widget-title">',
    'after_title'   => '</h3>',
  ) );

  register_sidebar( array(
    'name'          => __( 'Marketing Page', 'basestation' ),
    'description'   => __( 'Displayed on pages created with the Marketing template. This is the top row and widgets should be used in pairs (2 widgets here).', 'basestation' ),
    'id'            => 'marketingwidgets-1',
    'before_widget' => '<div class="six columns">',
    'after_widget'  => '</div>',
    'before_title'  => '<h4 class="widget-title">',
    'after_title'   => '</h4>',
  ) );

  register_sidebar( array(
    'name'          => __( 'Marketing Page 2', 'basestation' ),
    'description'   => __( 'Displayed on pages created with the Marketing template. This is the bottom row and widgets should be used in pairs (2 widgets in each row).', 'basestation' ),
    'id'            => 'marketingwidgets-2',
    'before_widget' => '<div class="six columns">',
    'after_widget'  => '</div>',
    'before_title'  => '<h4 class="widget-title">',
    'after_title'   => '</h4>',
  ) );

  register_sidebar( array(
    'name'          => __( 'Footer', 'basestation' ),
    'description'   => __( 'The footer widget area displayed after all content.', 'basestation' ),
    'id'            => 'footer-1',
    'before_widget' => '<div class="four columns">',
    'after_widget'  => '</div>',
    'before_title'  => '<h3 class="widget-title">',
    'after_title'   => '</h3>',
  ) );

  register_sidebar( array(
    'name'          => __( 'Footer 2', 'basestation' ),
    'description'   => __( 'The second footer widget area, displayed below the Footer widget area.', 'basestation' ),
    'id'            => 'footer-2',
    'before_widget' => '<div class="four columns">',
    'after_widget'  => '</div>',
    'before_title'  => '<h3 class="widget-title">',
    'after_title'   => '</h3>',
  ) );
}
add_action( 'widgets_init', 'basestation_widgets_init' );
endif;



/* Register Base Station widgets */
if ( ! function_exists( 'basestation_register_widgets' ) ):
function basestation_register_widgets() {

  /* Load the login form widget file */
  locate_template('/inc/widgets/widget-login-form.php', true);

  /* Load the side-nav menu widget */
  locate_template('/inc/widgets/widget-side-nav-menu.php', true);

  /* Register the login form widget */
  register_widget( 'basestation_Widget_Login' );

  /* Register the nav list menu widget */
  register_widget( 'Side_Nav_Menu_Widget' );

}
add_action( 'widgets_init', 'basestation_register_widgets' );
endif;



/* Base Station custom login form */
if ( ! function_exists( 'basestation_wp_login_form' ) ):
function basestation_wp_login_form( $args = array() ) {
  $defaults = array(
            'echo'           => true,
            'redirect'       => ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'], // Default redirect is back to the current page
            'form_id'        => 'loginform',
            'label_username' => __( 'Username', 'basestation' ),
            'label_password' => __( 'Password', 'basestation' ),
            'label_remember' => __( 'Remember Me', 'basestation' ),
            'label_log_in'   => __( 'Log In', 'basestation' ),
            'id_username'    => 'user_login',
            'id_password'    => 'user_pass',
            'id_remember'    => 'rememberme',
            'id_submit'      => 'wp-submit',
            'remember'       => true,
            'value_username' => '',
            'value_remember' => false, // Set this to true to default the "Remember me" checkbox to checked
          );
  $args = wp_parse_args( $args, apply_filters( 'login_form_defaults', $defaults ) );

  $form = '
    <form name="' . $args['form_id'] . '" id="' . $args['form_id'] . '" action="' . esc_url( site_url( 'wp-login.php', 'login_post' ) ) . '" method="post">
      ' . apply_filters( 'login_form_top', '', $args ) . '
      <p class="login-username">
        <label for="' . esc_attr( $args['id_username'] ) . '">' . esc_html( $args['label_username'] ) . '</label>
        <input type="text" name="log" id="' . esc_attr( $args['id_username'] ) . '" class="input" value="' . esc_attr( $args['value_username'] ) . '" size="20" tabindex="10" />
      </p>
      <p class="login-password">
        <label for="' . esc_attr( $args['id_password'] ) . '">' . esc_html( $args['label_password'] ) . '</label>
        <input type="password" name="pwd" id="' . esc_attr( $args['id_password'] ) . '" class="input" value="" size="20" tabindex="20" />
      </p>
      ' . apply_filters( 'login_form_middle', '', $args ) . '
      ' . ( $args['remember'] ? '<p class="login-remember"><label><input name="rememberme" type="checkbox" id="' . esc_attr( $args['id_remember'] ) . '" value="forever" tabindex="90"' . ( $args['value_remember'] ? ' checked="checked"' : '' ) . ' /> ' . esc_html( $args['label_remember'] ) . '</label></p>' : '' ) . '
      <p class="login-submit">
        <input type="submit" name="wp-submit" id="' . esc_attr( $args['id_submit'] ) . '" class="button" value="' . esc_attr( $args['label_log_in'] ) . '" tabindex="100" />
        <input type="hidden" name="redirect_to" value="' . esc_url( $args['redirect'] ) . '" />
      </p>
      ' . apply_filters( 'login_form_bottom', '', $args ) . '
    </form>';

  if ( $args['echo'] )
    echo $form;
  else
    return $form;
}
endif;