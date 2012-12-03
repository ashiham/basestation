<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Base Station
 * @since Base Station 0.1
 */
?>
<?php do_action( 'basestation_post_before' ); ?>
<article role="article" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <?php do_action( 'basestation_post_inside_before' ); ?>

  <?php do_action( 'basestation_entry_title' ); ?>

  <div class="entry-content">
    <?php the_content(); ?>
    <div class="clear">&nbsp;</div>
    <?php basestation_wp_link_pages(); ?>
    <?php edit_post_link( __( ' Edit', 'basestation' ), '<span class="edit-link pull-right"><i class="icon-pencil"></i>', '</span>' ); ?>
    <?php do_action( 'basestation_post_inside_after' ); ?>
  </div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
<?php do_action( 'basestation_post_after' ); ?>