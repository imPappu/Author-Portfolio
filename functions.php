<?php
/**
 * Noir Editorial Theme Functions
 *
 * @package noir-editorial
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Define Constants
 */
define( 'NOIR_VERSION', '1.1.2' );
define( 'NOIR_DIR', get_template_directory() );
define( 'NOIR_URI', get_template_directory_uri() );

/**
 * Load Theme Components
 */
require_once NOIR_DIR . '/inc/helpers.php';    // Helper Functions
require_once NOIR_DIR . '/inc/post-types.php'; // CPTs
require_once NOIR_DIR . '/inc/metaboxes.php'; // Post Meta
require_once NOIR_DIR . '/inc/setup.php';     // Image sizes & Widgets
require_once NOIR_DIR . '/inc/assets.php';    // Enqueue
require_once NOIR_DIR . '/inc/customizer.php';// Customizer

/**
 * Main Theme Setup
 */
function noir_editorial_setup() {
	// Add Theme Supports
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );
	add_theme_support( 'custom-logo' );
	add_theme_support( 'responsive-embeds' );

	// Image Sizes
	add_image_size( 'book-cover', 400, 600, true );
	add_image_size( 'author-portrait', 800, 800, true );

	// Nav Menus
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'noir-editorial' ),
		'footer'  => esc_html__( 'Footer Menu', 'noir-editorial' ),
	) );
}
add_action( 'after_setup_theme', 'noir_editorial_setup' );

/**
 * Nav Menu Link Attributes (Pill Navigation Support)
 */
function noir_editorial_nav_classes( $classes, $item, $args ) {
    if ( $args->theme_location === 'primary' ) {
        $classes[] = 'nav-item';
    }
    return $classes;
}
add_filter( 'nav_menu_css_class', 'noir_editorial_nav_classes', 10, 3 );

function noir_editorial_nav_link_atts( $atts, $item, $args ) {
    if ( $args->theme_location === 'primary' ) {
        $atts['class'] = 'nav-link';
    }
    return $atts;
}
add_filter( 'nav_menu_link_attributes', 'noir_editorial_nav_link_atts', 10, 3 );

/**
 * Flush rewrite rules on theme switch
 */
function noir_editorial_rewrite_flush() {
    noir_editorial_register_post_types();
    noir_editorial_register_taxonomies();
    flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'noir_editorial_rewrite_flush' );
