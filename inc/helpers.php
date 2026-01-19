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
 * Get platform buy links
 */
function noir_editorial_get_buy_links( $post_id = null ) {
    if ( ! $post_id ) $post_id = get_the_ID();
    
    $links = array();
    $amazon = get_post_meta( $post_id, 'book_amazon_url', true );
    $apple = get_post_meta( $post_id, 'book_apple_url', true );
    $audible = get_post_meta( $post_id, 'audio_audible_url', true );

    if ( $amazon ) $links['amazon'] = array( 'label' => 'Amazon', 'url' => $amazon, 'icon' => '📚' );
    if ( $apple ) $links['apple'] = array( 'label' => 'Apple Books', 'url' => $apple, 'icon' => '🍎' );
    if ( $audible ) $links['audible'] = array( 'label' => 'Audible', 'url' => $audible, 'icon' => '🎧' );

    return $links;
}
