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
