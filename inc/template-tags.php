<?php
/**
 * Custom template tags for this theme.
 *
 * @package Base Station
 * @since 0.1
 */

if ( ! function_exists( 'basestation_excerpt_or_content' ) ):
/**
 * Displays post content or excerpt
 * @since .593
 */
function basestation_excerpt_or_content() {
  if ( !is_singular() && of_get_option( 'basestation_archive_display', "full" ) == "excerpt" || is_search() ) { ?>

    <div class="entry-summary">
      <?php if ( has_post_thumbnail() && ! has_post_format( 'quote' ) ) { global $post; ?>
        <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Link to %s', 'basestation' ), the_title_attribute( 'echo=0' ) ); ?>"><?php echo get_the_post_thumbnail( $post->ID, 'thumbnail', array( 'class' => 'alignleft', 'title' => "" ) ); ?></a>
      <?php } // has_post_thumbnail

      if ( has_post_format( 'quote' ) ) { ?>
        <blockquote>
      <?php } //has_post_format

      the_excerpt();

      if ( has_post_format( 'quote' ) ) { ?>
        </blockquote>
      <?php } //has_post_format ?>

    </div><!-- /.entry-summary -->

  <?php } else { ?>

    <div class="entry-content">

      <?php if ( has_post_format( 'quote' ) ) { ?>
        <blockquote>
      <?php } //has_post_format

      the_content();

      if ( has_post_format( 'quote' ) ) { ?>
      </blockquote>
      <?php } //has_post_format

      basestation_wp_link_pages(); ?>
    </div><!-- /.entry-content -->

  <?php }
}
add_action( 'basestation_content', 'basestation_excerpt_or_content' );
endif;



/**
 * Set title to H1 if in single view, otherwise set it to H2
 * @since .75
 */
function basestation_do_entry_title() {
  $title = get_the_title();

  if ( strlen( $title ) == 0 )
    return;

  if ( is_singular() ) {
    $entry_title = '<header class="entry-header">';
    $entry_title .= sprintf( '<h1 class="entry-title">%s</h1>', $title );
    $entry_title .= '</header><!-- .entry-header -->';
  } else {
      $entry_title = '<header class="entry-header">';
      $entry_title .= sprintf( '<h2 class="entry-title"><a class="entry-title" title="%s" rel="bookmark" href="%s">%s</a></h2>', the_title_attribute( 'echo=0' ), get_permalink(), $title );
      $entry_title .= '</header><!-- .entry-header -->';
    }
    echo apply_filters( 'basestation_entry_title_text', $entry_title );
}
add_action( 'basestation_entry_title', 'basestation_do_entry_title' );



if ( ! function_exists( 'basestation_content_nav' ) ):
/**
 * Display navigation to next/previous pages when applicable
 *
 * @since 0.1
 */
function basestation_content_nav( $nav_id ) {
  global $wp_query;

  $nav_class = 'site-navigation paging-navigation pager';
  if ( is_single() )
    $nav_class = 'site-navigation post-navigation pager';

  ?>

  <nav id="<?php echo $nav_id; ?>" class="<?php echo $nav_class; ?>">
    <h3 class="assistive-text"><?php _e( 'Post navigation', 'basestation' ); ?></h3>

  <?php if ( is_single() ) : // navigation links for single posts ?>

    <?php previous_post_link( '<li class="nav-previous">%link</li>', '<span class="meta-nav right">' . _x( ' &raquo;', 'Previous post link', 'basestation' ) . '</span> %title' ); ?>
    <?php next_post_link( '<li class="nav-next">%link</li>', '%title<span class="meta-nav left">' . _x( '&laquo; ', 'Next post link', 'basestation' ) . '</span>' ); ?>

  <?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>

    <?php if ( get_next_posts_link() ) : ?>
    <li class="nav-previous right"><?php next_posts_link( __( 'Next page <span class="meta-nav">&raquo;</span>', 'basestation' ) ); ?></li>
    <?php endif; ?>

    <?php if ( get_previous_posts_link() ) : ?>
    <li class="nav-next left"><?php previous_posts_link( __( '<span class="meta-nav">&laquo;</span> Previous page', 'basestation' ) ); ?></li>
    <?php endif; ?>

  <?php endif; ?>

  </nav><!-- #<?php echo $nav_id; ?> -->
  <?php
}
endif; // basestation_content_nav



