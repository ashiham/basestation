<?php
/**
 * Footer for the marketing page template
 *
 * @package Base Station
 * @subpackage Templates
 * @since .93
 */
?>
      <?php do_action( 'basestation_marketing_footer_before' ); ?>

      <div id="marketing-footer" class="footer">
        <p><?php echo 'Copyright &copy; ' . date('Y') . ' ' . get_bloginfo('name') . '. All Rights Reserved.'; ?></p>
      </div>
      <?php wp_footer(); ?>
    </body>
  </html>