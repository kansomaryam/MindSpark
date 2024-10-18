<footer class="site-footer">
    <div class="footer-widgets">
        <?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
            <div class="footer-2-widget-area">
                <?php dynamic_sidebar( 'footer-2' ); ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="site-info">
        <p>&copy; <?php echo date( 'Y' ); ?> Serving Finance. All rights reserved.</p>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