if ( ! function_exists( 'basestation_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since 0.1
 */
function basestation_comment( $comment, $args, $depth ) {
  $GLOBALS['comment'] = $comment;
  switch ( $comment->comment_type ) :
    case 'pingback' :
    case 'trackback' :
  ?>
  <li class="post pingback">
    <p><?php _e( 'Pingback:', 'basestation' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'basestation' ), ' ' ); ?></p>
  <?php
      break;
    default :
  ?>
  <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
    <article id="comment-<?php comment_ID(); ?>" class="comment">
      <footer>
        <div class="comment-author vcard">
          <?php echo get_avatar( $comment, 40 ); ?>
          <?php printf( __( '%s', 'basestation' ), sprintf( '<cite class="name">%s</cite>', get_comment_author_link() ) ); ?>
        </div><!-- .comment-author .vcard -->
        <?php if ( $comment->comment_approved == '0' ) : ?>
          <em><?php _e( 'Your comment is awaiting moderation.', 'basestation' ); ?></em>
          <br />
        <?php endif; ?>

        <div class="comment-meta commentmetadata">
          <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time pubdate datetime="<?php comment_time( 'c' ); ?>">
          <?php
            /* translators: 1: date, 2: time */
            printf( __( '%1$s at %2$s', 'basestation' ), get_comment_date(), get_comment_time() ); ?>
          </time></a>
          <?php edit_comment_link( __( '(Edit)', 'basestation' ), ' ' );
          ?>
        </div><!-- .comment-meta .commentmetadata -->
      </footer>

      <div class="comment-content"><?php comment_text(); ?></div>

      <div class="reply">
        <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
      </div><!-- .reply -->
    </article><!-- #comment-## -->

  <?php
      break;
  endswitch;
}
endif; // ends check for basestation_comment()



if ( ! function_exists( 'basestation_do_post_author' ) ) :
/**
 * Prints HTML with meta information for the current post's author.
 *
 * @since 0.59
 */
function basestation_do_post_author() {
  printf( __( '<span class="byline"><i class="meta-icon icon-user"></i> <span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span></span>', 'basestation' ),
    esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
    esc_attr( sprintf( __( 'View all posts by %s', 'basestation' ), get_the_author() ) ),
    esc_html( get_the_author() )
  );
}
add_action( 'basestation_post_author', 'basestation_do_post_author' );
endif;



if ( ! function_exists( 'basestation_do_posted_on' ) ) :
/**
 * Prints HTML with date posted information for the current post.
 *
 * @since 0.1
 */
function basestation_do_posted_on() {
  printf( __( '<span class="published-date"><i class="meta-icon icon-calendar" title="Published date"></i> <a href="%1$s" title="%2$s"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a></span>', 'basestation' ),
    esc_url( get_permalink() ),
    esc_attr( get_the_time() ),
    esc_attr( get_the_date( 'c' ) ),
    esc_html( get_the_date() )
  );
}
add_action( 'basestation_posted_on', 'basestation_do_posted_on' );
endif;



/**
 * Returns true if a blog has more than 1 category
 *
 * @since 0.1
 */
function basestation_categorized_blog() {
  if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
    // Create an array of all the categories that are attached to posts
    $all_the_cool_cats = get_categories( array(
      'hide_empty' => 1,
    ) );

    // Count the number of categories that are attached to the posts
    $all_the_cool_cats = count( $all_the_cool_cats );

    set_transient( 'all_the_cool_cats', $all_the_cool_cats );
  }

  if ( '1' != $all_the_cool_cats ) {
    // This blog has more than 1 category so basestation_categorized_blog should return true
    return true;
  } else {
    // This blog has only 1 category so basestation_categorized_blog should return false
    return false;
  }
}



/**
 * Flush out the transients used in basestation_categorized_blog
 *
 * @since 0.1
 */
function basestation_category_transient_flusher() {
  // Like, beat it. Dig?
  delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'basestation_category_transient_flusher' );
