<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package Base Station
 * @since Base Station 0.1
 */

get_header(); ?>

    <section id="primary">
      <div class="row">
      <?php do_action( 'basestation_content_before' ); ?>
      <div id="content" role="main" class="<?php echo apply_filters( 'basestation_content_container_class', 'nine columns' ); ?>">

      <?php if ( have_posts() ) : ?>

        <header id="search-results-header" class="page-header">
          <h1 id="search-results-title" class="page-title"><?php printf( __( 'Search Results for: %s', 'basestation' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
        </header>

        <?php if ( of_get_option('basestation_content_nav_above') ) { basestation_content_nav( 'nav-above' ); } // display content nav above posts? ?>

        <?php /* Start the Loop */ ?>
        <?php while ( have_posts() ) : the_post(); ?>
          <?php do_action( 'basestation_loop_before' ); ?>
          <?php $format = get_post_format();
            if ( false === $format )
            $format = 'standard';
            get_template_part( '/inc/parts/content', $format ); ?>

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