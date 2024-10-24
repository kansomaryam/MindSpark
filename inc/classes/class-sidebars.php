<?php
/**
 * Registers theme sidebars and custom widgets for the Aquila WordPress theme.
 *
 * @package Aquila
 */

namespace AQUILA_THEME\Inc;

use AQUILA_THEME\Inc\Traits\Singleton;

class Sidebars {
	use Singleton;

	/**
	 * Constructor to set up hooks.
	 */
	protected function __construct() {
		$this->setup_hooks();
	}

	/**
	 * Set up hooks for widget registration.
	 *
	 * @return void
	 */
	protected function setup_hooks() {
		// Register sidebars and custom widgets.
		add_action( 'widgets_init', [ $this, 'register_sidebars' ] );
		add_action( 'widgets_init', [ $this, 'register_clock_widget' ] );
	}

	/**
	 * Register sidebars for the theme.
	 *
	 * @action widgets_init
	 * @return void
	 */
	public function register_sidebars() {
		// Sidebar widget area.
		register_sidebar(
			[
				'name'          => esc_html__( 'Sidebar', 'aquila' ),
				'id'            => 'sidebar-1',
				'description'   => esc_html__( 'Main sidebar widget area', 'aquila' ),
				'before_widget' => '<div id="%1$s" class="widget widget-sidebar %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			]
		);

		// Footer widget area.
		register_sidebar(
			[
				'name'          => esc_html__( 'Footer', 'aquila' ),
				'id'            => 'sidebar-2',
				'description'   => esc_html__( 'Footer widget area', 'aquila' ),
				'before_widget' => '<div id="%1$s" class="widget widget-footer cell column %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h4 class="widget-title">',
				'after_title'   => '</h4>',
			]
		);
	}

	/**
	 * Register the custom clock widget.
	 *
	 * @action widgets_init
	 * @return void
	 */
	public function register_clock_widget() {
		register_widget( 'AQUILA_THEME\Inc\Clock_Widget' );
	}
}