add_action( 'save_post', 'basestation_category_transient_flusher' );



if ( ! function_exists( 'basestation_do_post_tags' ) ):
/**
 * Customize the list of tags displayed on index and on a post
 * @since 0.3
 */
function basestation_do_post_tags() {
  $post_tags = get_the_tags();
  if ( $post_tags ) {
    echo '<span class="tags-links"><i class="meta-icon icon-tag" title="Tags"></i>' . "\n";
    $num_tags = count( $post_tags );
    $tag_count = 1;
    $nofollow = ' nofollow'; // tell search engines to not index tag url
    foreach( $post_tags as $tag ) {
    $html_before = '<a href="' . get_tag_link($tag->term_id) . '" rel="tag'.$nofollow.'" class="tag-text">';
    $html_after = '</a>';
    if ( $tag_count < $num_tags )
      $sep = ", \n";
    elseif ( $tag_count == $num_tags )
    $sep = "\n";
    echo $html_before . $tag->name . $html_after . $sep;
    $tag_count++;
    }
    echo '</span>' . "\n";
  }
}
add_action( 'basestation_post_tags', 'basestation_do_post_tags' );
endif;



if ( ! function_exists( 'basestation_do_post_categories' ) ):
/**
 * Customize the list of categories displayed on index and on a post
 * @since 0.3
 */
function basestation_do_post_categories() {
  $post_categories = get_the_category();
  if ( $post_categories ) {
    echo "\t<span class=\"cat-links\"><i class=\"meta-icon icon-folder\" title=\"Categories\"></i>\n";
    $num_categories = count( $post_categories );
    $category_count = 1;
    foreach ( $post_categories as $category ) {
    // "category tag" is only proposed at this point - $html_before = "\t\t<a href=\"" . get_category_link($category->term_id) . "\" rel=\"category tag\" class=\"label\">";
    $html_before = "\t\t<a href=\"" . get_category_link( $category->term_id ) . "\" class=\"cat-text\">";
    $html_after = '</a>';
    if ( $category_count < $num_categories )
      $sep = ", \n";
    elseif ( $category_count == $num_categories )
    $sep = "\n";
    echo $html_before . $category->name . $html_after . $sep;
    $category_count++;
    }
    echo "\t\t\t</span>\n";
  }
}
add_action( 'basestation_post_categories', 'basestation_do_post_categories' );
endif;



if ( ! function_exists( 'basestation_do_post_comments_link' ) ):
/**
 * Display the "Leave a comment" message
 * @since .74
 */
 function basestation_do_post_comments_link() {
  if ( comments_open() || ( '0' != get_comments_number() && ! comments_open() ) ) : ?>
    <span class="comments-link"><i class="meta-icon icon-chat"></i><?php comments_popup_link( __( ' Leave a comment', 'basestation' ), __( ' 1 Comment', 'basestation' ), __( ' % Comments', 'basestation' ) ); ?></span>
  <?php endif;
 }
 add_action( 'basestation_post_comments_link', 'basestation_do_post_comments_link' );
 endif;



if ( ! function_exists( 'basestation_header_title_and_description' ) ):
/**
 * Display site title and description below Top Menu navbar
 * @since .55
 */
function basestation_header_title_and_description() {
  $home_url = esc_url( home_url( '/' ) );
  $site_name = esc_attr( get_bloginfo( 'name', 'display' ) );
  $site_description = get_bloginfo( 'description' );
  if ( !is_front_page() || !is_home() ) {
  echo <<<TITLE_AND_DESC
    <hgroup>
      <p id="site-title" class="site-title"><span><a href="{$home_url}" title="{$site_name}" rel="home">{$site_name}</a></span></p>
      <p id="site-description" class="site-description">{$site_description}</p>
    </hgroup>
TITLE_AND_DESC;
  }
  else {
  echo <<<TITLE_AND_DESC
    <hgroup>
      <h1 id="site-title" class="site-title"><span><a href="{$home_url}" title="{$site_name}" rel="home">{$site_name}</a></span></h1>
      <h2 id="site-description" class="site-description">{$site_description}</h2>
    </hgroup>
TITLE_AND_DESC;
  }
} endif;



