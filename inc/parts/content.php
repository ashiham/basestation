<?php
/**
 * @package Base Station
 * @since Base Station 0.1
 */
?>
<?php do_action( 'basestation_post_before' ); ?>
<article role="article" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <?php do_action( 'basestation_post_inside_before' ); ?>

  <?php do_action( 'basestation_entry_title' ); ?>

    <?php do_action( 'basestation_content' ); ?>

  <footer class="entry-meta">
    <?php if ( 'post' == get_post_type() ) : ?>
      <?php
      if (of_get_option('basestation_published_date',1) ) { do_action( 'basestation_posted_on' ); } // Show published date?
      if (of_get_option('basestation_post_author',1) ) { do_action( 'basestation_post_author' ); } // Show post author?
      if (of_get_option('basestation_post_categories',1) && is_single() || of_get_option('basestation_post_categories_posts_page',1) && !is_single() ) { do_action( 'basestation_post_categories' ); } // show post categories?
      if (of_get_option('basestation_post_tags',1) && is_single() || of_get_option('basestation_post_tags_posts_page',1) && !is_single() ) { do_action( 'basestation_post_tags' ); } // show post tags?
      if (of_get_option('basestation_post_comments_link',1) ) { do_action( 'basestation_post_comments_link' ); }
      edit_post_link( __( ' Edit', 'basestation' ), '<span class="edit-link pull-right"><i class="icon-pencil"></i>', '</span>' ); ?>
    <?php endif; ?>
  </footer><!-- #entry-meta -->
  <?php do_action( 'basestation_post_inside_after' ); ?>
</article><!-- #post-<?php the_ID(); ?> -->
<?php do_action( 'basestation_post_after' ); ?>