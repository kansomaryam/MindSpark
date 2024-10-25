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
require_once get_template_directory() . '/inc/classes/class-blocks.php';


function aquila_get_theme_instance() {
	\AQUILA_THEME\Inc\AQUILA_THEME::get_instance();
}

aquila_get_theme_instance();



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
    add_theme_support('custom-logo', array(
        'height'      => 100, // Change height as needed
        'width'       => 100, // Change width as needed
        'flex-height' => true,
        'flex-width'  => true,
    ));
    
}
add_action( 'after_setup_theme', 'aquila_theme_setup' );




/*footer*/
function aquila_widgets_init() {

register_sidebar( array(
    'name'          => __( 'Footer 1', 'aquila' ),
    'id'            => 'footer-1',
    'description'   => __( 'Add widgets here to appear in your footer.', 'aquila' ),
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
) );
    // Register Footer 2 Widget Area
    register_sidebar( array(
        'name'          => __( 'Footer 2', 'aquila' ),
        'id'            => 'footer-2', // Ensure this ID matches
        'description'   => __( 'Widgets in this area will be shown in the footer.', 'aquila' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'aquila_widgets_init' );

function aquila_enqueue_footer_styles() {
    // Register the footer CSS file
    wp_enqueue_style( 'aquila-footer-css', get_template_directory_uri() . '/assets/build/css/footer.css', array(), '1.0.0', 'all' );
}
add_action( 'wp_enqueue_scripts', 'aquila_enqueue_footer_styles' );


/****************/
/*blocks*/
/***************/
/**************/

/*financial statistics block*/
function register_financial_statistics_block() {
    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'              => 'financial-statistics',
            'title'             => __('Financial Statistics'),
            'description'       => __('A custom block to display financial metrics.'),
            'render_template'   => 'template-parts/blocks/financial-statistics-block/financial-statistics-block.php',
            'category'          => 'layout',
            'icon'              => 'chart-bar',
            'keywords'          => array('finance', 'statistics', 'metrics'),
            'enqueue_style'     => get_template_directory_uri() . '/template-parts/blocks/financial-statistics-block/financial-statistics-block.css', // Enqueue block-specific CSS
        ));
    }
}
add_action('acf/init', 'register_financial_statistics_block');

/****************/


/*financial stats block*/

function register_financial_stats_block() {
    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'              => 'financial-stats',
            'title'             => __('Financial Stats'),
            'description'       => __('A block to display financial statistics.'),
            'render_template'   => 'template-parts/blocks/financial-stats-block/financial-stats-block.php',
            'category'          => 'formatting',
            'icon'              => 'chart-bar',
            'keywords'          => array('financial', 'stats'),
            'enqueue_style'     => get_template_directory_uri() . 'template-parts/blocks/financial-stats-block/financial-stats-block.css',
        ));
    }
}
add_action('acf/init', 'register_financial_stats_block');
function enqueue_chart_js() {
    wp_enqueue_script('chart-js', 'https://cdn.jsdelivr.net/npm/chart.js', array(), null, true);
}
add_action('wp_enqueue_scripts', 'enqueue_chart_js');


function aquila_enqueue_scripts() {
    wp_enqueue_script('chart-js', 'https://cdn.jsdelivr.net/npm/chart.js', [], null, true);
}
add_action('wp_enqueue_scripts', 'aquila_enqueue_scripts');

/***************/

/*full banner */
function my_acf_blocks_init() {
    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'              => 'full-banner',
            'title'             => __('Full-Size Banner'),
            'description'       => __('A custom banner block that spans the full width of the screen.'),
            'render_template'   => 'template-parts/blocks/full-banner/full-banner.php',
            'category'          => 'formatting',
            'icon'              => 'welcome-widgets-menus',
            'keywords'          => array('banner', 'full-width', 'hero'),
            'enqueue_style'     => get_template_directory_uri() . 'template-parts/blocks/full-banner/full-banner.css',
            'supports'          => array('align' => array('full')),
            'align'             => 'full'
        ));
    }
}
add_action('acf/init', 'my_acf_blocks_init');

/*banner block*/
function register_acf_banner_block() {
    if( function_exists('acf_register_block_type') ) {
        acf_register_block_type(array(
            'name'              => 'banner-block',
            'title'             => __('Banner Block'),
            'description'       => __('A custom banner block for promotions.'),
            'render_template'   => 'template-parts/blocks/full-banner/full-banner.php',
            'category'          => 'formatting',
            'icon'              => 'megaphone',
            'keywords'          => array( 'banner', 'hero', 'acf' ),
            'enqueue_style'     => get_template_directory_uri() . 'template-parts/blocks/banner-block/banner-block.css',
        ));
    }
}
add_action('acf/init', 'register_acf_banner_block');

/***************/


/*media block*/

if (function_exists('acf_register_block_type')) {
    acf_register_block_type(array(
        'name'              => 'media-block',
        'title'             => __('Media Block'),
        'description'       => __('A block for displaying media with title and text.'),
        'render_template'   => 'template-parts/blocks/media-block/media-block.php',
        'category'          => 'formatting',
        'icon'              => 'format-image',
        'keywords'          => array('media', 'image', 'text'),
        'enqueue_style'     => get_template_directory_uri() . 'template-parts/blocks/media-block/media-block.css',
    ));
}
/******************/

/*hero block*/
function register_hero_block() {
    // Check if function exists and hook into setup.
    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'              => 'hero-block',
            'title'             => __('Hero Block'),
            'description'       => __('A custom hero block with header, content, and background image.'),
            'render_template'   => 'template-parts/blocks/hero-block/hero-block.php', 
            'category'          => 'formatting',
            'icon'              => 'cover-image', // Choose an icon from Dashicons
            'keywords'          => array('hero', 'banner', 'image'),
            'enqueue_style'     => get_template_directory_uri() . 'template-parts/blocks/hero-block/hero-block.css',
            'supports'          => array(
                'align' => true,  
                'mode'  => true,  
                'jsx'   => true,
            ),
        ));
    }
}
add_action('acf/init', 'register_hero_block');

/**********************/







/*search*/

function theme_enqueue_styles() {
    // Enqueue Header CSS
    wp_enqueue_style( 'header-styles', get_template_directory_uri() . '/assets/build/css/header.css' );

    // Enqueue Search CSS for search pages only
    if ( is_search() ) {
        wp_enqueue_style( 'search-styles', get_template_directory_uri() . '/assets/build/css/search-results.css' );
    }
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

/* Enqueue Block Styles */
function enqueue_block_assets() {
    // Financial Statistics Block Styles
    wp_enqueue_style( 
        'financial-statistics-css', 
        get_template_directory_uri() . '/template-parts/blocks/financial-statistics-block/financial-statistics-block.css',
        array(), 
        filemtime( get_template_directory() . '/template-parts/blocks/financial-statistics-block/financial-statistics-block.css' )
    );

    // Full Banner Block Styles
    wp_enqueue_style( 
        'full-banner-css', 
        get_template_directory_uri() . '/template-parts/blocks/full-banner/full-banner.css',
        array(), 
        filemtime( get_template_directory() . '/template-parts/blocks/full-banner/full-banner.css' )
    );

    // Media Block Styles
    wp_enqueue_style( 
        'media-block-css', 
        get_template_directory_uri() . '/template-parts/blocks/media-block/media-block.css',
        array(), 
        filemtime( get_template_directory() . '/template-parts/blocks/media-block/media-block.css' )
    );
}
add_action( 'wp_enqueue_scripts', 'enqueue_block_assets' );