<?php
/* Custom Header Support
 *
 * @package Base Station
 * @since .69
 *
 * Credit to WordPress team for code used from Twenty Eleven and P2 themes.
 */

/**
 * Setup the WordPress core custom header feature.
 *
 * @uses basestation_header_style()
 * @uses basestation_admin_header_style()
 * @uses basestation_admin_header_image()
 *
 */

function basestation_setup_custom_header() {
  $args = array(
    'width'                   => 940,
    'height'                  => 288,
    'default-image'           => '',
    'default-text-color'      => '333',
    'header-text'             => 'false',
    'random-default'          => 'true',
    'wp-head-callback'        => 'basestation_header_style',
    'admin-head-callback'     => 'basestation_admin_header_style',
    'admin-preview-callback'  => 'basestation_admin_header_image',
  );

  $args = apply_filters( 'basestation_custom_header_args', $args );

  add_theme_support( 'custom-header', $args );
}
add_action( 'init', 'basestation_setup_custom_header' );



if ( ! function_exists( 'basestation_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @since .53
 */
function basestation_header_style() {

  // If no custom options for text are set, let's bail
  // get_header_textcolor() options: HEADER_TEXTCOLOR is default, hide text (returns 'blank') or any hex value
  if ( HEADER_TEXTCOLOR == get_header_textcolor() )
    return;
  // If we get this far, we have custom styles. Let's do this.
  ?>
  <style type="text/css">
  <?php
    // Has the text been hidden?
    if ( 'blank' == get_header_textcolor() ) :
  ?>
    #site-title,
    #site-description {
      position: absolute !important;
      clip: rect(1px 1px 1px 1px); /* IE6, IE7 */
      clip: rect(1px, 1px, 1px, 1px);
    }
  <?php
    // If the user has set a custom color for the text use that
    else :
  ?>
    #site-title a,
    #site-description {
      color: #<?php echo get_header_textcolor(); ?> !important;
    }
  <?php endif; ?>
  </style>
  <?php
}
endif; // basestation_header_style



if ( ! function_exists( 'basestation_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * Referenced via basestation_setup_custom_header and add_custom_image_header().
 *
 * @since .53
 */
function basestation_admin_header_style() {
?>
  <style type="text/css">
  .appearance_page_custom-header #headimg {
    border: none;
  }
  #headimg h1,
  #desc {
    font-family: "Helvetica Neue", Arial, Helvetica, sans-serif;
  }
  #headimg h1 {
    margin: 0;
  }
  #headimg h1 a {
    font-size: 32px;
    line-height: 36px;
    text-decoration: none;
  }
  #desc {
    font-size: 14px;
    line-height: 23px;
    padding: 0 0 3em;
  }
  <?php
    // If the user has set a custom color for the text use that
    if ( get_header_textcolor() != HEADER_TEXTCOLOR ) :
  ?>
    #site-title a,
    #site-description {
      color: #<?php echo get_header_textcolor(); ?>;
    }
  <?php endif; ?>
  #headimg img {
    max-width: 1000px;
    height: auto;
    width: 100%;
  }
  </style>
<?php
}
endif; // basestation_admin_header_style



if ( ! function_exists( 'basestation_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * Referenced via basestation_setup_custom_header and add_custom_image_header().
 *
 * @since .53
 */
function basestation_admin_header_image() { ?>
  <div id="headimg">
    <?php $style = ( 'blank' == get_header_textcolor() OR ! get_header_textcolor() ) ? ' style="display: none;"' : ''; ?>

    <h1<?php echo $style; ?>><a id="name" onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
    <div id="desc"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></div>
    <?php if ( get_header_image() ) : ?>
      <img src="<?php echo esc_url( get_header_image() ); ?>" alt="" />
    <?php endif; ?>
  </div>
<?php }
endif; // basestation_admin_header_image