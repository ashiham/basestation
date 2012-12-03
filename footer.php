<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package Base Station
 * @since Base Station 0.1
 */
?>

	</div><!-- #main -->
  <?php do_action( 'basestation_main_after' ); ?>
  <div id="footer-container" class="container-fluid">
    <div id="footer-row" class="row footerwidget">
      <?php dynamic_sidebar("Footer"); ?>
    </div><!-- #footer-row -->
    <div id="footer2-row" class="row footerwidget">
      <?php dynamic_sidebar("Footer 2"); ?>
    </div><!-- #footer2-row -->
  </div><!-- #footer-container -->

</div><!-- #page -->
<?php do_action( 'basestation_footer_before' ); ?>
<footer class="colophon" id="colophon" role="contentinfo">
  <?php do_action( 'basestation_footer_inside' ); ?>
  <div class="container-fluid">
    <div class="row">
      <div class="six columns">
        <?php if ( of_get_option('basestation_custom_footer_toggle') ) {
        echo '' . of_get_option('basestation_custom_footer_text') . '';
        } else {
          echo 'Copyright &copy; ' . date('Y') . ' ' . get_bloginfo('name') . '. All Rights Reserved.'; } ?>
      </div><!-- .six columns -->
      <div class="six columns">
        <?php if ( has_nav_menu( 'bottom' ) ) { wp_nav_menu(array('theme_location' => 'bottom', 'container' => false, 'menu_class' =>  'footer-nav mobile')); } ?>
      </div>
    </div><!-- row -->
  </div><!-- container-fluid -->
</footer><!-- #colophon -->
<?php do_action( 'basestation_footer_after' ); ?>

<?php wp_footer(); ?>

<?php do_action( 'basestation_footer' ); ?>

</body>
</html>