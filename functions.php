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
// This file is now a strict loader. All logic resides in /inc/

/**
 * Add stagger-item class to nav menu list items
 */
function noir_editorial_nav_menu_link_attributes( $atts, $item, $args ) {
    if ( 'primary' === $args->theme_location ) {
        $atts['class'] = ( ! empty( $atts['class'] ) ? $atts['class'] . ' ' : '' ) . 'stagger-item';
    }
    return $atts;
}
add_filter( 'nav_menu_link_attributes', 'noir_editorial_nav_menu_link_attributes', 10, 3 );

/**
 * Add stagger-item class to nav menu list items
 */
function noir_editorial_nav_menu_css_class( $classes, $item, $args ) {
    if ( 'primary' === $args->theme_location ) {
        $classes[] = 'stagger-item';
    }
    return $classes;
}
add_filter( 'nav_menu_css_class', 'noir_editorial_nav_menu_css_class', 10, 3 );
