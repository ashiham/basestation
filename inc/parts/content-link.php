<?php
/**
 * The template for displaying posts in the Link post format
 *
 * @package Base Station
 * @since Base Station 0.64
 */
?>
<?php basestation_get_first_link(); // get the link from the post body
global $link_url; global $post_content; ?>
<?php do_action( 'basestation_post_before' ); ?>
<article role="article" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <?php do_action( 'basestation_post_inside_before' ); ?>
  <header class="entry-header">
    <h2 class="entry-title"><a class="entry-title" title="<?php printf( esc_attr__( 'Link to %s', 'basestation' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark" href="<?php echo $link_url; ?>"><?php the_title(); ?>&rarr;</a></h2>
  </header><!-- .entry-header -->

  <div class="entry-content">
    <?php echo $post_content; // displays post content without the link ?>
    <?php basestation_wp_link_pages(); ?>
  </div><!-- .entry-content -->

  <footer class="entry-meta">
    <?php
    if (of_get_option('basestation_published_date',1) ) { do_action( 'basestation_posted_on' ); } // show published date?
    if (of_get_option('basestation_post_author',1) ) { do_action( 'basestation_post_author' ); } // Show post author?
    if (of_get_option('basestation_post_categories',1) && is_single() || of_get_option('basestation_post_categories_posts_page',1) && !is_single() ) { do_action( 'basestation_post_categories' ); } // show post categories?
    if (of_get_option('basestation_post_tags',1) && is_single() || of_get_option('basestation_post_tags_posts_page',1) && !is_single() ) { do_action( 'basestation_post_tags' ); } // show post tags?
    if (of_get_option('basestation_post_comments_link',1) ) { do_action( 'basestation_post_comments_link' ); }
    edit_post_link( __( ' Edit', 'basestation' ), '<span class="edit-link pull-right"><i class="icon-pencil"></i>', '</span>' ); // display the edit link
    ?>
  </footer><!-- .entry-meta -->
  <?php do_action( 'basestation_post_inside_after' ); ?>
</article><!-- #post-<?php the_ID(); ?> -->
<?php do_action( 'basestation_post_after' ); ?>