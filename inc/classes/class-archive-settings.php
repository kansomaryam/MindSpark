<?php
/**
 * Archive Settings
 * This file modifies the number of posts displayed per page on archive and search result pages.
 * @package Aquila
 */

namespace AQUILA_THEME\Inc;

use AQUILA_THEME\Inc\Traits\Singleton;

class Archive_Settings {
    use Singleton;

    protected function __construct() {
        // Initialize hooks
        $this->setup_hooks();
    }

    protected function setup_hooks() {
        // Filter to change posts per page for archive pages and search results
        add_filter('pre_get_posts', [ $this, 'change_archive_posts_per_page' ]);
    }

    /**
     * Change the number of posts per page for archive pages and search results.
     *
     * @param object $query WordPress query object
     * @return object Modified query
     */
    public function change_archive_posts_per_page($query) {
        if ($query->is_archive && !is_admin() && $query->is_main_query()) {
            // Set the number of posts per page for archive pages
            $query->set('posts_per_page', strval(AQUILA_ARCHIVE_POST_PER_PAGE));
        } elseif (!empty($query->query_vars['s']) && !is_admin()) {
            // Set the number of posts per page for search results
            $query->set('posts_per_page', strval(AQUILA_SEARCH_RESULTS_POST_PER_PAGE));
        }

        return $query;
    }
}
