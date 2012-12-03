<?php
/**
 * The main template file.
 * @package Base Station
 * @since Base Station 0.1
 */

get_header(); ?>

      <div id="main-row" class="row">

        <?php do_action( 'basestation_content_before' ); ?>
        <div id="content" role="main" class="<?php echo apply_filters( 'basestation_content_container_class', 'nine columns' ); ?>">
        <?php if ( have_posts() ) :

          if ( of_get_option('basestation_content_nav_above') ) { basestation_content_nav( 'nav-above' ); } // display content nav above posts?

            /**
             * Featured Posts
             */
            if ( of_get_option('basestation_featured_posts') ) {

              if ( of_get_option('basestation_featured_posts_display_type',1) == "1" ) {
                basestation_featured_posts_slider();
              } else {
                basestation_featured_posts_grid(); }

              /**
               * Show or hide featured posts in the main body
               *
               * Do not duplicate featured posts */
              if ( of_get_option('basestation_featured_posts_show_dupes') == "0" ) {
                global $wp_query;
                $wp_query->set( 'tag__not_in', array( of_get_option( 'basestation_featured_posts_tag' ) ) );
                $wp_query->get_posts();
              }

              /* Duplicate featured posts */
              if ( of_get_option('basestation_featured_posts_show_dupes') == "1" ) {
                global $wp_query;
                $wp_query->set( 'post_status', 'publish' );
                $wp_query->get_posts();
              }

            } // if (of_get_option('basestation_featured_posts') ) ?>



        <?php /* Start the Loop */ ?>

        <?php while ( have_posts() ) : the_post(); ?>
          <?php do_action( 'basestation_loop_before' ); ?>
          <?php
            /* Include the Post-Format-specific template for the content.
             * If you want to overload this in a child theme then include a file
             * called content-___.php (where ___ is the Post Format name) and that will be used instead.
             */
            $format = get_post_format();
            if ( false === $format )
            $format = 'standard';
            get_template_part( '/inc/parts/content', $format );
          ?>
          <?php do_action( 'basestation_loop_after' ); ?>
        <?php endwhile; ?>

        <?php if ( of_get_option('basestation_content_nav_below',1) ) { basestation_content_nav( 'nav-below' ); } // display content nav below posts? ?>

      <?php else : ?>

      <?php /* No results */ get_template_part( '/inc/parts/content', 'none' ); ?>

      <?php endif; ?>
        <?php do_action( 'basestation_content_after' ); ?>
        </div><!-- #content -->
        <?php get_sidebar(); ?>
      </div><!-- .row -->
    <?php get_footer(); ?>
