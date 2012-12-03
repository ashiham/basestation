<?php
/**
 * Featured listings
 * @since Base Station 0.4
 */
?>
    <div class="item">
      <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Link to %s', 'basestation' ), the_title_attribute( 'echo=0' ) ); ?>"><?php echo get_the_post_thumbnail( ''. $post->ID .'', array(of_get_option('basestation_featured_posts_image_width'), of_get_option('basestation_featured_posts_image_height')), array('title' => "" )); ?></a>
      <div class="carousel-caption">
        <h4><?php the_title(); ?></h4>
      </div><!-- .carousel-caption -->
    </div><!-- .item -->
