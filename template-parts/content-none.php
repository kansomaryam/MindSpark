<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * @package Aquila
 */

?>

<section class="no-results not-found">
    <header class="page-header">
        <h1 class="page-title"><?php esc_html_e('Nothing Found', 'aquila'); ?></h1>
    </header>

    <div class="page-content">
        <p><?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with different keywords.', 'aquila'); ?></p>
        <?php get_search_form(); ?>
    </div>
</section>
