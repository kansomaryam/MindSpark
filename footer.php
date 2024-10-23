<?php
/**
 * Footer template.
 *
 * @package Aquila
 */
?>

<footer class="site-footer">
<div class="footer-widgets">
        <div class="footer-widget-area footer-1">
            <?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
                <?php dynamic_sidebar( 'footer-1' ); ?>
            <?php endif; ?>
        </div><!-- .footer-1 -->

        <div class="footer-widget-area footer-2">
            <?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
                <?php dynamic_sidebar( 'footer-2' ); ?>
            <?php endif; ?>
        </div><!-- .footer-2 -->
    </div><!-- .footer-widgets -->
    <div class="site-info">
        <p>&copy; <?php echo date( 'Y' ); ?> Serving Finance. All rights reserved.</p>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>

