<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to basestation_comment() which is
 * located in the inc/template-tags.php file.
 *
 * @package Base Station
 * @since Base Station 0.1
 */
?>
  <div id="comments">
  <?php if ( post_password_required() ) : ?>
    <p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'basestation' ); ?></p>
  </div><!-- #comments -->
  <?php
      /* Stop the rest of comments.php from being processed,
       * but don't kill the script entirely -- we still have
       * to fully load the template.
       */
      return;
    endif;
  ?>

  <?php // You can start editing here -- including this comment! ?>

  <?php if ( have_comments() ) : ?>
    <h2 id="comments-title">
      <?php
        printf( _n( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'basestation' ),
          number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
      ?>
    </h2>

    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
    <nav id="comment-nav-above" class="pager">
      <h3 class="assistive-text section-heading"><?php _e( 'Comment navigation', 'basestation' ); ?></h3>
      <div class="nav-previous pull-left"><?php previous_comments_link( __( '&larr; Older Comments', 'basestation' ) ); ?></div>
      <div class="nav-next pull-right"><?php next_comments_link( __( 'Newer Comments &rarr;', 'basestation' ) ); ?></div>
    </nav>
    <?php endif; // check for comment navigation ?>

    <ol class="commentlist">
      <?php
        /* Loop through and list the comments. Tell wp_list_comments()
         * to use basestation_comment() to format the comments.
         * If you want to overload this in a child theme then you can
         * define basestation_comment() and that will be used instead.
         * See basestation_comment() in inc/template-tags.php for more.
         */
        wp_list_comments( array( 'callback' => 'basestation_comment' ) );
      ?>
    </ol>

    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
    <nav id="comment-nav-below" class="pager">
      <h3 class="assistive-text section-heading"><?php _e( 'Comment navigation', 'basestation' ); ?></h3>
      <div class="nav-previous pull-left"><?php previous_comments_link( __( '&larr; Older Comments', 'basestation' ) ); ?></div>
      <div class="nav-next pull-right"><?php next_comments_link( __( 'Newer Comments &rarr;', 'basestation' ) ); ?></div>
    </nav>
    <?php endif; // check for comment navigation ?>

  <?php endif; // have_comments() ?>

  <?php
    // If comments are closed and there are comments, let's leave a little note, shall we?
    if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
  ?>
    <div class="alert alert-block fade in">
      <p class="nocomments"><?php _e( 'Comments are closed.', 'basestation' ); ?></p>
    </div>
  <?php endif; ?>


<?php
  // If comments are open
  if (comments_open()) { ?>
  <section id="respond">
    <h3><?php comment_form_title(__('Leave a Reply', 'basestation'), __('Leave a Reply to %s', 'basestation')); ?></h3>
    <p class="cancel-comment-reply"><?php cancel_comment_reply_link(); ?></p>
    <?php if (get_option('comment_registration') && !is_user_logged_in()) { ?>
      <p><?php printf(__('You must be <a href="%s">logged in</a> to post a comment.', 'basestation'), wp_login_url(get_permalink())); ?></p>
    <?php } else { ?>
<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
  <?php if (is_user_logged_in()) { ?>
    <p><?php printf(__('Logged in as <a href="%s/wp-admin/profile.php">%s</a>.', 'basestation'), get_option('siteurl'), $user_identity); ?> <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php __('Log out of this account', 'basestation'); ?>"><?php _e('Log out &raquo;', 'basestation'); ?></a></p>
  <?php } else { ?>

    <label for="author" class="control-label"><?php _e('Name', 'basestation'); if ($req) _e(' (required)', 'basestation'); ?></label>
    <div class="input-prepend">
    <span class="add-on"><i class="icon-user"></i> </span><input type="text" class="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?>>
    </div><!-- /input-prepend -->

    <label for="email" class="control-group"><?php _e('Email (will not be published)', 'basestation'); if ($req) _e(' (required)', 'basestation'); ?></label>
    <div class="input-prepend">
    <span class="add-on"><i class="icon-mail"></i> </span><input type="email" class="text" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?>>
    </div><!-- /input-prepend -->

    <label for="url" class="control-label"><?php _e('Website', 'basestation'); ?></label>
    <div class="input-prepend">
    <span class="add-on"><i class="icon-home"></i> </span><input type="url" class="text" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" size="22" tabindex="3">
    </div><!-- /input-prepend -->

  <?php } ?>

  <label for="comment" class="control-label"><?php _e('Comment', 'basestation'); ?></label>
  <div class="input-prepend">
  <span class="add-on"><i class="icon-comment"></i> </span><textarea name="comment" id="comment" class="input-large" rows="6" tabindex="4"></textarea>
  </div><!-- /input-prepend -->

  <input name="submit" class="medium radius comment button" type="submit" id="submit" tabindex="5" value="<?php _e('Submit Comment', 'basestation'); ?>">
  <?php comment_id_fields(); ?>
  <?php do_action('comment_form', $post->ID); ?>
</form>
<?php } // if registration required and not logged in ?>
</section><!-- #respond -->
<?php } ?>
</div>
