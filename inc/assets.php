<?php
/**
 * Enqueue scripts and styles
 *
 * @package noir-editorial
 */

/**
 * Enqueue frontend styles and scripts
 */
function noir_editorial_enqueue_assets() {
	// Main Liquid Stylesheet
	wp_enqueue_style( 
		'noir-editorial-master', 
		get_template_directory_uri() . '/assets/css/main.css', 
		array(), 
		'1.1.0' 
	);

	// Main JavaScript
	wp_enqueue_script( 
		'noir-editorial-main', 
		get_template_directory_uri() . '/assets/js/main.js', 
		array(), 
		'1.1.0', 
		true 
	);
}
add_action( 'wp_enqueue_scripts', 'noir_editorial_enqueue_assets' );

/**
 * Add resource hints for performance
 */
function noir_editorial_resource_hints( $urls, $relation_type ) {
	if ( 'preconnect' === $relation_type ) {
		$urls[] = array( 'href' => 'https://fonts.googleapis.com', 'crossorigin' );
		$urls[] = array( 'href' => 'https://fonts.gstatic.com', 'crossorigin' );
	}
	return $urls;
}
add_filter( 'wp_resource_hints', 'noir_editorial_resource_hints', 10, 2 );