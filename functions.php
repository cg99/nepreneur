<?php
/**
 * Nepreneur functions
 */

add_action( 'wp_enqueue_scripts', function () {
    // main stylesheet (auto-appends version for cache-busting)
    wp_enqueue_style( 'nep-style', get_stylesheet_uri(), [], filemtime( get_stylesheet_directory() . '/style.css' ) );

    // smooth-scroll for anchor links
    wp_enqueue_script( 'nep-scroll', get_theme_file_uri( '/js/smooth-scroll.js' ), [], '1.0', true );
} );

// let WP know we’re using HTML5 & a custom title tag
add_action( 'after_setup_theme', function () {
    add_theme_support( 'title-tag' );
    add_theme_support( 'html5', [ 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ] );
    add_theme_support( 'post-thumbnails' );
} );

/**
 * Create default pages with their templates on theme activation.
 */
function nep_create_default_pages() {
    $pages = [
        [
            'slug'    => 'about',
            'title'   => 'About',
            'template' => '', // will use page-about.php automatically by slug
        ],
        [
            'slug'    => 'contact',
            'title'   => 'Contact',
            'template' => 'page-contact.php',
        ],
        [
            'slug'    => 'services',
            'title'   => 'Services',
            'template' => 'page-services.php',
        ],
        [
            'slug'    => 'get-started',
            'title'   => 'Get Started',
            'template' => 'page-get-started.php',
        ],
    ];

    foreach ( $pages as $page ) {
        if ( ! get_page_by_path( $page['slug'] ) ) {
            $page_id = wp_insert_post( [
                'post_title'  => $page['title'],
                'post_name'   => $page['slug'],
                'post_status' => 'publish',
                'post_type'   => 'page',
            ] );

            if ( ! is_wp_error( $page_id ) && $page_id && ! empty( $page['template'] ) ) {
                update_post_meta( $page_id, '_wp_page_template', $page['template'] );
            }
        }
    }
}
add_action( 'after_switch_theme', 'nep_create_default_pages' );

// Shorten excerpt length for blog listings and archives
add_filter( 'excerpt_length', function ( $length ) {
    if ( is_home() || is_archive() || is_front_page() ) {
        return 20; // limit to 20 words
    }
    return $length;
}, 999 );
