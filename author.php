<?php
/**
 * The template for displaying Author Archive pages.
 *
 * @package Base Station
 * @since Base Station 0.1
 */

get_header(); ?>

    <section id="primary">
      <div class="row">
      <?php do_action( 'basestation_content_before' ); ?>
      <div id="content" class="<?php echo apply_filters( 'basestation_content_container_class', 'nine columns' ); ?>">

      <?php if ( have_posts() ) : ?>

        <?php
          /* Queue the first post, that way we know
           * what author we're dealing with (if that is the case).
           *
           * We reset this later so we can run the loop
           * properly with a call to rewind_posts().
           */
          the_post();
        ?>

        <header class="page-header">
          <h1 class="page-title author"><?php printf( __( 'Author Archives: %s', 'basestation' ), '<span class="vcard"><a class="url fn n" href="' . get_author_posts_url( get_the_author_meta( "ID" ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' ); ?></h1>
        </header>

        <?php
          /* Since we called the_post() above, we need to
           * rewind the loop back to the beginning that way
           * we can run the loop properly, in full.
           */
          rewind_posts();
        ?>
      <?php if ( of_get_option('basestation_content_nav_above') ) { basestation_content_nav( 'nav-above' ); } // display content nav above posts? ?>

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
    </section><!-- #primary -->

<?php get_footer(); ?>