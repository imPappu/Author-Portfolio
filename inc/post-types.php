<?php
/**
 * Register Custom Post Types and Taxonomies (Noir Editorial)
 *
 * @package noir-editorial
 */

/**
 * Register post types
 */
function noir_editorial_register_post_types() {
	// Books
    $book_labels = array(
        'name'                  => _x( 'Books', 'Post type general name', 'noir-editorial' ),
        'singular_name'         => _x( 'Book', 'Post type singular name', 'noir-editorial' ),
        'menu_name'             => _x( 'Books', 'Admin Menu text', 'noir-editorial' ),
        'add_new'               => __( 'Add New Book', 'noir-editorial' ),
        'add_new_item'          => __( 'Add New Book to Library', 'noir-editorial' ),
        'edit_item'             => __( 'Edit Editorial for Book', 'noir-editorial' ),
    );

	register_post_type( 'book', array(
		'labels'              => $book_labels,
		'public'              => true,
		'has_archive'         => true,
		'supports'            => array( 'title', 'thumbnail', 'excerpt' ),
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-book',
		'rewrite'             => array( 'slug' => 'books' ),
		'show_in_rest'        => true,
	) );

	// Audiobooks
    $audio_labels = array(
        'name'                  => _x( 'Audiobooks', 'Post type general name', 'noir-editorial' ),
        'singular_name'         => _x( 'Audiobook', 'Post type singular name', 'noir-editorial' ),
        'menu_name'             => _x( 'Audiobooks', 'Admin Menu text', 'noir-editorial' ),
        'add_new'               => __( 'Add New Recording', 'noir-editorial' ),
        'add_new_item'          => __( 'Add New Audiobook Recording', 'noir-editorial' ),
        'edit_item'             => __( 'Edit Audio Profile', 'noir-editorial' ),
    );

	register_post_type( 'audiobook', array(
		'labels'              => $audio_labels,
		'public'              => true,
		'has_archive'         => true,
		'supports'            => array( 'title', 'thumbnail', 'excerpt' ),
		'menu_position'       => 6,
		'menu_icon'           => 'dashicons-format-audio',
		'rewrite'             => array( 'slug' => 'audiobooks' ),
		'show_in_rest'        => true,
	) );

    // Purchase Platforms
    $platform_labels = array(
        'name'                  => _x( 'Platforms', 'Post type general name', 'noir-editorial' ),
        'singular_name'         => _x( 'Platform', 'Post type singular name', 'noir-editorial' ),
        'menu_name'             => _x( 'Purchase Platforms', 'Admin Menu text', 'noir-editorial' ),
        'add_new'               => __( 'Add New Platform', 'noir-editorial' ),
        'add_new_item'          => __( 'Define New Platform', 'noir-editorial' ),
    );

    register_post_type( 'platform', array(
        'labels'              => $platform_labels,
        'public'              => false, // We use it as a data source
        'show_ui'             => true,
        'supports'            => array( 'title', 'thumbnail' ), // Title is name, thumbnail is icon/logo
        'menu_position'       => 7,
        'menu_icon'           => 'dashicons-cart',
        'show_in_rest'        => true,
    ) );
}
add_action( 'init', 'noir_editorial_register_post_types' );

/**
 * Register taxonomies
 */
function noir_editorial_register_taxonomies() {
	// Genre
	register_taxonomy( 'genre', array( 'book', 'audiobook' ), array(
		'label'             => esc_html__( 'Genres', 'noir-editorial' ),
		'public'            => true,
		'hierarchical'      => true,
		'show_in_rest'      => true,
		'rewrite'           => array( 'slug' => 'genre' ),
	) );

	// Series
	register_taxonomy( 'series', array( 'book', 'audiobook' ), array(
		'label'             => esc_html__( 'Series', 'noir-editorial' ),
		'public'            => true,
		'hierarchical'      => true,
		'show_in_rest'      => true,
		'rewrite'           => array( 'slug' => 'series' ),
	) );
}
add_action( 'init', 'noir_editorial_register_taxonomies' );
