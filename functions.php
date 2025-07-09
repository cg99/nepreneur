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
} );
