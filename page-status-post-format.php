<?php
/**
 * Template Name: Status Posts
 * The template is for displaying posts with the Status post format.
 *
 * @package Base Station
 * @subpackage Templates
 * @since .93
 */

get_header(); ?>

<!-- Main -->
  <?php do_action( 'basestation_content_before' ); ?>
  <div class="row">
    <div id="content" class="<?php echo apply_filters( 'basestation_content_container_class', 'nine columns' ); ?>">

      <?php
      $status_posts = get_posts( array(
          'tax_query' => array(
              array(
                'taxonomy' => 'post_format',
                'field'    => 'slug',
                'terms'    => array( 'post-format-status' ),
                'operator' => 'IN'
              )
          )
      ) );

      global $post;

      foreach( (array) $status_posts as $post ) {
        setup_postdata( $post );
        get_template_part( '/inc/parts/content', 'status' );
        // comments_template( '', true );
      } ?>

    <?php do_action( 'basestation_content_after' ); ?>
    </div><!-- #content -->
    <?php get_sidebar(); ?>
  </div><!-- .row -->
<?php get_footer(); ?>