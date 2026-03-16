<?php
/**
 * Mein theme remove Gutenberg support
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Theme support hooks
 */
function mein_remove_gutenberg_support() {

    // Remove support for block styles
    remove_theme_support( 'wp-block-styles' );

    // Remove support for editor styles
    remove_theme_support( 'editor-styles' );

    // Remove support for block library
    remove_theme_support( 'wp-block-library' );

    // Remove support for block templates
    remove_theme_support( 'block-templates' );    

    // Remove support for global styles
    remove_theme_support( 'global-styles' );

    // Remove support for gutenberg patterns    
    remove_theme_support( 'core-block-patterns' );
}
add_action( 'after_setup_theme', 'mein_remove_gutenberg_support' );

// Remove Gutenberg patterns from the editor (not workink anymore)
function remove_wp_block_menu() {
  remove_submenu_page( 'themes.php', 'site-editor.php?path=/patterns' );
}
add_action('admin_init', 'remove_wp_block_menu', 100);

add_filter('should_load_remote_block_patterns', '__return_false');

// Remove Gutenberg patterns from the menu
function remove_menus_appearance_patterns(){  
    // Appearance > Patterns  
    remove_submenu_page('themes.php', 'site-editor.php?p=/pattern');  
}  
add_action('admin_menu', 'remove_menus_appearance_patterns');

/**
 * Anti-Gutenberg filters
 */
// Disable the block editor from managing widgets
add_filter( 'gutenberg_use_widgets_block_editor', '__return_false', 100 );
add_filter( 'use_widgets_block_editor', '__return_false' );

// Disable the block editor for posts
add_filter( 'use_block_editor_for_post', '__return_false', 10, 2 );

// Disable the block editor for post types
add_filter( 'use_block_editor_for_post_type', '__return_false', 10, 2 );

//Remove Gutenberg Block Library CSS from loading on the frontend
function remove_wp_block_library_css(){
    wp_dequeue_style( 'wp-block-library' );
    wp_dequeue_style( 'wp-block-library-theme' );
    wp_dequeue_style( 'global-styles' );

    // Remove WooCommerce block CSS
    wp_dequeue_style( 'wc-blocks-style' ); 
} 
add_action( 'wp_enqueue_scripts', 'remove_wp_block_library_css', 100 );

//REMOVE GUTENBERG BLOCK LIBRARY CSS FROM LOADING ON FRONTEND
// function remove_wp_block_library_css(){
// wp_dequeue_style( 'wp-block-library' );
// wp_dequeue_style( 'wp-block-library-theme' );
// wp_dequeue_style( 'wc-block-style' ); // REMOVE WOOCOMMERCE BLOCK CSS
// wp_dequeue_style( 'global-styles' ); // REMOVE THEME.JSON
// }
// add_action( 'wp_enqueue_scripts', 'remove_wp_block_library_css', 100 );

// Remove Global Styles and SVG Filters from WP 5.9.1 - 2022-02-27
// function remove_global_styles_and_svg_filters() {
// 	remove_action( 'wp_enqueue_scripts', 'wp_enqueue_global_styles' );
// 	remove_action( 'wp_body_open', 'wp_global_styles_render_svg_filters' );
// }
// add_action('init', 'remove_global_styles_and_svg_filters');

// This snippet removes the Global Styles and SVG Filters that are mostly if not only used in Full Site Editing in WordPress 5.9.1+
// Detailed discussion at: https://github.com/WordPress/gutenberg/issues/36834
// WP default filters: https://github.com/WordPress/WordPress/blob/7d139785ea0cc4b1e9aef21a5632351d0d2ae053/wp-includes/default-filters.php
