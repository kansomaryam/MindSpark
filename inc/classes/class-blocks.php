<?php
/**
 * Blocks
 * The Blocks class adds a custom block category named "Aquila Blocks" to the WordPress block editor.
 * @package Aquila
 */

namespace AQUILA_THEME\Inc;

use AQUILA_THEME\Inc\Traits\Singleton;

class Blocks {
	use Singleton;

	protected function __construct() {
		$this->setup_hooks();
	}

	protected function setup_hooks() {
		add_filter( 'block_categories_all', [ $this, 'add_block_categories' ] );
	}

	/**
	 * Add custom block categories.
	 *
	 * @param array $categories Block categories.
	 *
	 * @return array
	 */
	public function add_block_categories( $categories ) {
		$category_slugs = wp_list_pluck( $categories, 'slug' );

		return in_array( 'aquila', $category_slugs, true ) ? $categories : array_merge(
			$categories,
			[
				[
					'slug'  => 'aquila',
					'title' => __( 'Aquila Blocks', 'aquila' ),
					'icon'  => 'table-row-after',
				],
			]
		);
	}
}
