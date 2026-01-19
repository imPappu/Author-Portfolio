<?php
/**
 * Theme Customizer (Noir Editorial Liquid Edition)
 *
 * @package noir-editorial
 */

function noir_editorial_customize_register( $wp_customize ) {

	// ============================================
	// HERO SECTION
	// ============================================
	$wp_customize->add_section( 'author_portfolio_hero', array(
		'title'    => __( 'Noble Hero Settings', 'noir-editorial' ),
		'priority' => 30,
	) );

	// Title
	$wp_customize->add_setting( 'author_portfolio_hero_title', array(
		'default'           => 'Redefining Modern Fiction',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'author_portfolio_hero_title', array(
		'label'   => 'Hero Title (Primary Statement)',
		'section' => 'author_portfolio_hero',
	) );

	// Description
	$wp_customize->add_setting( 'author_portfolio_hero_description', array(
		'default'           => 'A.V. Noir blends the cinematic intensity of high-fashion editorial aesthetics with the psychological depth of contemporary literature.',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'author_portfolio_hero_description', array(
		'label'   => 'Hero Intro Text',
		'section' => 'author_portfolio_hero',
		'type'    => 'textarea',
	) );

    // Hero Carousel Images (1-5)
    for ( $i = 1; $i <= 5; $i++ ) {
        $wp_customize->add_setting( 'author_portfolio_hero_carousel_image_' . $i, array(
            'sanitize_callback' => 'esc_url_raw',
        ) );
        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'author_portfolio_hero_carousel_image_' . $i, array(
            'label'    => sprintf( 'Hero Slide Image %d', $i ),
            'section'  => 'author_portfolio_hero',
        ) ) );
    }

	// ============================================
	// AUTHOR PROFILE
	// ============================================
	$wp_customize->add_section( 'author_portfolio_author', array(
		'title'    => __( 'Author Biography', 'noir-editorial' ),
		'priority' => 31,
	) );

	$wp_customize->add_setting( 'author_portfolio_author_name', array(
		'default' => 'A.V. Noir',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'author_portfolio_author_name', array(
		'label' => 'Author Display Name',
		'section' => 'author_portfolio_author',
	) );

	$wp_customize->add_setting( 'author_portfolio_author_image', array(
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'author_portfolio_author_image', array(
		'label'   => 'Portrait (Radius Masked)',
		'section' => 'author_portfolio_author',
	) ) );

	$wp_customize->add_setting( 'author_portfolio_author_bio', array(
		'default' => '<p>Based between Tokyo and Paris...</p>',
		'sanitize_callback' => 'wp_kses_post',
	) );
	$wp_customize->add_control( 'author_portfolio_author_bio', array(
		'label' => 'Full Bio (HTML Support)',
		'section' => 'author_portfolio_author',
		'type' => 'textarea',
	) );

    // Stats Grid
    $stats = array(
        'stat_1' => array('val' => 'author_portfolio_books_published', 'lbl' => 'author_portfolio_stat_1_lbl', 'def_val' => '25', 'def_lbl' => 'Books Published'),
        'stat_2' => array('val' => 'author_portfolio_awards_won', 'lbl' => 'author_portfolio_stat_2_lbl', 'def_val' => '05', 'def_lbl' => 'Awards Won'),
        'stat_3' => array('val' => 'author_portfolio_years_experience', 'lbl' => 'author_portfolio_stat_3_lbl', 'def_val' => '20', 'def_lbl' => 'Years Experience'),
    );

    foreach($stats as $key => $config) {
        $wp_customize->add_setting( $config['val'], array('default' => $config['def_val'], 'sanitize_callback' => 'sanitize_text_field') );
        $wp_customize->add_control( $config['val'], array('label' => "Stat Value: " . $config['def_lbl'], 'section' => 'author_portfolio_author') );
        
        $wp_customize->add_setting( $config['lbl'], array('default' => $config['def_lbl'], 'sanitize_callback' => 'sanitize_text_field') );
        $wp_customize->add_control( $config['lbl'], array('label' => "Stat Label: " . $config['def_lbl'], 'section' => 'author_portfolio_author') );
    }

    // ============================================
	// SOCIAL MEDIA
	// ============================================
	$wp_customize->add_section( 'author_portfolio_social', array(
		'title'    => __( 'Social Identity', 'noir-editorial' ),
		'priority' => 32,
	) );

	$socials = array( 'facebook', 'twitter', 'instagram', 'linkedin', 'youtube', 'tiktok' );
	foreach ( $socials as $social ) {
		$wp_customize->add_setting( 'author_portfolio_social_' . $social, array( 'sanitize_callback' => 'esc_url_raw' ) );
		$wp_customize->add_control( 'author_portfolio_social_' . $social, array(
			'label'   => ucfirst($social) . ' URL',
			'section' => 'author_portfolio_social',
			'type'    => 'url',
		) );
	}
}
add_action( 'customize_register', 'noir_editorial_customize_register' );