if ( ! function_exists( 'basestation_featured_posts_grid' ) ):
/**
 * Display featured posts in a grid
 * @since .59
 */
function basestation_featured_posts_grid() {
  $featured_query = new WP_Query( 'tag_id='.of_get_option('basestation_featured_posts_tag').'&posts_per_page='.of_get_option('basestation_featured_posts_maxnum').'' ); ?>
  <?php if ( $featured_query->have_posts() ) {
  echo "\t<ul id=\"featured-posts-grid\" class=\"block-grid mobile two-up\">"; ?>

  <?php while ( $featured_query->have_posts() ) : $featured_query->the_post(); ?>

    <?php get_template_part( '/inc/parts/content', 'fp-grid' ); ?>

  <?php endwhile; ?>
  <?php echo "</ul>";
  }
}
endif;



if ( ! function_exists( 'basestation_featured_posts_slider' ) ):
/**
 * Display featured posts in a slider
 * @since .59 (The function. The feature @since .4)
 */
function basestation_featured_posts_slider() {
  $featured_query = new WP_Query( 'tag_id='.of_get_option('basestation_featured_posts_tag').'&posts_per_page='.of_get_option('basestation_featured_posts_maxnum').'' ); ?>
  <?php if ( $featured_query->have_posts() ) {
    echo "\t<div class=\"row\">";
      echo "\t<div class=\"twelve columns\">";
        echo "\t<div id=\"featured-carousel\" class=\"carousel slide\">"; ?>

            <?php while ( $featured_query->have_posts() ) : $featured_query->the_post(); ?>

            <?php get_template_part( '/inc/parts/content', 'featured' ); ?>

            <?php endwhile;

        echo "\t</div><!-- #featured-carousel -->";
      echo "\t</div><!-- .twelve columns -->";
    echo "\t</div><!-- .row -->"; ?>
      <script type="text/javascript">
          jQuery(window).load(function() {
          jQuery("#featured-carousel").orbit({
            animation: 'fade',
            pauseOnHover: true,
            startClockOnMouseOut: true,
            startClockOnMouseOutAfter: true,
            bullets: true
          });
        });
      </script>
      <?php } // if(have_posts()) ?>
      <!-- End featured listings -->
<?php }
endif;



if ( ! function_exists( 'basestation_do_archive_page_title' ) ):
/**
 * Display page title on archive pages
 * @since .592
 */
