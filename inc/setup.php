<?php
/**
 * Theme Setup Functions
 *
 * @package noir-editorial
 */

/**
 * Register widget areas
 */
function noir_editorial_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'noir-editorial' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'noir-editorial' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 1', 'noir-editorial' ),
		'id'            => 'footer-1',
		'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'noir-editorial' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'noir_editorial_widgets_init' );

/**
 * Handle newsletter subscription
 */
function noir_editorial_handle_newsletter_subscribe() {
	// Verify nonce
	if ( ! isset( $_POST['newsletter_nonce'] ) || 
	     ! wp_verify_nonce( $_POST['newsletter_nonce'], 'newsletter_subscribe_action' ) ) {
		wp_die( esc_html__( 'Security check failed', 'noir-editorial' ) );
	}

	// Get and sanitize email
	$email = isset( $_POST['newsletter_email'] ) ? sanitize_email( $_POST['newsletter_email'] ) : '';

	if ( ! is_email( $email ) ) {
		wp_redirect( add_query_arg( 'newsletter', 'invalid', wp_get_referer() ) );
		exit;
	}

	// Here you would integrate with your newsletter service
	// For example: Mailchimp, ConvertKit, etc.
	// For now, we'll just store it as an option (for demonstration)
	$subscribers = get_option( 'noir_editorial_subscribers', array() );
	
	if ( ! in_array( $email, $subscribers ) ) {
		$subscribers[] = $email;
		update_option( 'noir_editorial_subscribers', $subscribers );
	}

	// Redirect back with success message
	wp_redirect( add_query_arg( 'newsletter', 'success', wp_get_referer() ) );
	exit;
}
add_action( 'admin_post_nopriv_newsletter_subscribe', 'noir_editorial_handle_newsletter_subscribe' );
add_action( 'admin_post_newsletter_subscribe', 'noir_editorial_handle_newsletter_subscribe' );

/**
 * Add body classes
 */
function noir_editorial_body_classes( $classes ) {
	// Add class for pages with sidebar
	if ( ! is_front_page() && is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'has-sidebar';
	}

	// Add class for homepage
	if ( is_front_page() ) {
		$classes[] = 'page-home';
	}

	return $classes;
}
add_filter( 'body_class', 'noir_editorial_body_classes' );

/**
 * Custom excerpt length
 */
function noir_editorial_excerpt_length( $length ) {
	return 30;
}
add_filter( 'excerpt_length', 'noir_editorial_excerpt_length' );

/**
 * Custom excerpt more
 */
function noir_editorial_excerpt_more( $more ) {
	return '...';
}
add_filter( 'excerpt_more', 'noir_editorial_excerpt_more' );