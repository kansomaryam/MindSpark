<?php
/**
 * Theme Functions.
 *
 * @package Aquila
 */


if ( ! defined( 'AQUILA_DIR_PATH' ) ) {
	define( 'AQUILA_DIR_PATH', untrailingslashit( get_template_directory() ) );
}

if ( ! defined( 'AQUILA_DIR_URI' ) ) {
	define( 'AQUILA_DIR_URI', untrailingslashit( get_template_directory_uri() ) );
}

if ( ! defined( 'AQUILA_BUILD_URI' ) ) {
	define( 'AQUILA_BUILD_URI', untrailingslashit( get_template_directory_uri() ) . '/assets/build' );
}

if ( ! defined( 'AQUILA_BUILD_PATH' ) ) {
	define( 'AQUILA_BUILD_PATH', untrailingslashit( get_template_directory() ) . '/assets/build' );
}

if ( ! defined( 'AQUILA_BUILD_JS_URI' ) ) {
	define( 'AQUILA_BUILD_JS_URI', untrailingslashit( get_template_directory_uri() ) . '/assets/build/js' );
}

if ( ! defined( 'AQUILA_BUILD_JS_DIR_PATH' ) ) {
	define( 'AQUILA_BUILD_JS_DIR_PATH', untrailingslashit( get_template_directory() ) . '/assets/build/js' );
}

if ( ! defined( 'AQUILA_BUILD_IMG_URI' ) ) {
	define( 'AQUILA_BUILD_IMG_URI', untrailingslashit( get_template_directory_uri() ) . '/assets/build/src/img' );
}

if ( ! defined( 'AQUILA_BUILD_CSS_URI' ) ) {
	define( 'AQUILA_BUILD_CSS_URI', untrailingslashit( get_template_directory_uri() ) . '/assets/build/css' );
}

if ( ! defined( 'AQUILA_BUILD_CSS_DIR_PATH' ) ) {
	define( 'AQUILA_BUILD_CSS_DIR_PATH', untrailingslashit( get_template_directory() ) . '/assets/build/css' );
}

if ( ! defined( 'AQUILA_BUILD_LIB_URI' ) ) {
	define( 'AQUILA_BUILD_LIB_URI', untrailingslashit( get_template_directory_uri() ) . '/assets/build/library' );
}

if ( ! defined( 'AQUILA_ARCHIVE_POST_PER_PAGE' ) ) {
	define( 'AQUILA_ARCHIVE_POST_PER_PAGE', 9 );
}

if ( ! defined( 'AQUILA_SEARCH_RESULTS_POST_PER_PAGE' ) ) {
	define( 'AQUILA_SEARCH_RESULTS_POST_PER_PAGE', 9 );
}

require_once AQUILA_DIR_PATH . '/inc/helpers/autoloader.php';
require_once AQUILA_DIR_PATH . '/inc/helpers/template-tags.php';

function aquila_get_theme_instance() {
	\AQUILA_THEME\Inc\AQUILA_THEME::get_instance();
}

aquila_get_theme_instance();


//function 1
function register_financial_statistics_block() {
    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'              => 'financial-statistics',
            'title'             => __('Financial Statistics'),
            'description'       => __('A custom block to display financial metrics.'),
            'render_template'   => 'template-parts/blocks/financial-statistics-block.php',
            'category'          => 'layout',
            'icon'              => 'chart-bar',
            'keywords'          => array('finance', 'statistics', 'metrics'),
            'enqueue_style'     => get_template_directory_uri() . '/assets/build/css/blocks.css', // Enqueue block-specific CSS
        ));
    }
}
add_action('acf/init', 'register_financial_statistics_block');

// Enqueue the general stylesheet for blocks if needed across pages
function enqueue_block_styles() {
    wp_enqueue_style('blocks-styles', get_template_directory_uri() . '/assets/build/css/blocks.css');
}
add_action('wp_enqueue_scripts', 'enqueue_block_styles');



//function 2