function basestation_do_archive_page_title() { ?>
<header class="page-header">
  <h1 class="page-title">
  <?php
  if ( is_category() ) {
    printf( __( 'Category Archives: %s', 'basestation' ), '<span>' . single_cat_title( '', false ) . '</span>' );

  } elseif ( is_tag() ) {
    printf( __( 'Tag Archives: %s', 'basestation' ), '<span>' . single_tag_title( '', false ) . '</span>' );

  } elseif ( is_author() ) {
    printf( __( 'Author Archives: %s', 'basestation' ), '<span class="vcard"><a class="url fn n" href="' . get_author_posts_url( get_the_author_meta( "ID" ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' );

  } elseif ( is_day() ) {
    printf( __( 'Daily Archives: %s', 'basestation' ), '<span>' . get_the_date() . '</span>' );

  } elseif ( is_month() ) {
    printf( __( 'Monthly Archives: %s', 'basestation' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );

  } elseif ( is_year() ) {
    printf( __( 'Yearly Archives: %s', 'basestation' ), '<span>' . get_the_date( 'Y' ) . '</span>' );

  } else {
    _e( 'Archives', 'basestation' );

  } ?>
  </h1>
    <?php
    if ( is_category() ) {
      // show an optional category description
      $category_description = category_description();
      if ( ! empty( $category_description ) )
        echo apply_filters( 'basestation_category_archive_meta', '<div class="taxonomy-description">' . $category_description . '</div>' );

    } elseif ( is_tag() ) {
      // show an optional tag description
      $tag_description = tag_description();
      if ( ! empty( $tag_description ) )
        echo apply_filters( 'basestation_tag_archive_meta', '<div class="taxonomy-description">' . $tag_description . '</div>' );
    }
  ?>
</header>
<?php }
add_action( 'basestation_archive_page_title', 'basestation_do_archive_page_title' );
endif;



if ( ! function_exists( 'basestation_archive_sticky_posts' ) ):
/**
 * Display sticky posts on archive pages
 * @since .594
 */
function basestation_archive_sticky_posts() {
  $sticky = get_option( 'sticky_posts' );
  if ( ! empty( $sticky ) ) {
    global $do_not_duplicate, $page, $paged;
    $do_not_duplicate = array();

    if ( is_category() ) {
      $cat_ID = get_query_var( 'cat' );
      $sticky_args = array(
        'post__in'    => $sticky,
        'cat'         => $cat_ID,
        'post_status' => 'publish',
        'paged'       => $paged
      );

    } elseif ( is_tag() ) {
      $current_tag = single_tag_title( "", false );
        $sticky_args = array(
          'post__in'     => $sticky,
          'tag_slug__in' => array( $current_tag ),
          'post_status'  => 'publish',
          'paged'        => $paged
        );
    }
  if ( ! empty( $sticky_args ) ):
  $sticky_posts = new WP_Query( $sticky_args );
    if ( $sticky_posts->have_posts() ):
      global $post;
      while ( $sticky_posts->have_posts() ) : $sticky_posts->the_post();
        array_push( $do_not_duplicate, $post->ID );
        $format = get_post_format();
        if ( false === $format )
        $format = 'standard';
        get_template_part( '/inc/parts/content', $format );
      endwhile;
    endif; // if have posts
    endif; // if ( ! empty( $sticky_args ) )
  } //if not empty sticky
}
endif;



if ( ! function_exists( 'basestation_archive_get_posts' ) ):
/**
 * Display archive posts and exclude sticky posts
 * @since .594
 */
function basestation_archive_get_posts() {
  global $do_not_duplicate, $page, $paged;

  if ( is_category() ) {
    $cat_ID = get_query_var( 'cat' );
    $args = array(
      'cat'                 => $cat_ID,
      'post_status'         => 'publish',
      'post__not_in'        => array_merge( $do_not_duplicate, get_option( 'sticky_posts' ) ),
      'ignore_sticky_posts' => 1,
      'paged'               => $paged
      );
    $wp_query = new WP_Query( $args );
  } elseif (is_tag() ) {
      $current_tag = single_tag_title( "", false );
      $args = array(
        'tag_slug__in'        => array( $current_tag ),
        'post_status'         => 'publish',
        'post__not_in'        => array_merge( $do_not_duplicate, get_option( 'sticky_posts' ) ),
        'ignore_sticky_posts' => 1,
        'paged'               => $paged
        );
      $wp_query = new WP_Query( $args );
  } else {
      new WP_Query();
  }
}
endif;


if ( ! function_exists( 'basestation_get_first_link' ) ):
/**
 * Get the first link in a post
 * Used to link the title to external links on the "Link" post format
 * @since .64
 */
function basestation_get_first_link() {
  global $link_url, $post_content;
  $content = get_the_content();
  $link_start = stristr( $content, "http" );
  $link_end = stristr( $link_start, "\n" );
  if ( ! strlen( $link_end ) == 0 ):
    $link_url = substr($link_start, 0, -(strlen($link_end) + 1));
  else:
    $link_url = $link_start;
  endif;
  $post_content = substr( $content, strlen( $link_url ) );
}
endif;



/**
 * Hack the markup from wp_link_pages to be semantic unordered list.
 * I hate everything about this, but until I find a better way...
 */
function basestation_wp_link_pages() {
  global $paged_page_nav;
  /* Get our initial links */
  $paged_page_nav = wp_link_pages( array( 'before' => '' . __( 'Pages:', 'basestation' ) .'<ul class="pagination">', 'link_before' => '<li>', 'link_after' => '</li>', 'after' => '</ul>', 'echo' => false ) );

  /* Rearrange things */
  $paged_page_nav = str_replace( '<a', '<li><a', $paged_page_nav );
  $paged_page_nav = str_replace( '</a>', '</a></li>', $paged_page_nav );
  $paged_page_nav = str_replace( '"><li>', '">', $paged_page_nav );

  echo $paged_page_nav;
}