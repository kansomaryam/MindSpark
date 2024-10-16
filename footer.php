<?php
/**
 * Footer template
 *
 * @package Aquila
 */
?>



<footer id="site-footer" class="bg-light p-4">
    <div class="container color-gray">
        <div class="row">
            <?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
                <div class="footer-widgets col-md-12"> <!-- Added column class -->
                    <?php dynamic_sidebar( 'footer-1' ); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>




