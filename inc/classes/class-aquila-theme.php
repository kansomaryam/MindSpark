<?php
/**
 * Bootstraps the Theme.
 * This file bootstraps the Aquila theme by initializing core features and theme support options.
 * @package Aquila
 */

namespace AQUILA_THEME\Inc;

use AQUILA_THEME\Inc\Traits\Singleton;

class AQUILA_THEME {
    use Singleton;

    protected function __construct() {
        // Load various theme-related classes.
        Assets::get_instance();
        Menus::get_instance();
        Meta_Boxes::get_instance();
        Sidebars::get_instance();
        Blocks::get_instance();
        Block_Patterns::get_instance();
        Loadmore_Posts::get_instance();
        Loadmore_Single::get_instance();
        Archive_Settings::get_instance();

        $this->setup_hooks();
    }

    protected function setup_hooks() {
        // Register theme setup hook.
        add_action('after_setup_theme', [ $this, 'setup_theme' ]);
    }

    /**
     * Setup theme configuration and support.
     *
     * @return void
     */
    public function setup_theme() {
        // Enable document title management.
        add_theme_support('title-tag');
        // Add custom logo support.
        add_theme_support(
            'custom-logo',
            [
                'header-text' => ['site-title', 'site-description'],
                'height' => 100,
                'width' => 400,
                'flex-height' => true,
                'flex-width' => true,
            ]
        );

        // Add custom background support.
        add_theme_support(
            'custom-background',
            [
                'default-color' => 'ffffff',
                'default-image' => '',
                'default-repeat' => 'no-repeat',
            ]
        );

        // Enable post thumbnails.
        add_theme_support('post-thumbnails');

        // Enable post formats like 'aside' and 'gallery'.
        add_theme_support('post-formats', ['aside', 'gallery']);

        // Register a custom image size for featured thumbnails.
        add_image_size('featured-thumbnail', 350, 233, true);

        // Enable selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        // Add RSS feed links to the head section.
        add_theme_support('automatic-feed-links');

        // Enable HTML5 markup for various elements.
        add_theme_support(
            'html5',
            [
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
                'script',
                'style',
            ]
        );

        // Enable Gutenberg block styles.
        add_theme_support('wp-block-styles');

        // Enable wide and full alignment options in Gutenberg.
        add_theme_support('align-wide');

        // Load editor styles for the Gutenberg editor.
        add_theme_support('editor-styles');
        add_editor_style('assets/build/css/editor.css');

        // Disable core block patterns.
        remove_theme_support('core-block-patterns');

        // Set maximum content width.
        global $content_width;
        if (!isset($content_width)) {
            $content_width = 1240;
        }
    }
};
