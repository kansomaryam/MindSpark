<?php
/**
 * Loadmore Single Posts
 * This class implements AJAX-based "Load More" functionality for single posts in a WordPress theme, utilizing shortcodes and WP_Query.
 * @package Aquila
 */

namespace AQUILA_THEME\Inc;

use AQUILA_THEME\Inc\Traits\Singleton;
use \WP_Query;

class Loadmore_Single {

    use Singleton;

    protected function __construct() {
        // Load class.
        $this->setup_hooks();
    }

    protected function setup_hooks() {
        // Load more AJAX hooks for unauthenticated and authenticated users.
        add_action( 'wp_ajax_nopriv_single_load_more', [ $this, 'ajax_script_single_post_load_more' ] );
        add_action( 'wp_ajax_single_load_more', [ $this, 'ajax_script_single_post_load_more' ] );

        // Create a shortcode for loading single post content.
        add_shortcode( 'single_post_listings', [ $this, 'single_post_load_more_container' ] );

        // Add filter for customizing query conditions.
        add_filter( 'posts_where', [ $this, 'posts_where' ], 10, 2 );
    }

    /**
     * AJAX callback for loading more single post content.
     *
     * @param bool $initial_request Initial Request (non-AJAX request to load initial post).
     */
    public function ajax_script_single_post_load_more( bool $initial_request = false ) {

        // Verify nonce for security.
        if ( ! $initial_request && ! check_ajax_referer( 'loadmore_post_nonce', 'ajax_nonce', false ) ) {
            wp_send_json_error( __( 'Invalid security token sent.', 'text-domain' ) );
            wp_die( '0', 400 );
        }

        // Check if the request is AJAX.
        $is_ajax_request = ! empty( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && strtolower( $_SERVER['HTTP_X_REQUESTED_WITH'] ) === 'xmlhttprequest';

        // Get the page number and single post ID.
        $page_no        = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
        $page_no        = ! empty( $_POST['page'] ) ? filter_var( $_POST['page'], FILTER_VALIDATE_INT ) + 1 : $page_no;
        $single_post_id = ! empty( $_POST['single_post_id'] ) ? $_POST['single_post_id'] : 0;

        // Fetch the posts with the query.
        $query = $this->get_single_load_more_query( $page_no, $single_post_id );

        // Output the posts if available.
        if ( $query->have_posts() ) :
            while ( $query->have_posts() ) : $query->the_post();
                get_template_part( 'template-parts/content' );
            endwhile;
        else :
            wp_die( '0' );
        endif;

        wp_reset_postdata();

        // End AJAX request properly.
        if ( $is_ajax_request && ! $initial_request ) {
            wp_die();
        }
    }

    /**
     * Single load more posts container.
     */
    public function single_post_load_more_container() {
        $single_post_id  = get_the_ID();
        $load_more_query = $this->get_single_load_more_query( 1, $single_post_id );
        $has_next_page   = ! empty( $load_more_query->posts );
        $total_pages     = $load_more_query->max_num_pages;

        // If there are no more pages to load, return null.
        if ( empty( $has_next_page ) ) {
            return null;
        }

        // Display the container with a load more button.
        ?>
        <div class="single-post-loadmore-wrap">
            <div id="single-post-load-more-content" class="single-post-loadmore"></div>
            <div class="text-center mb-5 mt-5">
                <button
                    id="single-post-load-more-btn"
                    data-page="0"
                    data-single-post-id="<?php echo esc_attr( $single_post_id ); ?>"
                    class="btn btn-info"
                    data-max-pages="<?php echo esc_attr( $total_pages ); ?>"
                >
                    <span><?php esc_html_e( 'Load More Stories', 'aquila' ); ?></span>
                </button>
                <span id="single-loading-text" class="mt-1 hidden">
                    <?php esc_html_e( 'Loading...', 'aquila' ); ?>
                </span>
            </div>
        </div>
        <?php
    }

    /**
     * Get single load more posts query.
     *
     * @param int $page_no Page number.
     * @param int $single_post_id Single post ID.
     *
     * @return WP_Query
     */
    public function get_single_load_more_query( $page_no, $single_post_id ) {
        // Query arguments for loading posts.
        $args = [
            'post_status'      => 'publish',
            'posts_per_page'   => 1,
            'paged'            => $page_no,
            'starting_post_id' => intval( $single_post_id ),
        ];

        return new WP_Query( $args );
    }

    /**
     * Modify the WHERE clause of the posts query to exclude certain posts.
     *
     * @param string $where The existing WHERE clause.
     * @param WP_Query $query The WP_Query object.
     *
     * @return string Modified WHERE clause.
     */
    public function posts_where( $where, $query ) {
        global $wpdb;

        // Get the starting post ID.
        $start = $query->get( 'starting_post_id' );

        // Modify the WHERE clause if the starting post ID is set.
        if ( ! empty( $start ) ) {
            $where .= " AND {$wpdb->posts}.ID < $start";
        }

        return $where;
    }

}
