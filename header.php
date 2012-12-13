<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up to <div id="main">
 *
 * @package Base Station
 * @since Base Station 0.1
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<?php get_template_part( '/inc/parts/meta' ); ?>
<title><?php wp_title( '|', true, 'right' ); ?></title>

<?php if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>

<!--[if lt IE 8]>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/general_foundicons_ie7.css">
<![endif]-->

<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->

<?php do_action( 'basestation_head' ); ?>
<?php wp_head(); ?>
</head>

<body <?php body_class( 'off-canvas hide-extras' ); ?>>
<!--[if lt IE 8]><p class="chromeframe">Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p><![endif]-->

<?php if ( of_get_option('basestation_show_top_navbar',1) ) {
  get_template_part( '/inc/parts/menu', 'top' );
} ?>

  <!-- Site title and description in masthead -->
  <div id="page" class="container-fluid hfeed">
    <?php do_action( 'before' ); ?>
    <?php do_action( 'basestation_header_before' ); ?>
  	<header id="masthead" role="banner">
      <?php do_action( 'basestation_header_inside' ); ?>
      <?php basestation_header_title_and_description(); ?>

    <?php
      // Check for header image
      $header_image = get_header_image();
      if ( $header_image ) :
        $header_image_width = get_theme_support( 'custom-header', 'width' );
        $header_image_height = get_theme_support( 'custom-header', 'height' );
      ?>
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
      <?php
        // The header image
        // Check if this is a post or page, if it has a thumbnail, and if it's a big one
        if ( is_singular() && has_post_thumbnail( $post->ID ) &&
            ( /* $src, $width, $height */ $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), array( $header_image_width, $header_image_height ) ) ) && $image[1] >= $header_image_width ) :
          // Houston, we have a new header image!
          echo get_the_post_thumbnail( $post->ID, 'post-thumbnail' );
          else :
            $header_image_width  = get_custom_header()->width;
            $header_image_height = get_custom_header()->height;
          ?>
        <img src="<?php header_image(); ?>" width="<?php echo $header_image_width; ?>" height="<?php echo $header_image_height; ?>" class="header-image" alt="" />
      <?php endif; // end check for featured image or standard header ?>
    </a>
    <?php endif; // end check for header image ?>

  <!-- End Site title and description in masthead -->

    <?php if ( has_nav_menu('main') ) {
      get_template_part( '/inc/parts/menu', 'main' );
    } ?>
    </header><!-- #masthead -->
    <?php do_action( 'basestation_header_after' ); ?>

    <?php if ( function_exists('basestation_breadcrumbs') && !is_front_page() ) { basestation_breadcrumbs(); } ?>


  <?php do_action( 'basestation_main_before' ); ?>
  <div id="main">
  <section role="main">