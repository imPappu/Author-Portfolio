<?php
/**
 * Theme Helper Functions
 *
 * @package noir-editorial
 */

/**
 * Get reading time estimate
 */
function noir_editorial_get_reading_time( $post_id = null ) {
	if ( null === $post_id ) {
		$post_id = get_the_ID();
	}

	$post = get_post( $post_id );
	if ( ! $post ) {
		return '';
	}

	$word_count = str_word_count( wp_strip_all_tags( $post->post_content ) );
	$reading_time = ceil( $word_count / 200 );
    if ($reading_time < 1) $reading_time = 1;

	return sprintf(
		_n( '%d min read', '%d min read', $reading_time, 'noir-editorial' ),
		$reading_time
	);
}

/**
 * Get social links
 */
function noir_editorial_get_social_links() {
	$platforms = array( 'facebook', 'twitter', 'instagram', 'linkedin', 'youtube', 'tiktok' );
	$links     = array();

	foreach ( $platforms as $platform ) {
		$url = get_theme_mod( 'author_portfolio_social_' . $platform );
		if ( $url ) {
			$links[ $platform ] = $url;
		}
	}

	return $links;
}

/**
 * Get hero carousel images
 */
function noir_editorial_get_hero_images() {
	$images = array();
	for ( $i = 1; $i <= 5; $i++ ) {
		$img = get_theme_mod( 'author_portfolio_hero_carousel_image_' . $i );
		if ( $img ) {
			$images[] = $img;
		}
	}
	return $images;
}

/**
 * Get platform buy links from the new dynamic system
 */
function noir_editorial_get_buy_links( $post_id = null ) {
    if ( ! $post_id ) $post_id = get_the_ID();
    
    $saved_links = get_post_meta($post_id, 'n_purchase_links', true) ?: [];
    $links = array();

    foreach($saved_links as $link) {
        if (empty($link['id']) || empty($link['url'])) continue;
        
        $platform_post = get_post($link['id']);
        if ($platform_post && $platform_post->post_status === 'publish') {
            $links[] = array(
                'label' => $platform_post->post_title,
                'url'   => $link['url'],
                'icon'  => has_post_thumbnail($platform_post->ID) ? get_the_post_thumbnail_url($platform_post->ID, 'thumbnail') : ''
            );
        }
    }

    return $links;
}
