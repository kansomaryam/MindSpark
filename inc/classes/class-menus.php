<?php
/**
 * Register Menus
 * Register Menus and handle menu-related functionality.
 * @package Aquila
 */

namespace AQUILA_THEME\Inc;

use AQUILA_THEME\Inc\Traits\Singleton;

class Menus {

    use Singleton;

    protected function __construct() {
        // Load class.
        $this->setup_hooks();
    }

    protected function setup_hooks() {
        // Register menu locations.
        add_action( 'init', [ $this, 'register_menus' ] );
    }

    /**
     * Register header and footer menus.
     */
    public function register_menus() {
        register_nav_menus([
            'aquila-header-menu' => esc_html__( 'Header Menu', 'aquila' ),
            'aquila-footer-menu' => esc_html__( 'Footer Menu', 'aquila' ),
        ]);
    }

    /**
     * Get menu ID by location.
     *
     * @param string $location Menu location identifier.
     * @return integer Menu ID.
     */
    public function get_menu_id( $location ) {
        // Get all registered menu locations.
        $locations = get_nav_menu_locations();

        // Return the menu ID for the specified location.
        return ! empty( $locations[$location] ) ? $locations[$location] : '';
    }

    /**
     * Get child menu items.
     *
     * @param array   $menu_array Array of menu items.
     * @param integer $parent_id  Parent menu ID.
     * @return array Array of child menu items.
     */
    public function get_child_menu_items( $menu_array, $parent_id ) {
        $child_menus = [];

        // Loop through the menu array and filter child items by parent ID.
        if ( ! empty( $menu_array ) && is_array( $menu_array ) ) {
            foreach ( $menu_array as $menu ) {
                if ( intval( $menu->menu_item_parent ) === $parent_id ) {
                    $child_menus[] = $menu;
                }
            }
        }

        return $child_menus;
    }
}
