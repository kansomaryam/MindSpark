<?php
/**
 * Enqueue theme assets
 *
 * @package Aquila
 */

namespace AQUILA_THEME\Inc;

use AQUILA_THEME\Inc\Traits\Singleton;

class Assets {
	use Singleton;

	protected function __construct() {
		// Load class hooks.
		$this->setup_hooks();
	}

	protected function setup_hooks() {
		/**
		 * Actions.
		 */
		add_action( 'wp_enqueue_scripts', [ $this, 'register_styles' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'register_scripts' ] );
		
		/**
		 * The 'enqueue_block_assets' hook includes styles and scripts
		 * both in editor and frontend, except when is_admin() is used 
		 * to include them conditionally.
		 */
		add_action( 'enqueue_block_assets', [ $this, 'enqueue_editor_assets' ] );
	}

	/**
	 * Register and enqueue styles.
	 */
	public function register_styles() {
		// Register styles.
		wp_register_style( 'bootstrap-css', AQUILA_BUILD_LIB_URI . '/css/bootstrap.min.css', [], false, 'all' );
		wp_register_style( 'slick-theme-css', AQUILA_BUILD_LIB_URI . '/css/slick-theme.css', ['slick-css'], false, 'all' );
		wp_register_style( 'search-css', AQUILA_BUILD_CSS_URI . '/search-results.css', [], filemtime( AQUILA_BUILD_CSS_DIR_PATH . '/search-results.css' ), 'all' );

		// Enqueue styles.
		wp_enqueue_style( 'bootstrap-css' );
		wp_enqueue_style( 'slick-css' );
		wp_enqueue_style( 'slick-theme-css' );
		wp_enqueue_style( 'main-css' );

		// Enqueue search page styles.
		if ( is_page( 'search' ) ) {
			wp_enqueue_style( 'search-css' );
		}
	}

	/**
	 * Register and enqueue scripts.
	 */
	public function register_scripts() {
		// Register scripts.
		wp_register_script( 'slick-js', AQUILA_BUILD_LIB_URI . '/js/slick.min.js', ['jquery'], false, true );
		wp_register_script( 'single-js', AQUILA_BUILD_JS_URI . '/single.js', ['jquery', 'slick-js'], filemtime( AQUILA_BUILD_JS_DIR_PATH . '/single.js' ), true );
		wp_register_script( 'bootstrap-js', AQUILA_BUILD_LIB_URI . '/js/bootstrap.min.js', ['jquery'], false, true );

		// Enqueue scripts.
		wp_enqueue_script( 'main-js' );
		wp_enqueue_script( 'bootstrap-js' );
		wp_enqueue_script( 'slick-js' );

		// If single post page.
		if ( is_single() ) {
			wp_enqueue_script( 'single-js' );
		}

		// If search page.
		if ( is_page( 'search' ) ) {
			$filters_data = get_filters_data();
			wp_enqueue_script( 'search-js' );
			wp_localize_script( 'search-js', 'search_settings', [
				'rest_api_url' => home_url( '/wp-json/af/v1/search' ),
				'root_url'     => home_url( 'search' ),
				'filter_ids'   => get_filter_ids( $filters_data ),
			]);
		}

		// Localize main-js for AJAX.
		wp_localize_script( 'main-js', 'siteConfig', [
			'ajaxUrl'    => admin_url( 'admin-ajax.php' ),
			'ajax_nonce' => wp_create_nonce( 'loadmore_post_nonce' ),
		]);
	}

	/**
	 * Enqueue editor scripts and styles.
	 */
	public function enqueue_editor_assets() {
		$asset_config_file = sprintf( '%s/assets.php', AQUILA_BUILD_PATH );

		if ( ! file_exists( $asset_config_file ) ) {
			return;
		}

		$asset_config = require_once $asset_config_file;

		if ( empty( $asset_config['js/editor.js'] ) ) {
			return;
		}

		$editor_asset    = $asset_config['js/editor.js'];
		$js_dependencies = ! empty( $editor_asset['dependencies'] ) ? $editor_asset['dependencies'] : [];
		$version         = ! empty( $editor_asset['version'] ) ? $editor_asset['version'] : filemtime( $asset_config_file );
	}
}