add_action('acf/init', 'register_financial_stats_block');
function register_financial_stats_block() {
    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'              => 'financial-stats',
            'title'             => __('Financial Stats'),
            'description'       => __('A block to display financial statistics.'),
            'render_template'   => 'template-parts/blocks/financial-stats-block.php',
            'category'          => 'formatting',
            'icon'              => 'chart-bar',
            'keywords'          => array('financial', 'stats'),
            'enqueue_style'     => get_template_directory_uri() . '/assets/css/blocks.css',
        ));
    }
}
function enqueue_chart_js() {
    wp_enqueue_script('chart-js', 'https://cdn.jsdelivr.net/npm/chart.js', array(), null, true);
}
add_action('wp_enqueue_scripts', 'enqueue_chart_js');


function aquila_enqueue_scripts() {
    wp_enqueue_script('chart-js', 'https://cdn.jsdelivr.net/npm/chart.js', [], null, true);
}
add_action('wp_enqueue_scripts', 'aquila_enqueue_scripts');


function my_acf_blocks_init() {
    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'              => 'full-banner',
            'title'             => __('Full-Size Banner'),
            'description'       => __('A custom banner block that spans the full width of the screen.'),
            'render_template'   => 'template-parts/blocks/full-banner.php',
            'category'          => 'formatting',
            'icon'              => 'welcome-widgets-menus',
            'keywords'          => array('banner', 'full-width', 'hero'),
            'enqueue_style'     => get_template_directory_uri() . '/assets/css/blocks.css', // Update path as needed
            'supports'          => array('align' => array('full')),
            'align'             => 'full'
        ));
    }
}
add_action('acf/init', 'my_acf_blocks_init');


/*footer*/
function aquila_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Footer Widget Area 1', 'aquila' ),
        'id'            => 'footer-1',
        'before_widget' => '<div class="footer-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="footer-title">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'aquila_widgets_init' );


/*header*/
function enqueue_header_styles() {
    // Check if it's a page where the navigation is used
    if (is_page() || is_single() || is_front_page()) { // Adjust condition as needed
        wp_enqueue_style('header-style', get_template_directory_uri() . '/assets/build/css/header.css');
    }
}
add_action('wp_enqueue_scripts', 'enqueue_header_styles');	

/*header logo*/
function aquila_theme_setup() {
    add_theme_support( 'custom-logo', [
        'height'      => 100,
        'width'       => 300,
        'flex-height' => true,
        'flex-width'  => true,
    ] );
}
add_action( 'after_setup_theme', 'aquila_theme_setup' );


/*home ban*/


function register_acf_banner_block() {
    if( function_exists('acf_register_block_type') ) {
        acf_register_block_type(array(
            'name'              => 'banner-block',
            'title'             => __('Banner Block'),
            'description'       => __('A custom banner block for promotions.'),
            'render_template'   => 'template-parts/blocks/banner-block.php',
            'category'          => 'formatting',
            'icon'              => 'megaphone',
            'keywords'          => array( 'banner', 'hero', 'acf' ),
        ));
    }
}
add_action('acf/init', 'register_acf_banner_block');

function enqueue_banner_block_styles() {
    wp_enqueue_style('banner-block-style', get_template_directory_uri() . '/assets/build/css/blocks.css');
}
add_action('wp_enqueue_scripts', 'enqueue_banner_block_styles');


/*media block*/

if (function_exists('acf_register_block_type')) {
    acf_register_block_type(array(
        'name'              => 'media-block',
        'title'             => __('Media Block'),
        'description'       => __('A block for displaying media with title and text.'),
        'render_template'   => 'template-parts/blocks/media-block.php',
        'category'          => 'formatting',
        'icon'              => 'format-image',
        'keywords'          => array('media', 'image', 'text'),
        'enqueue_assets'    => function() {
            wp_enqueue_style('tailwindcss', get_template_directory_uri() . '/path-to-your-tailwind-css-file.css');
        },
    ));
}

